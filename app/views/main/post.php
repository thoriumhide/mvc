<header class="masthead" style="background-image: url('/public/pic/post-<?php echo $post['id']; ?>.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></h1>
                    <span class="subheading"><?php echo htmlspecialchars($post['description'], ENT_QUOTES); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Пост номер <?php echo $post['id']; ?></p>
            <div class="post-preview">
                <p class="post-meta">Текст: <?php echo $post['text']; ?></p>
            </div>
            <hr>
        </div>
    </div>
</div>