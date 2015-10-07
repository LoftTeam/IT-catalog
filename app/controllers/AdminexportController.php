<?php

class AdminexportController extends BackendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'ВЫгрузка/загрузка товаров',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/export/index.twig',$data);
    }
}