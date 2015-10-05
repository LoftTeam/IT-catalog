<?php

class AboutController extends  FrontendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'О Компании',
            'is_slider' => true,
            'is_right_sidebar' => true,
            'is_logged'=>Session::is_logged(),
        );
        $this->view->render('about.twig',$data);
    }
}