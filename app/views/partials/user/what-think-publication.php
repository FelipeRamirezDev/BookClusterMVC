<section class="que-piensas-publication container">
    <div class="que-piensas-publication__container">
        <h2 class="title">Comparte lo que tengas en mente...</h2>
        <form action="/publication" method="POST" enctype="multipart/form-data" class="form-publication">
            <!-- Campo de texto para publicación -->
            <textarea name="content" id="content" class="form-textarea" placeholder="Escribe aquí tu publicación..."></textarea>
            
            <!-- Input para agregar imágenes -->
            <label for="image" class="custom-file-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="icon-upload">
                    <path d="M.5 3a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5V3z"/>
                    <path d="M10.5 6.5a.5.5 0 0 1-.5.5H8v5.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 6 4h1V1.5a.5.5 0 0 1 1 0V4h1a.5.5 0 0 1 .5.5v2z"/>
                </svg>
                <span>Agregar una imagen</span>
            </label>
            <input type="file" accept="image/jpeg, image/png" name="image" id="image" class="form-file-input">

            <!-- Botón de publicación -->
            <button type="submit" class="form-button">Publicar</button>
        </form>
    </div>
</section>
