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
                if($user['id'] != $_SESSION['user_id']){
                    if($user['password'] == UserModel::encrypt_pass($password)){
                        $hash = md5(UserModel::generateCode(10));

                        $this->model->updateUserHashById($user['id'],$hash);

                        $data = array(
                            'id'=> $user['id'],
                            'name'=> $user['name'],
                            'is_active' => $user['is_active'],
                            'role' =>$user['role'],
                            'is_logged'=>Session::is_logged(),
                        );
                        $this->session->start($data,$hash);

                        if($user['role'] == 2){
                            header("Location: /admin/");
                        }else{
                            header("Location: / ");
                        }
                }else{
                        $errors[] = "Пользователь {$user['name']} уже авторизирован";
                    }
                }else{

                }
            }else{
                $errors[] = 'Неверен Email';
            }
        }else{

            $data = array(
                'title' => 'Авторизация',
                'is_logged'=>Session::is_logged(),
                'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : null,
            );
            $this->view->render('auth_view.twig',$data);
        }
    }

    public function actionLogout()
    {
        Session::delete();

        header("Location: / ");
    }
}