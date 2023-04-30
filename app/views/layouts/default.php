<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" type="img/png" href="/public/img/favicon.ico"/>
        <link href="/public/css/bootstrap.css" rel="stylesheet">
        <link href="/public/css/main.css" rel="stylesheet">
        <link href="/public/css/font-awesome.css" rel="stylesheet">
        <script src="/public/js/jquery.js"></script>
        <script src="/public/js/sweetalert.min.js"></script>
        <script src="/public/js/popper.js"></script>
        <script src="/public/js/bootstrap.js"></script>
        <script src="/public/js/form.js"></script>
	</head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="/">Я є блог</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/login">Вхід</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Контакти</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php echo $content; ?>
        <hr>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">&copy; 2023 Сайт</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>