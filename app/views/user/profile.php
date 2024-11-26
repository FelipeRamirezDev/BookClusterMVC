
<section class="profile">
    <div class="profile__container container">
        <div class="profile__header">
            <div class="profile__header__images">
                <div class="profile__image__cover">
                    <img src="/img/users/cover/<?php echo empty($user->cover_photo) ? "default.jpg" : $user->cover_photo ?>" alt="<?= $user->username ?>">
                </div><!-- imagen cover -->

                <div class="profile__image__profile">
                    <?php if($user->profile_picture): ?>
                        <img src="/img/users/profile/<?= $user->profile_picture ?>" alt="<?= $user->username ?>">
                    <?php else: ?>
                        <form class="form-publication">
                            <img src="/img/users/profile/default.png" alt="<?= $user->username ?>">
                            <!-- Input para agregar imágenes -->
                            <div class="form-publication__input">
                                <label for="image" class="custom-file-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="icon-upload">
                                        <path d="M.5 3a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5H1a.5.5 0 0 1-.5-.5V3z"/>
                                        <path d="M10.5 6.5a.5.5 0 0 1-.5.5H8v5.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 6 4h1V1.5a.5.5 0 0 1 1 0V4h1a.5.5 0 0 1 .5.5v2z"/>
                                    </svg>
                                    <span>Agregar una imagen</span>
                                </label>
                                <input type="file" accept="image/jpeg, image/png" name="image" id="image" class="form-file-input">
                                <button type="submit" class="form-button">cargar</button>
                            </div>
                            
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="profile__header__info">
                <div class="profile__header__container">
                    <h2 class="profile__header__info__name"><?= $user->username ?></h2>
                    <p class="profile__header__info__email">Email: <?= $user->email ?></p>
                </div>
            </div>
        </div><!-- imagenes del perfil -->

            <?php include __DIR__ . "/../partials/user/what-think-publication.php" ?>

            
        <div class="profile__body">
            <div class="profile__body__post">
                <h3 class="profile__body__post__title">Publicaciones</h3>
                <?php if(empty($posts)): ?>
                    <p class="profile__body__post__empty">No hay publicaciones aún</p>
                <?php else: ?>
                    <?php foreach($posts as $post): ?>
                        <div class="profile__body__post__item">
                            <div class="profile__body__post__item__header">
                                <div class="profile__body__post__item__header__image">
                                    <img src="/img/users/profile/<?= $post['profile_picture'] ?>" alt="<?= $post['username'] ?>">
                                </div>
                                <div class="profile__body__post__item__header__info">
                                    <h4 class="profile__body__post__item__header__info__name"><?= $post['username'] ?></h4>
                                    <p class="profile__body__post__item__header__info__date"><?= $post['created_at'] ?></p>
                                </div>
                            </div>
                            <div class="profile__body__post__item__content">
                                <p class="profile__body__post__item__content__text"><?= $post['content'] ?></p>
                                <?php if($post['image']): ?>
                                    <img src="<?= $post['image'] ?>" alt="<?= $post['username'] ?>" class="profile__body__post__item__content__image">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>