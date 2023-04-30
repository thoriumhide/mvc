<?php
namespace app\controllers;
use app\core\Controller;
use app\lib\Pagination;
use R;

class AdminController extends Controller{
    public function __construct($route) {
        parent::__construct($route);
        //Смена шаблона
        $this->view->layout = 'apanel';
    }
    //------ Головна сторінка панелі адміністратора ------
    public function indexAction() {

        //var_dump($_SESSION);
        $this->view->render('Страница админ панели');
    }    
    //------ Вход в панель адміністратора ------
    public function loginAction() {
        if (isset($_SESSION['logged_user'])) {
            $this->view->redirect('admin');  
        }        
        if (!empty($_POST)) {
            if(!$this->model->loginValidate($_POST)){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            $_SESSION['logged_user'] = true;
            $_SESSION['post_id'] = 0;
            $_SESSION['page_id'] = 0;
            $this->view->location('admin');
        }
        $this->view->render('Панель Адміністратора');
    }
    //------ Функція виходу із панелі адміністратора ------
    public function logoutAction() {
        unset($_SESSION['logged_user']);
        $this->view->redirect('admin/login');
    }
    //------ Функція регістрації користувача блогу ------
    public function registerAction() {
        $this->view->render('Страница регистрации');
    }
    public function settingsAction() {

        if (!empty($_POST)) {
            $this->model->editSettings($_POST);
            $this->model->UploadFavicon($_FILES['img']['tmp_name']);
            $this->view->message('Готово', 'Дані збережено', 'success');
        }
        $this->model->loadSettings();
        $this->view->render('Налаштування адмін панелі', $this->model->setting);
    } 


    //------ Сторінки ------ 
    public function pagesAction() {
        if (!empty($_POST)) {
            if($_POST['form_id'] == 'do_page'){
                $_SESSION['page_id'] = $_POST['id'];
                $this->view->location('admin/pages/');
                //$this->view->message('Выбран пост', $_SESSION['post_id'], 'success');
            }
            if($_POST['form_id'] == 'do_home'){
                $_SESSION['page_id'] = $_POST['id'];
                $this->view->location('admin/pages/');
            }
        }
        $pagination = new Pagination($this->route, $this->model->pagesCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->pagesList($this->route),
        ];
        $this->model->pagesNavigation();
        $mergedArray = array_merge($vars, $this->model->data, $this->model->page_navigation);
        $this->view->render('Сторінки', $mergedArray);
    }
    //------ Створення сторінки ------ 
    public function add_pageAction() {
        if (!empty($_POST)) {
            if(!$this->model->pageValidate($_POST, 'add')){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            $id = $this->model->addPage($_POST);
            $this->model->UploadImgPage($_FILES['img']['tmp_name'], $id);
            //$this->view->message('Готово', 'Пользователь добавлен c id='.$id, 'success');
            $this->view->location('admin/edit_page/'.$id);
        }
        $this->view->render('Створення сторінки');
    } 
    //------ Редагування сторінки ------  
    public function edit_pageAction() {
        //debug($this->route);
        if (!$this->model->isPageExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if(!$this->model->pageValidate($_POST, 'edit')){
                $this->view->message('Помилка', $this->model->error, 'error');
            }
            $id = $this->model->editPage($this->route['id'] , $_POST);
            $this->model->UploadImgPage($_FILES['img']['tmp_name'], $id);
            $this->view->message('Готово', 'Сторінка збережена', 'success');
        }
        $this->model->loadPage($this->route['id']);
        $page_val = $this->model->data;
        $this->model->loadUser($this->model->data['page']['author_id']);
        $user_val = $this->model->data;
        $mergedArray = array_merge($user_val, $page_val);
        $this->view->render('Редагування сторінки', $mergedArray);
    }  
    //------ Видалення сторінки ------  
    public function delete_pageAction() {
        //var_dump($this->route['id']);
        $this->model->deletePage($this->route['id']);
        $this->view->redirect('admin/pages');
    }  

    //------ Пости ------ 
    public function postsAction() {
        if (!empty($_POST)) {
            if($_POST['form_id'] == 'do_post'){
                $_SESSION['post_id'] = $_POST['id'];
                $this->view->location('admin/posts/');
                //$this->view->message('Выбран пост', $_SESSION['post_id'], 'success');
            }
            if($_POST['form_id'] == 'do_home'){
                $_SESSION['post_id'] = $_POST['id'];
                $this->view->location('admin/posts/');
            }
        }
        $pagination = new Pagination($this->route, $this->model->postsCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];
        $this->model->postsNavigation();
        $mergedArray = array_merge($vars, $this->model->data, $this->model->navigation);
        $this->view->render('Пости', $mergedArray);
    }
    //------ Створення посту ------ 
    public function add_postAction() {
        if (!empty($_POST)) {
            if(!$this->model->postValidate($_POST, 'add')){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            $id = $this->model->addPost($_POST);
            $this->model->UploadImgPost($_FILES['img']['tmp_name'], $id);
            //$this->view->message('Готово', 'Пользователь добавлен c id='.$id, 'success');
            $this->view->location('admin/edit_post/'.$id);
        }
        $this->view->render('Сторінка дадавання поста');
    } 
    //------ Редагування посту ------  
    public function edit_postAction() {
        //debug($this->route);
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if(!$this->model->postValidate($_POST, 'edit')){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            $id = $this->model->editPost($this->route['id'] , $_POST);
            $this->model->UploadImgPost($_FILES['img']['tmp_name'], $id);
            $this->view->message('Готово', 'Пост сохранен', 'success');
        }
        $this->model->loadPost($this->route['id']);
        $this->view->render('Редагування поста', $this->model->data);
    }  
    //------ Видалення посту ------  
    public function delete_postAction() {
        //var_dump($this->route['id']);
        $this->model->deletePost($this->route['id']);
        $this->view->redirect('admin/users');

        //debug($this->route['id']);
        //exit('Exit');
        //$this->view->render('удалить');
    } 

    //------ Користувачі ------  
    public function usersAction() {
        $pagination = new Pagination($this->route, $this->model->usersCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->usersList($this->route),
        ];
        //$this->model->allUsers();
        $mergedArray = array_merge($vars, $this->model->data);
        $this->view->render('Користувачи', $mergedArray);   
    } 
    //------ Створення користувача ------ 
    public function add_userAction() {
        if (!empty($_POST)) {
            if(!$this->model->userValidate($_POST, 'add')){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            $id = $this->model->addUser($_POST);
            $this->view->message('Готово', 'Пользователь добавлен c id='.$id, 'success');
            //$this->view->location('admin/edit_post/'.$id);
        }
        $this->view->render('Додати нового користувача');
    } 
    //------ Редагування користувача ------
    public function edit_userAction() {
        if (!$this->model->isUserExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {

            if($_POST['form_id'] == 'do_pass_edit'){
                if(!$this->model->userPassValidate($_POST, 'edit')){
                    $this->view->message('Помилка', $this->model->error, 'error');
                }
                $id = $this->model->editPassUser($this->route['id'] , $_POST);
                $this->view->message('Готово', 'Новий пароль створено', 'success');
            }
            if($_POST['form_id'] == 'do_edit'){
                if(!$this->model->userEditValidate($_POST, 'edit')){
                    $this->view->message('Помилка', $this->model->error, 'error');
                }
                $id = $this->model->editUser($this->route['id'] , $_POST);
                $this->model->UploadImgUser($_FILES['img']['tmp_name'], $id);
                $this->view->message('Готово', 'Дані збережені', 'success');
            }

        }

        $this->model->loadUser($this->route['id']);
        $this->view->render('Редагування користувача', $this->model->data);
    } 
    //------ Видалення користувача ------  
    public function delete_userAction() {
        $this->model->deleteUser($this->route['id']);
        $this->view->redirect('admin/users');
    } 
}
