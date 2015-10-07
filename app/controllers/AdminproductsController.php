<?php

class AdminproductsController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        $data = array(
            'title' => 'Товары',
            'is_logged'=>Session::is_logged(),
            'products'=>$this->model->get_data(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/products/index.twig',$data);
    }
}