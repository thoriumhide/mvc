<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" type="img/png" href="/public/img/favicon.ico"/>
    <link href="/public/css/admin.css" rel="stylesheet">
    <link href="/public/css/bootstrap.css" rel="stylesheet">
    <link href="/public/css/font-awesome.css" rel="stylesheet">
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/sweetalert.min.js"></script>
    <script src="/public/js/form.js"></script>	    
    <script src="/public/js/bootstrap.js"></script>

</head>
<body>  
    <?php if ($this->route['action'] != 'login'): ?>
    <header>
        <nav class="nav-left">
            <!-- Кнопки и текст для левого меню -->
            <span>Адмін панель</span>
        </nav>
        <nav class="nav-right">
            <!-- Кнопки и текст для правого меню -->

            <span><?php echo $_SESSION['name']; ?></span>
            <div class="circle-image-container">
                <img src="/public/pic/user-<?php echo $_SESSION['id']; ?>.jpg" alt="">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>            
            <a href="/admin/logout" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> Вихід</a>
        </nav>
    </header> 
    <main>
        <div class="admin-sidebar">
            <ul class="side-menu">
                <li class="side-item">
                    <a class="side-link <?php if($this->route['action'] == 'index'){echo 'active-menu';}?>" href="/admin"><i class="fa fa-home" aria-hidden="true"></i> Головна</a>
                </li>
                <li class="side-item">
                    <a class="side-link" href="/admin/pages"><i class="fa fa-file-o" aria-hidden="true"></i> Сторінки</a>
                </li>
                <li class="side-item">
                    <a class="side-link <?php if($this->route['action'] == 'posts'){echo 'active-menu';}?>" href="/admin/posts"><i class="fa fa-file-text" aria-hidden="true"></i> Пости</a>
                </li>
                <li class="side-item">
                    <a class="side-link <?php if($this->route['action'] == 'users'){echo 'active-menu';}?>" href="/admin/users"><i class="fa fa-user" aria-hidden="true"></i> Користувачі</a>
                </li>
                <li class="side-item">
                    <a class="side-link <?php if($this->route['action'] == 'settings'){echo 'active-menu';}?>" href="/admin/settings"><i class="fa fa-cog" aria-hidden="true"></i> Налаштування</a>
                </li>
            </ul>
        </div>
        <div class="admin-content">
            <?php echo $content; ?>
        </div>
    </main>
    <?php endif; ?>
    <?php if ($this->route['action'] == 'login'): ?>
        <?php echo $content; ?>
    <?php endif; ?>
   
</body>
</html>

