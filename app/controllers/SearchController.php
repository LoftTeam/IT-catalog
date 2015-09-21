<?php

class SearchController extends  Controller
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Поиск по сайту',
            'is_left_sidebar' => true
        );
        $this->view->render('search.twig',$data);
    }
}