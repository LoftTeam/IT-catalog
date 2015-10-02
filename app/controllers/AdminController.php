<?php

class AdminController extends  BackendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Административная панель',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/index.twig',$data);
    }
}