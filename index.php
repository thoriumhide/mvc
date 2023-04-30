<?php

require 'app/lib/Dev.php';

use app\core\Router;

// Регистрируем функцию для автозагрузки классов
spl_autoload_register(function ($class) {
    // Преобразуем пространство имен в путь к файлу
    $path = str_replace('\\', '/', $class) . '.php';

    // Проверяем, существует ли файл класса
    if (file_exists($path)) {
        require_once $path;
    }
});

//Старт сесии
session_start();


// Создаем экземпляр
$router = new Router;

// Создание маршрутов
// --MainController
$router->add('', 'main', 'index');
$router->add('posts', 'main', 'posts');
$router->add('main/posts/{page:\d+}', 'main', 'posts');
$router->add('post/{id:\d+}', 'main', 'post');
$router->add('contact', 'main', 'contact');
// --AdminController
$router->add('admin', 'admin', 'index');
$router->add('admin/login', 'admin', 'login');
$router->add('admin/logout', 'admin', 'logout');
$router->add('admin/settings', 'admin', 'settings');

// Posts
$router->add('admin/posts', 'admin', 'posts');
$router->add('admin/posts/{page:\d+}', 'admin', 'posts');
$router->add('admin/add_post', 'admin', 'add_post');
$router->add('admin/edit_post/{id:\d+}', 'admin', 'edit_post');
$router->add('admin/delete_post/{id:\d+}', 'admin', 'delete_post');
// Users
$router->add('admin/users', 'admin', 'users');
$router->add('admin/users/{page:\d+}', 'admin', 'users');
$router->add('admin/add_user', 'admin', 'add_user');
$router->add('admin/edit_user/{id:\d+}', 'admin', 'edit_user');
$router->add('admin/delete_user/{id:\d+}', 'admin', 'delete_user');
// Pages
$router->add('admin/pages', 'admin', 'pages');
$router->add('admin/pages/{page:\d+}', 'admin', 'pages');
$router->add('admin/add_page', 'admin', 'add_page');
$router->add('admin/edit_page/{id:\d+}', 'admin', 'edit_page');
$router->add('admin/delete_page/{id:\d+}', 'admin', 'delete_page');



// Запуск роутера
$router->run();


