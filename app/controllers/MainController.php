<?php

class MainController extends FrontendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Главная страница',
            'is_photo_slider' => true,
            'is_slider' => true,
            'is_right_sidebar' => true,

        );

        $this->view->render('main_view.twig',$data);
    }
}