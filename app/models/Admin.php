<?php

namespace app\models;
use app\core\Model;
use R;
use Imagick;
class Admin extends Model {
    public $error;
    public $data;
    public function loginValidate($post) {
        //$config = require 'app/config/admin.php';

        //$user = R::findOne('users', 'login = ?', array($post['login']));
        /*
        if ($config['login'] != $post['login']) {
            $this->error = 'Логин указан не верно';
            return false;
        }
        if ($config['password'] != $post['password']) {
            $this->error = 'Пароль указан не верно';
            return false;
        }   
        */
        $user = R::findOne('users', 'login = ?', array($post['login']));
        if ($user and $user->status == 'enabled') {
            // code...
            if (password_verify($post['password'], $user->password)) {
                //Все хорошо логинимся
                $_SESSION['id'] = $user->id;
                $_SESSION['acl'] = $user->acl;
                $_SESSION['login'] = $user->login;
                $_SESSION['name'] = $user->name;
                $_SESSION['logged_user'] = $user; 
                //echo '<div style="color:green;">Вы авторизованы под логином '.$user['login'].'</div><hr>';
                //header('location: /');
            }else {
                $this->error = 'Не верно введен пароль!';
                return false;
            }
        }else{
            $this->error = 'Пользователь с таким логином не найден!';
            return false;
        }
        return true;
    }

    public function editSettings($post) {
        // перебираем данные из формы
        $options = $_POST['options'];
        foreach ($options as $option_name => $option_value) {
            // создаем или обновляем запись в таблице options
            $option = R::findOne('options', 'option_name = ?', [$option_name]);
            if (!$option) {
                $option = R::xdispense('options');
                $option->option_name = $option_name;
                $option->status = 'on';
            }
            $option->option_value = $option_value;
            $option->status = 'on';
            R::store($option);
        }
    }
    public function UploadFavicon($path) {
        move_uploaded_file($path, 'public/img/favicon.ico');
    }
    public function loadSettings(){
        // получаем все записи, у которых статус равен "on"
        $options = R::findAll('options');

        $setting = array();
        foreach ($options as $key => $value) {
            $setting[$key] = $value;
        }
        $setting = [
            'setting' => $setting
        ];
        $this->setting = $setting;
    }
    public function pageValidate($post, $type){
        $nameLen = iconv_strlen($post['name']);
        $parentLen = iconv_strlen($post['parent']);
        $orderLen = iconv_strlen($post['order']);
        $urlLen = iconv_strlen($post['url']);
        if ($nameLen < 1 or $nameLen > 200) {
            $this->error = 'Назва повинна містити від 1 до 200 символів';
            return false;
        }
        if ($orderLen < 1) {
            $this->error = 'Не вказаний порядок сторінки';
            return false;
        }
        if ($parentLen < 1) {
            $this->error = 'Не вказаний предок сторінки';
            return false;
        }
        if ($urlLen < 1) {
            $this->error = 'Не вказаний url сторінки';
            return false;
        }
        /*
        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
            $this->error = 'Изображение не выбрано';
            return false;
        }
        */
        return true;
    }
    public function addPage($form) {
        // создаем новую запись в таблице "posts"
        $page = R::dispense('pages');
        // задаем значения для полей записи
        $page->name = $form['name'];
        $page->description = $form['description'];
        $page->text = $form['text'];
        $page->order = $form['order'];
        $page->status = $form['status'];
        $page->menu = $form['menu'];
        $page->parent = $_SESSION['page_id'];
        $page->url = $form['url'];
        $page->author_id = $_SESSION['id'];
        $page->date = date("d-m-Y H:i:s");
        // сохраняем запись в базу данных
        $id = R::store($page);
        return $id;
        // выводим сообщение об успешном добавлении записи
        //echo "Добавлен новый пост с ID: $id";
    }   
    public function editPage($id, $form) {
        // загружаем запись из базы данных с заданным ID
        $page = R::load('pages', $id);
        // изменяем поля записи
        $page->name = $form['name'];
        $page->description = $form['description'];
        $page->text = $form['text'];
        $page->order = $form['order'];
        $page->status = $form['status'];
        $page->menu = $form['menu'];
        $page->parent =  $form['parent'];
        $page->url = $form['url'];
        $page->author_id = $form['author_id'];
        $page->edate = date("d-m-Y H:i:s");
        // сохраняем изменения в базу данных
        R::store($page);
        // выводим сообщение об успешном обновлении записи
        return $id;
        //echo "Запись с ID $id успешно обновлена";
    }
    public function deletePage($id) {
        // загружаем запись из базы данных с заданным ID
        $page = R::load('pages', $id);
        // изменяем поля записи
        $page->status = 'deleted';
        // сохраняем изменения в базу данных
        R::store($page);
        // выводим сообщение об успешном обновлении записи
        //echo "Запись с ID $id успешно обновлена";
    }
    public function UploadImgPage($path, $id) {
        // Должен потдерживать хостинг
        //$img = new Imagick($path);
        //$img->cropThumbnailImage(1024, 1024);
        //$img->setImageCompressionQuality(80);
        //$img->writeImage($path, 'public/pic/'.$id.'.jpg');
        move_uploaded_file($path, 'public/pic/page-'.$id.'.jpg');
    }
    public function pagesNavigation(){
        $id = $_SESSION['page_id'];
        $data = R::load( 'pages', $id );
        $id = $data->id;
        $parent = $data->parent;
        $name = $data->name;
        $arr_pages[] = '
            <input type="text" name="id" value="'.$id.'" hidden>
            <button type="submit" class="btn btn-link admin-btn" style="color:#a9ff00!important;">'.$name.'</button>
        ';
        while ($parent != 0) {
            $data = R::load( 'pages', $parent );    
            $id = $data->id;
            $parent = $data->parent;
            $name = $data->name;
            $arr_pages[] = '
                <input type="text" name="id" value="'.$id.'" hidden>
                <button type="submit" class="btn btn-link admin-btn">'.$name.'</button>
            ';
        }
        $arr_pages = array_reverse($arr_pages);
        //$this->navigation = $arr_pages;
        $result = [
            'arr_pages' => $arr_pages,
        ];
        $this->page_navigation = $result;
    } 
    public function postValidate($post, $type){
        $nameLen = iconv_strlen($post['name']);
        $parentLen = iconv_strlen($post['parent']);
        $orderLen = iconv_strlen($post['order']);
        if ($nameLen < 1 or $nameLen > 200) {
            $this->error = 'Назва повинна містити від 1 до 200 символів';
            return false;
        }
        if ($orderLen < 1) {
            $this->error = 'Не вказаний порядок посту';
            return false;
        }
        if ($parentLen < 1) {
            $this->error = 'Не вказаний предок посту';
            return false;
        }
        /*
        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
            $this->error = 'Изображение не выбрано';
            return false;
        }
        */
        return true;
    }
    public function addPost($form) {
        // создаем новую запись в таблице "posts"
        $post = R::dispense('posts');
        // задаем значения для полей записи
        $post->name = $form['name'];
        $post->description = $form['description'];
        $post->text = $form['text'];
        $post->order = $form['order'];
        $post->status = $form['status'];
        $post->menu = $form['menu'];
        $post->parent = $_SESSION['post_id'];
        $post->date = date("d-m-Y H:i:s");
        // сохраняем запись в базу данных
        $id = R::store($post);
        return $id;
        // выводим сообщение об успешном добавлении записи
        //echo "Добавлен новый пост с ID: $id";
    }   
    public function editPost($id, $form) {
        // загружаем запись из базы данных с заданным ID
        $post = R::load('posts', $id);
        // изменяем поля записи
        $post->name = $form['name'];
        $post->description = $form['description'];
        $post->text = $form['text'];
        $post->order = $form['order'];
        $post->status = $form['status'];
        $post->menu = $form['menu'];
        $post->parent = $form['parent'];
        $post->edate = date("d-m-Y H:i:s");
        // сохраняем изменения в базу данных
        R::store($post);
        // выводим сообщение об успешном обновлении записи
        return $id;
        //echo "Запись с ID $id успешно обновлена";
    }
    public function deletePost($id) {
        // загружаем запись из базы данных с заданным ID
        $post = R::load('posts', $id);
        // изменяем поля записи
        $post->status = 'deleted';
        // сохраняем изменения в базу данных
        R::store($post);
        // выводим сообщение об успешном обновлении записи
        //echo "Запись с ID $id успешно обновлена";
    }
    public function UploadImgPost($path, $id) {
        // Должен потдерживать хостинг
        //$img = new Imagick($path);
        //$img->cropThumbnailImage(1024, 1024);
        //$img->setImageCompressionQuality(80);
        //$img->writeImage($path, 'public/pic/'.$id.'.jpg');
        move_uploaded_file($path, 'public/pic/post-'.$id.'.jpg');
    }
    public function postsNavigation(){
        $id = $_SESSION['post_id'];
        $data = R::load( 'posts', $id );
        $id = $data->id;
        $parent = $data->parent;
        $name = $data->name;
        $arr_posts[] = '
            <input type="text" name="id" value="'.$id.'" hidden>
            <button type="submit" class="btn btn-link admin-btn" style="color:#a9ff00!important;">'.$name.'</button>
        ';
        while ($parent != 0) {
            $data = R::load( 'posts', $parent );    
            $id = $data->id;
            $parent = $data->parent;
            $name = $data->name;
            $arr_posts[] = '
                <input type="text" name="id" value="'.$id.'" hidden>
                <button type="submit" class="btn btn-link admin-btn">'.$name.'</button>
            ';
        }
        $arr_posts = array_reverse($arr_posts);
        //$this->navigation = $arr_posts;
        $result = [
            'arr_posts' => $arr_posts,
        ];
        $this->navigation = $result;
    } 

    public function userValidate($post, $type){
        if (trim($post['login']) == '') {
            $this->error = 'Введите логин';
            return false;
        }
        if (trim($post['email']) == '') {
            $this->error = 'Введите E-mail';
            return false;
        }
        if (trim($post['name']) == '') {
            $this->error = 'Введите Имя';
            return false;
        }
        if ($post['password'] == '') {
            $this->error = 'Введите password';
            return false;
        }
        if (R::count('users', "login = ?", array($post['login'])) > 0) {
            $this->error = 'Пользователь с таким логин уже существует!';
            return false;
        }
        if (R::count('users', "email = ?", array($post['email'])) > 0) {
            $this->error = 'Пользователь с таким E-mail уже существует!';
            return false;
        }
        /*
        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
            $this->error = 'Изображение не выбрано';
            return false;
        }
        */
        return true;
    }
    public function userEditValidate($post){

        if (trim($post['login']) == '') {
            $this->error = 'Введите логин';
            return false;
        }
        if (trim($post['email']) == '') {
            $this->error = 'Введите E-mail';
            return false;
        }
        if (trim($post['name']) == '') {
            $this->error = 'Введите Имя';
            return false;
        }
        $user = R::load('users', $post['id']);
        if ($post['login'] != $user['login']) {
            if (R::count('users', "login = ?", array($post['login'])) > 0) {
                $this->error = 'Пользователь с таким логин уже существует!';
                return false;
            }
        }
        if ($post['email'] != $user['email']) {
            if (R::count('users', "email = ?", array($post['email'])) > 0) {
                $this->error = 'Пользователь с таким E-mail уже существует!';
                return false;
            } 
        }
        return true;
    }
    public function userPassValidate($post){
        if ($post['password'] == '') {
            $this->error = 'Введите password';
            return false;
        }        
        return true;
    }
    public function addUser($form) {
        // создаем новую запись в таблице "users"
        $user = R::dispense('users');
        // задаем значения для полей записи
        $user->login = $form['login'];
        $user->name = $form['name'];
        $user->email = $form['email'];
        $user->acl = $form['acl'];
        $user->password = password_hash($form['password'], PASSWORD_DEFAULT);
        $user->status = 'enabled';
        $user->date = date("d.m.y G:i:s");
        // сохраняем запись в базу данных
        $id = R::store($user);
        // выводим сообщение об успешном добавлении записи
        //echo "Пользователь добавлен с ID: $id";
        return $id;
    } 
    public function editUser($id, $form) {
        // загружаем запись из базы данных с заданным ID
        $user = R::load('users', $id);
        // изменяем поля записи
        $user->login = $form['login'];
        $user->name = $form['name'];
        $user->email = $form['email'];
        $user->acl = $form['acl'];
        $user->edate = date("d-m-Y H:i:s");
        // сохраняем изменения в базу данных
        R::store($user);
        // выводим сообщение об успешном обновлении записи
        return $id;
        //echo "Запись с ID $id успешно обновлена";
    }
    public function editPassUser($id, $form) {
        // загружаем запись из базы данных с заданным ID
        $user = R::load('users', $id);
        // изменяем поля записи
        $user->password = password_hash($form['password'], PASSWORD_DEFAULT);
        $user->edate = date("d-m-Y H:i:s");
        // сохраняем изменения в базу данных
        R::store($user);
        // выводим сообщение об успешном обновлении записи
        return $id;
        //echo "Запись с ID $id успешно обновлена";
    }
    public function deleteUser($id) {
        // загружаем запись из базы данных с заданным ID
        $post = R::load('users', $id);
        // изменяем поля записи
        $post->status = 'deleted';
        // сохраняем изменения в базу данных
        R::store($post);
        // выводим сообщение об успешном обновлении записи
        //echo "Запись с ID $id успешно обновлена";
    }
    public function UploadImgUser($path, $id) {
        // Должен потдерживать хостинг
        //$img = new Imagick($path);
        //$img->cropThumbnailImage(1024, 1024);
        //$img->setImageCompressionQuality(80);
        //$img->writeImage($path, 'public/pic/'.$id.'.jpg');
        move_uploaded_file($path, 'public/pic/user-'.$id.'.jpg');
    }
}