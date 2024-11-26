const apiURL = "http://127.0.0.1:5000";
// Función para obtener las recomendaciones de libros
const fetchRecommendedBooks = async (bookName) => {
    try {
        const response = await fetch(`${apiURL}/recommend?book_name=${encodeURIComponent(bookName)}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        if (!response.ok) {
            return { success: false, message: "No se encontraron recomendaciones" };
        }

        const data = await response.json(); // Convertir la respuesta a JSON
        const recommendations = data.recommendations || []; // Acceder a la lista de recomendaciones

        // Si no hay recomendaciones
        if (recommendations.length === 0) {
            return { success: false, message: `No se encontraron recomendaciones para: ${bookName}` };
        }

        renderRecommendedBooks(recommendations);
        return { success: true };

    } catch (error) {
        console.error('Error al obtener recomendaciones:', error);
        return { success: false, message: "Ocurrió un error al obtener recomendaciones." };
    }
};


const showBookModal = (book) => {
    const modal = document.getElementById('book-modal');
    modal.querySelector('#modal-image').src = book.image_url;
    modal.querySelector('#modal-title').textContent = book.title;
    modal.querySelector('#modal-isbn').textContent = `ISBN: ${book.ISBN}`;
    modal.querySelector('#modal-author').textContent = `Autor: ${book.author}`;
    modal.querySelector('#modal-publisher').textContent = `Editorial: ${book.publisher}`;
    modal.querySelector('#modal-year').textContent = `Año: ${book.year}`;

    modal.style.display = 'block'; // Mostrar el modal

    const closeButton = modal.querySelector('.close-button');

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
};


// Función para renderizar los libros recomendados
const renderRecommendedBooks = (books) => {
    const booksGrid = document.querySelector('.recommended-books__grid');
    booksGrid.innerHTML = ''; // Limpiar contenido previo

    books.forEach(book => {
        const bookCard = document.createElement('div');
        bookCard.classList.add('book-card');

        bookCard.innerHTML = `
            <h3>${book.title}</h3>
            <img src='${book.image_url}' alt='${book.title}'>
            <p>${book.author}</p>
        `;

        // Agregar evento para mostrar modal al hacer clic
        bookCard.addEventListener('click', () => showBookModal(book));

        booksGrid.appendChild(bookCard);
    });
};

// Función principal para las sugerencias y eventos
// Función principal para las sugerencias y eventos
const getRecommendations = () => {
    const search = document.querySelector('.search');
    const inputField = search.querySelector('.input-books');
    const suggestionsList = search.querySelector('.suggestions-list');
    const inputClear = search.querySelector('.btn-cleare');

    if(!inputField || !suggestionsList || !inputClear) {
        console.error('No se encontraron los elementos necesarios');
        return;
    }

    // Obtener sugerencias mientras el usuario escribe
    inputField.addEventListener('input', async () => {
        const query = inputField.value;
        if (query.length < 2) {
            suggestionsList.innerHTML = ''; // Limpiar las sugerencias si no hay texto
            return;
        }

        try {
            const response = await fetch(`${apiURL}/search?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            const data = await response.json();
            const suggestions = data.results;

            suggestionsList.innerHTML = ''; // Limpiar las sugerencias previas

            suggestions.forEach(book => {
                const li = document.createElement('li');
                li.textContent = book.title;
                li.classList.add('suggestion-item');
                li.addEventListener('click', () => {
                    inputField.value = book.title; // Completar el input con la sugerencia seleccionada
                    suggestionsList.innerHTML = ''; // Limpiar las sugerencias después de seleccionar
                });
                suggestionsList.appendChild(li);
            });
        } catch (error) {
            console.error('Error al obtener sugerencias:', error);
        }
    });

    // Limpiar el campo de entrada y las sugerencias
    inputClear.addEventListener('click', () => {
        inputField.value = '';
        suggestionsList.innerHTML = '';
    });

    const title = document.querySelector('.recommended-books__title');
    const booksGrid = document.querySelector('.recommended-books__grid');

    // Evento para buscar recomendaciones al hacer clic en el botón de búsqueda
    document.querySelector('.btn-search').addEventListener('click', async () => {
        const bookName = inputField.value.trim();
        if (bookName) {
            const result = await fetchRecommendedBooks(bookName);
                
            if(!result.success) {
                title.textContent = `${result.message} para ${bookName}`; // Mostrar mensaje si no hay recomendaciones
                booksGrid.innerHTML = ''; // Limpiar contenido previo
            } else {
                title.textContent = `Libros recomendados para: ${bookName}`;
            }
        }
    });
};

// Inicializar las funciones
(() => {
    getRecommendations();
})();
