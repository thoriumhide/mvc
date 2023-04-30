

<header class="masthead" style="background-image: url('/public/img/post-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1><?php echo $title; ?></h1>
                    <span class="subheading">простой блог на php - oop - mvc</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (empty($posts)): ?>
                <p>Список постов пуст</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-preview">
                        <a href="/post/<?php echo $post['id']; ?>">
                            <h2 class="post-title"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></h2>
                            <h5 class="post-subtitle"><?php echo htmlspecialchars($post['description'], ENT_QUOTES); ?></h5>
                        </a>
                        <p class="post-meta">Идентфикатор этого поста <?php echo $post['id']; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>