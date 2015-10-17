<?php

class AdminusersController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new UserModel;
    }

    public function actionIndex()
    {
        $data = array(
            'title' => 'Пользователи',
            'is_logged'=>Session::is_logged(),
            'users'=>$this->model->getAllusers(),
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/users/index.twig',$data);
    }

    public function actionEdit($id = array('1'))
    {
        $id = (int)$id[0];

        try{
            $user = $this->model->getUserByID($id);
        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $is_active = $_POST['is_active'];
            $role = $_POST['role'];

            try{
                $result = $this->model->update_user_role_active_by_id($id,$is_active,$role);
                $result = 'Пользователь '.$user['name']. ' успешно именен';
            }catch (Exception $e){
                $errors[] = $e->getMessage();
            }
        }

        $data = array(
            'title' => 'Редактирование пользователей',
            'is_logged'=>Session::is_logged(),
            'user'=>$user,
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/users/edit.twig',$data);
    }
}