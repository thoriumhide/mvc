<?php
namespace app\controllers;
use app\core\Controller;
use app\core\View;
use app\lib\Pagination;
use R;

class MainController  extends Controller{

    public function  indexAction() {
        //$this->model->addUser();
        //$this->model->editUser(8);
        //$this->model->allUsers();

        $this->view->render('Головна сторінка');
        //debug($_SESSION['logged_user']);
    }
    public function  postsAction() {
        $pagination = new Pagination($this->route, $this->model->postsCount(), 10);
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];
        $mergedArray = array_merge($vars, $this->model->data);
        $this->view->render('Страница постов', $mergedArray);
    }
    public function  postAction() {
        //debug($this->route['id']);
        if (!$this->model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $this->model->loadPost($this->route['id']);
        $this->view->render('Страница редактирования поста', $this->model->data);    
    }
    public function  contactAction() {
        if (!empty($_POST)) {
            if(!$this->model->contactValidate($_POST)){
                $this->view->message('Ошибка', $this->model->error, 'error');
            }
            // Отправка сообщение из формы 
            // mail('admin@blackgard.com', 'Сообщение из сайта', $_POST['text']);
            $this->view->message('Готово', 'Сообщение отправлено', 'success');
        }
        $this->view->render('Сторінка контакти');
    }
}