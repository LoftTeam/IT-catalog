<?php

class RegisterController extends  Controller{

    public function __construct(){
        parent::__construct();
        $this->model = new RegisterModel;
    }

    function actionIndex()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = '';
        $errors = array();

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!RegisterModel::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-ух символов';
            }

            if(!RegisterModel::checkEmail($email)){
                $errors[] = 'Некорректный Email';
            }

            if($this->model->checkEmailExists($email)){
                $errors[] = 'Такой Email уже используется';
            }

            if(!RegisterModel::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-и символов';
            }

            if($errors == false){
                // SAVE USER
                $result = $this->model->signUp($name, $email, $password);
            }
        }

        $data = array(
            'title' => 'Регистрация',
            'result'=>$result,
            'errors'=>$errors,
        );
        $this->view->render('register.twig',$data);

    }
}