<?php

class SearchController extends  FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $word =  ClearInput::clearInput($_POST['search'],'s');

            if(mb_strlen($word) <= 3){
                $errors[] = 'Введите больше 3-х ссимволов';
            }
            if(!isset($errors)){
                try{
                    $searched_products = $this->model->search($word);
                    $result = 'найдено ' . count($searched_products);
                }catch (Exception $e){
                    $errors[] = $e->getMessage();


                }
            }

        }

        $data = array(
            'title' => 'Поиск по сайту',
            'is_left_sidebar' => true,
            'is_logged'=>Session::is_logged(),
            'categories'=>$this->model->get_categories(),
            'products'=>$this->model->get_data(),
            'searched_products'=>(isset($searched_products)) ? $searched_products : null,
            'result'=>(isset($result)) ? $result : null,
            'word'=>(isset($word)) ? $word : null,
            'errors'=>(isset($errors)) ? $errors : null,
        );
        $this->view->render('search.twig',$data);
    }
}