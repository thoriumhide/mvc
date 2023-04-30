<?php

namespace app\core;
use app\lib\Database;
use R;

abstract class Model {
	public $db;
	public function __construct(){
		// создаем объект Database
   		$this->db = new Database();
	}
    public function allPages() {
        // Обновляет status для все записей в таблице на published
        /*
        $posts = R::findAll('posts', 'status = ?', ['deleted']);
        foreach ($posts as $post) {
            $post->status = 'published';
            R::store($post);
        }
        */
        // получаем все записи из таблицы "pages"
        $pages = R::findAll('pages', 'status = "published" ORDER BY id');
        // передаем данные в шаблонизатор для отображения
        $data = [
            'pages' => $pages
        ];
        $this->data = $data;
    }
    public function loadPage($id) {
        // получаем все записи из таблицы "posts"
        $page = R::load('pages', $id);
        // передаем данные в шаблонизатор для отображения
        $data = [
            'page' => $page
        ];
        $this->data = $data;
    }   
    public function pagesCount() {
        $parent_id = $_SESSION['page_id'];
        $count = R::getCell('SELECT COUNT(*) FROM pages WHERE (status = "published" OR status = "draft") AND parent = ?', [$parent_id]);
        return $count;
    }
    public function pagesList($route) {
        $parent_id = $_SESSION['page_id'];
        $max = 10;
        $start = (($route['page'] ?? 1) - 1) * $max;
        //$posts = R::findAll('posts', 'status = "published" AND parent = ? ORDER BY id DESC LIMIT ?, ?', [$parent_id, $start, $max]);
        //$posts = R::findAll('posts', '(status = "published" OR status = "draft") AND parent = ? ORDER BY id ASC LIMIT ?, ?', [$parent_id, $start, $max]);
        $pages = R::findAll('pages', '(status = "published" OR status = "draft") AND parent = ? ORDER BY `order` ASC LIMIT ?, ?', [$parent_id, $start, $max]);
        $data = [
            'pages' => $pages
        ];
        $this->data = $data;
        return $data;
    }
    public function isPageExists($id) {
        $page = R::load('pages', $id);
        return $page->id;
    }

    public function allPosts() {
        // Обновляет status для все записей в таблице на published
        /*
        $posts = R::findAll('posts', 'status = ?', ['deleted']);
        foreach ($posts as $post) {
            $post->status = 'published';
            R::store($post);
        }
        */
        // получаем все записи из таблицы "posts"
        $posts = R::findAll('posts', 'status = "published" ORDER BY id');
        // передаем данные в шаблонизатор для отображения
        $data = [
            'posts' => $posts
        ];
        $this->data = $data;
    }
    public function loadPost($id) {
        // получаем все записи из таблицы "posts"
        $post = R::load('posts', $id);
        // передаем данные в шаблонизатор для отображения
        $data = [
            'post' => $post
        ];
        $this->data = $data;
    }   
    public function postsCount() {
        $parent_id = $_SESSION['post_id'];
        $count = R::getCell('SELECT COUNT(*) FROM posts WHERE (status = "published" OR status = "draft") AND parent = ?', [$parent_id]);
        return $count;
    }
    public function postsList($route) {
        $parent_id = $_SESSION['post_id'];
        $max = 10;
        $start = (($route['page'] ?? 1) - 1) * $max;
        //$posts = R::findAll('posts', 'status = "published" AND parent = ? ORDER BY id DESC LIMIT ?, ?', [$parent_id, $start, $max]);
        //$posts = R::findAll('posts', '(status = "published" OR status = "draft") AND parent = ? ORDER BY id ASC LIMIT ?, ?', [$parent_id, $start, $max]);
        $posts = R::findAll('posts', '(status = "published" OR status = "draft") AND parent = ? ORDER BY `order` ASC LIMIT ?, ?', [$parent_id, $start, $max]);
        $data = [
            'posts' => $posts
        ];
        $this->data = $data;
        return $data;
    }
    public function isPostExists($id) {
        $post = R::load('posts', $id);
        return $post->id;
    }
    
    public function allUsers() {
        // получаем все записи из таблицы "users"
        $users = R::findAll('users');
        // передаем данные в шаблонизатор для отображения
        $data = [
            'users' => $users
        ];
        $this->data = $data;
    }
    public function loadUser($id) {
        // получаем все записи из таблицы "posts"
        $user = R::load('users', $id);
        // передаем данные в шаблонизатор для отображения
        $data = [
            'user' => $user
        ];
        $this->data = $data;
    }   
    public function usersCount() {
        $count = R::getCell('SELECT COUNT(*) FROM users WHERE (status = "enabled" OR status = "disabled")');
        return $count;
    }
    public function usersList($route) {
        $max = 10;
        $start = (($route['page'] ?? 1) - 1) * $max;
        //$posts = R::findAll('posts', 'status = "published" AND parent = ? ORDER BY id DESC LIMIT ?, ?', [$parent_id, $start, $max]);
        //$posts = R::findAll('posts', '(status = "published" OR status = "draft") AND parent = ? ORDER BY id ASC LIMIT ?, ?', [$parent_id, $start, $max]);
        $users = R::findAll('users', '(status = "enabled" OR status = "disabled") ORDER BY id ASC LIMIT ?, ?', [$start, $max]);
        $data = [
            'users' => $users
        ];
        $this->data = $data;
        return $data;
    }
    public function isUserExists($id) {
        $user = R::load('users', $id);
        return $user->id;
    }

}