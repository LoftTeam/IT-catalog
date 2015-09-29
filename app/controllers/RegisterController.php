<?php

class RegisterController extends  FrontendController{

    public function __construct(){
        parent::__construct();
        $this->model = new RegisterModel;
    }

    function actionIndex()
    {
        $name = '';
        $lastname = '';
        $bithday = '';
        $email = '';
        $password = '';
        $result = '';
        $errors = array();

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $bithday = $_POST['bithday'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!RegisterModel::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-ух символов';
            }

            if(!RegisterModel::checkDate($bithday)){
                $errors[] = 'Дата рождения не валидна - '.$bithday;
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

            $password = UserModel::encrypt_pass($password);

            if($errors == false){
                // SAVE USER
                $result = $this->model->signUp($name, $lastname, $bithday , $email, $password);
            }
        }

        $data = array(
            'title' => 'Регистрация',
            'result'=> $result,
            'errors'=> $errors,
        );
        $this->view->render('register.twig',$data);

    }
}