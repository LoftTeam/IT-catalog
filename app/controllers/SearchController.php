<?php

class SearchController extends  FrontendController
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Поиск по сайту',
            'is_left_sidebar' => true,
            'is_logged'=>Session::is_logged(),
        );
        $this->view->render('search.twig',$data);
    }
}