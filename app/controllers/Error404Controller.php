<?php

class Error404Controller extends  FrontendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Ошибка 404',
            'is_logged'=>Session::is_logged(),
        );
        $this->view->render('404_view.twig',$data);
    }
}