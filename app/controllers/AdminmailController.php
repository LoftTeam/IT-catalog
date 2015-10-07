<?php

class AdminmailController extends  BackendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Рассылка писем',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/mail/index.twig',$data);
    }
}