<div class="full-height">
    <!-- Modal: show book info -->
    <div id="book-modal" class="modal">
        <span class="close-button">&times;</span>

        <div class="modal-content">
            <img id="modal-image" src="" alt="">

            <div class="modal-body">
                <h2 id="modal-title"></h2>
                <p id="modal-isbn"></p>
                <p id="modal-author"></p>
                <p id="modal-publisher"></p>
                <p id="modal-year"></p>
            </div>
        </div>
    </div>


    <div>
        <?php include __DIR__ . "/../partials/explore/search.php";?>
        <?php include __DIR__ . "/../partials/explore/recommended-books.php";?>
    </div>
</div>