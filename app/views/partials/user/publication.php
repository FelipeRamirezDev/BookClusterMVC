<section class="publications">
    <div class="container publications-container">
        <?php foreach ($posts as $post): ?>
            <article class="post">
                <div class="post-header">
                    <img src="<?php echo $post['profile_picture'] ?? IMG_PROFILE_DEFAULT; ?>" alt="Foto de perfil" class="post-profile-picture">
                    <div>
                        <h3 class="post-username"><?php echo htmlspecialchars($post['username']); ?></h3>
                        <time class="post-date" datetime="<?php echo htmlspecialchars($post['created_at']); ?>">
                            <?php echo date("d M Y", strtotime($post['created_at'])); ?>
                        </time>
                    </div>
                </div>
                <div class="post-content">
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Imagen de la publicación" class="post-image">
                    <?php endif; ?>
                </div>
                <div class="post-actions">
                    <button class="btn-like">
                        ❤️ Me gusta
                    </button>
                    <button class="btn-comment">
                        💬 Comentar
                    </button>
                    <button class="btn-share">
                        🔄 Compartir
                    </button>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
