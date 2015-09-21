<?php

class Error404Controller extends  Controller
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Ошибка 404',
        );
        $this->view->render('404_view.twig',$data);
    }
}