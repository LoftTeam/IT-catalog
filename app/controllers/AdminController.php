<?php

class AdminController extends  Controller
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Административная панель',
        );
        $this->view->render('admin/index.twig',$data);
    }
}