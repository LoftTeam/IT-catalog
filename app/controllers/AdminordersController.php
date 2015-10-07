<?php

class AdminordersController extends  BackendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Заказы',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/orders/index.twig',$data);
    }
}