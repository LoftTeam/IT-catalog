<?php

class AboutController extends  FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        $data = array(
            'title' => 'О Компании',
            'is_slider' => true,
            'is_right_sidebar' => true,
            'is_logged'=>Session::is_logged(),
            'categories'=>$this->model->get_categories(),
            'products'=>$this->model->get_data(),
        );
        $this->view->render('about.twig',$data);
    }
}