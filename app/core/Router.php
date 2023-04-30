<?php

namespace app\core;
use app\core\View;

class Router {
    public $arr = [];
    protected $routes = [];
    protected $params = [];
    // Метод создание маршрута
    public function add($url, $controller, $action) {
        $this->arr[$url] = [
            'controller' => $controller, 
            'action' => $action
        ];
    }
    // Метод переобразования маршрутов в регулярное выражение
    public function reg($route, $params) {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    // Метод сравнивания маршрута с текущим URL
    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    // Метод запуска приложения
    public function run(){
        // Добавляем масив маршрутов в переменну $arr
        $arr = $this->arr;
        // Запускаем метод reg() который к каждый $url маршрута преобразует  в регулярное выражение
        foreach ($arr as $key => $val) {
            $this->reg($key, $val);
        }
        // Производим проверку методом match() который сравнивает текущий URL с масивом маргрутов после чего подключает нужный класс и метод
        if ($this->match()) {
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    // Создаем экземпляр контроллера
                    $controller = new $path($this->params);
                    // Вызываем метод контролера
                    $controller->$action();
                }else{
                    //echo '<p style="color:red">Action: <b>'.$action.'</b> не найден</p>';
                    View::errorCode(404);
                }
            }else{
                //echo '<p style="color:red">Контролер: <b>'.$path.'</b> не найден</p>';
                View::errorCode(404);
            }
        } else{
            //echo '<p style="color:red">Маршрут не найден</p>';
            View::errorCode(404);
        }
    }
}