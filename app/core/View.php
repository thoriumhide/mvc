<?php

namespace app\core;

class View {
    public $path;
    public $route;
	public $layout = 'default';

    public function __construct($route) {
   		$this->route = $route;
        //echo "class View";
	    $this->path = $route['controller'].'/'.$route['action'];
    }
    public function render($title, $vars =[]){
    	$path = 'app/views/'.$this->path.'.php';
    	extract($vars);
    	if (file_exists($path)) {
	    	ob_start();
	    	require $path;
	    	$content = ob_get_clean();
	    	require 'app/views/layouts/'.$this->layout.'.php';
    	}
    }
    public function redirect($url){
    	header('location: /'.$url);
    	exit;
    }
    public static function errorCode($code){
    	http_response_code($code);
    	$path = 'app/views/errors/'.$code.'.php';
    	if (file_exists($path)) {
    		require $path;
    	}
    	exit;
    }
    public function message($title, $message, $status) {
        exit(json_encode(['title' => $title, 'message' => $message, 'status' => $status]));
    }
    public function location($url) {
        exit(json_encode(['url' => $url]));
    }

     
}