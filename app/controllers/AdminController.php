<?php

class AdminController extends  BackendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Административная панель',
        );
        $this->view->render('admin/index.twig',$data);
    }
}