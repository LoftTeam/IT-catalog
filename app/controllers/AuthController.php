<?php

class AuthController extends  Controller
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Авторизация',
        );
        $this->view->render('auth_view.twig',$data);
    }
}