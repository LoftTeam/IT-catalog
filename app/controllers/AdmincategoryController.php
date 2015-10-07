<?php

class AdmincategoryController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        $data = array(
            'title' => 'Категории товаров',
            'is_logged'=>Session::is_logged(),
            'categories'=>$this->model->get_categories(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/category/index.twig',$data);
    }
}