<?php

class MainController extends FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        $data = array(
            'title' => 'Главная страница',
            'is_photo_slider' => true,
            'is_slider' => true,
            'is_right_sidebar' => true,
            'categories'=>$this->model->get_categories(),
            'products'=>$this->model->get_data(),
            'is_logged'=>Session::is_logged(),
        );

        $this->view->render('main_view.twig',$data);
    }
}