<?php
namespace app\core;
use app\core\View;

abstract class Controller {
    public $route;
    public $view;
    public $acl;
    public function __construct($route) {
        $this->route = $route;
        //$_SESSION['authorize']['id'] = 1;
        //$_SESSION['admin'] = 1;
        if(!$this->checkAcl()){
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }
    public function loadModel($name) {
        $path = 'app\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl() {
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if ($this->isAcl('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        }
        elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
            return true;
        }
        elseif (isset($_SESSION['logged_user']) and $this->isAcl('admin') and $_SESSION['acl'] == 'admin') {
            return true;
        }  
        elseif (isset($_SESSION['logged_user']) and $this->isAcl('manager') and $_SESSION['acl'] == 'manager') {
            return true;
        } 
        elseif (isset($_SESSION['logged_user']) and $this->isAcl('editor') and $_SESSION['acl'] == 'editor') {
            return true;
        }       
        return false;
        //debug($acl);
    }
    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}
