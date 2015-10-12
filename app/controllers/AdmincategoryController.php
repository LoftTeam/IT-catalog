<?php

class AdmincategoryController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

    public function actionIndex()
    {
        $data = array(
            'title' => 'Категории товаров',
            'is_logged'=>Session::is_logged(),
            'categories'=>$this->model->get_categories(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/category/index.twig',$data);
    }

    public function actionCreate()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $category_name = ClearInput::clearInput($_POST['category_name'],'s');

            if(mb_strlen($category_name) < 2 ){
                $errors[] = 'Название должно иметь больше двух символов';
            }

            if(!isset($errors)){
                try{
                    $this->model->add_category($category_name);
                    $result = 'Категория успешно добавлена';
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                };
            }

        }

        $data = array(
            'title' => 'Создание категории товаров',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null

        );
        $this->view->render('admin/category/create.twig',$data);
    }

    public function actionEdit($id)
    {
        $id = (int)$id[0];

        try{
            $category = $this->model->find_category_by_id($id);
        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_name = ClearInput::clearInput($_POST['category_name'],'s');

            if(mb_strlen($category_name) < 2 ){
                $errors[] = 'Название должно иметь больше двух символов';
            }

            if(!isset($errors)){
                try{
                    $this->model->update_category_by_id($id,$category_name);
                    $result = 'Категория изменина успешно';
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }
        }

        $data = array(
            'title' => 'Редактирование категории товаров',
            'is_logged'=>Session::is_logged(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'category'=> (isset($category)) ? $category : null
        );
        $this->view->render('admin/category/edit.twig',$data);
    }

    public function actionDelete($id)
    {
        $id = (int)$id[0];
        try{
            $this->model->delete_category_by_id($id);
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/adminproducts/index/';
            header('Location:' . $host);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}