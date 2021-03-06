<?php

class ProductsController extends  FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['category_id']) ||
                isset($_POST['from']) ||
                isset($_POST['to']) ||
                isset($_POST['brand'])
            ){
                $category_id =  ClearInput::clearInput($_POST['category_id'],'i+');
                $from = ClearInput::clearInput($_POST['from'],'i+');
                $to = ClearInput::clearInput($_POST['to'],'i+');
                if(empty($to)){$to = 999999;}
                $brand = ClearInput::clearInput($_POST['brand'],'s');

                $data = array(
                    'title' => 'Продукция',
                    'is_left_sidebar' => true,
                    'is_filters_side'=>true,
                    'products' => $this->model->filter_data($category_id,$from,$to,$brand),
                    'categories'=> $this->model->get_categories(),
                    'is_logged'=>Session::is_logged(),
                );
                $this->view->render('products/index.twig',$data);
            }
        }else{
            $data = array(
                'title' => 'Продукция',
                'is_left_sidebar' => true,
                'is_filters_side'=>true,
                'products' => $this->model->get_data(),
                'categories'=> $this->model->get_categories(),
                'is_logged'=>Session::is_logged(),
            );
            $this->view->render('products/index.twig',$data);
        }
    }

    function actionView($id = array('1'))
    {
        $id = (int)$id[0];
        $data = $this->model->get_product($id);

        $data = array(
            'title' => $data['title'],
            'product_item' => $data,
            'categories'=>$this->model->get_categories(),
            'products'=>$this->model->get_data(),
            'is_logged'=>Session::is_logged(),
            'is_filters_side'=>true,
        );
        $this->view->render('products/item.twig',$data);
    }

}