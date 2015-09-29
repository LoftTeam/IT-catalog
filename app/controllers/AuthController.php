<?php

class AuthController extends  FrontendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new UserModel;
    }

    function actionIndex()
    {

        if(isset($_POST['submit'])){

            $email = $_POST['email'];
            $password = $_POST['password'];

            if($user = $this->model->getUserByEmail($email)){

                if($user['password'] == UserModel::encrypt_pass($password)){
                    $hash = md5(UserModel::generateCode(10));

                    UserModel::updateUserHashById($user['id'],$hash);

                    setcookie("id", $user['id'], time()+60*60*24*30);
                    setcookie("hash", $hash, time()+60*60*24*30);

                    $this->session->start();


                }else{
                    $errors[] = 'Неверен пароль';
                }
            }else{
                $errors[] = 'Неверен Email';
            }


        }else{

            $data = array(
                'title' => 'Авторизация',
            );

            $this->view->render('auth_view.twig',$data);
        }


    }
}