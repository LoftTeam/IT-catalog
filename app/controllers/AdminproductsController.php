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
            'categories'=>$this->model->get_categories(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/products/index.twig',$data);
    }

    public function actionCreate()
    {
        try{
            $categories = $this->model->get_categories();

        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $product_name = ClearInput::clearInput($_POST['product_name'],'s');
            if(mb_strlen($product_name) < 2 ){
                $errors[] = 'Название должно иметь больше двух символов';
            }
            $product_img = ClearInput::clearInput($_POST['product_img'],'s');
            $mark = ClearInput::clearInput($_POST['mark'],'s');
            if(mb_strlen($mark) < 2 ){
                $errors[] = 'Бранд должн иметь больше двух символов';
            }
            $count = ClearInput::clearInput($_POST['count'],'i+');
            $price = ClearInput::clearInput($_POST['price'],'f');
            $description = ClearInput::clearInput($_POST['description'],'s');
            $category_id = ClearInput::clearInput($_POST['category_id'],'i+');

            if(!isset($errors)){
                try{
                    $this->model->add_product($product_name,$product_img,$mark,$count,$price,$description,$category_id);
                    $result = 'Товар успешно добавлен';
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                };
            }
        }

        $data = array(
            'title' => 'Создать товпр',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'categories'=> (isset($categories)) ? $categories : null
        );
        $this->view->render('admin/products/create.twig',$data);
    }

    public function actionEdit($id)
    {
        $id = (int)$id[0];

        try{
            $product = $this->model->get_product($id);
            $categories = $this->model->get_categories();

        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $product_name = ClearInput::clearInput($_POST['product_name'],'s');
            if(mb_strlen($product_name) < 2 ){
                $errors[] = 'Название должно иметь больше двух символов';
            }
            $product_img = ClearInput::clearInput($_POST['product_img'],'s');
            $mark = ClearInput::clearInput($_POST['mark'],'s');
            if(mb_strlen($mark) < 2 ){
                $errors[] = 'Бранд должн иметь больше двух символов';
            }
            $count = ClearInput::clearInput($_POST['count'],'i+');
            $price = ClearInput::clearInput($_POST['price'],'f');
            $description = ClearInput::clearInput($_POST['description'],'s');
            $category_id = ClearInput::clearInput($_POST['catalog_id'],'i+');

            if(!isset($errors)){
                try{
                    $this->model->update_product($id,$product_name,$product_img,$mark,$count,$price,$description,$category_id);
                    $result = 'Товар успешно Именен';
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                };
            }
        }

        $data = array(
            'title' => 'Редактировать товпр',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'product'=> (isset($product)) ? $product : null,
            'categories'=> (isset($categories)) ? $categories : null
        );
        $this->view->render('admin/products/edit.twig',$data);
    }

    public function actionDelete($id)
    {
        $id = (int)$id[0];
        try{
            $this->model->delete_product_by_id($id);
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/admincategory/index/';
            header('Location:' . $host);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}