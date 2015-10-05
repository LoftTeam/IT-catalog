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
            'is_logged'=>Session::is_logged(),
        );

        $this->view->render('main_view.twig',$data);
    }
}