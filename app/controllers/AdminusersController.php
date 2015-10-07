<?php

class AdminusersController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new UserModel;
    }

    function actionIndex()
    {

        $data = array(
            'title' => 'Пользователи',
            'is_logged'=>Session::is_logged(),
            'users'=>$this->model->getAllusers(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/users/index.twig',$data);
    }
}