<?php

class AuthController extends  FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new UserModel;
    }

    function actionIndex()
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!ClearInput::validate_email($_POST['email'])) {
                $errors[] = 'Email не валидный';
            }
            $email = $_POST['email'];
            $password = ClearInput::clearInput($_POST['password'],'s');
            if(strlen($password) < 6){
                $errors[] = 'Введено меньше 6 символов';
            }


            if(!$user = $this->model->getUserByEmail($email)) {
                $errors[] = 'Неверен Email';
            }
            if($user['password'] != UserModel::encrypt_pass($password)) {
                $errors[] = "Пароль не верен";
            }

            if(!isset($errors)) {
                $hash = md5(UserModel::generateCode(10));

                $this->model->updateUserHashById($user['id'],$hash);

                $ses_data = array(
                    'id'=> $user['id'],
                    'name'=> $user['name'],
                    'role' =>$user['role'],
                    'is_logged'=>Session::is_logged(),
                );

                $this->session->start($ses_data,$hash);

                if($user['role'] == 2){
                    header("Location: /admin/");
                }else{
                    header("Location: / ");
                }
            }
        }
            $data = array(
                'title' => 'Авторизация',
                'is_logged'=>Session::is_logged(),
                'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : null,
                'errors'=>(isset($errors)) ? $errors : null
            );
            $this->view->render('auth_view.twig',$data);

    }

    public function actionLogout()
    {
        Session::delete();

        header("Location: / ");
    }
}