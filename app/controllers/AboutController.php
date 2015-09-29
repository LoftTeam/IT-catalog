<?php

class AboutController extends  FrontendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'О Компании',
            'is_slider' => true,
            'is_right_sidebar' => true
        );
        $this->view->render('about.twig',$data);
    }
}