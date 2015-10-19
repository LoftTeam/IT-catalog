<?php

class AdminmailController extends  BackendController
{
    function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $whom = ClearInput::clearInput($_POST['whom'],'i+');
            $subject = ClearInput::clearInput($_POST['subject'],'s');
            if(mb_strlen($subject) < 3 ){
                $errors[] = 'Тема письма должна содежать более 3 символов';
            }
            $text = ClearInput::clearInput($_POST['text']);
            if(mb_strlen($subject) < 3 ){
                $errors[] = 'Текст письма должен содежать более 3 символов';
            }
            //если клиенты, вытаскиваем все email
            if(!isset($errors) && ($whom == 0)){
                try{
                    //Получение email всех клиентов
                    $user = new UserModel();
                    $user = $user->getAllusers_by_role($whom);
                    $uc = sizeof($user);
                    for($i=0;$i<$uc;++$i){
                        $uEmails[] = $user[$i]['email'];
                    }
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }
            //если администраторы, вытаскиваем все email
            if(!isset($errors) && ($whom == 2)){
                try{
                    //Получение email всех клиентов
                    $user = new UserModel();
                    $user = $user->getAllusers_by_role($whom);
                    $uc = sizeof($user);
                    for($i=0;$i<$uc;++$i){
                        $uEmails[] = $user[$i]['email'];
                    }
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }
            //отправка писем
            if(isset($uEmails) && !isset($errors)){
                try {
                    $mail = new SendEmail($text,$uEmails,$subject);
                    $result = 'Письма успешно отправлены';

                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }

        }
        $data = array(
            'title' => 'Рассылка писем',
            'is_logged'=>Session::is_logged(),
            'errors'=>(isset($errors)) ? $errors : null,
            'result'=>(isset($result)) ? $result : null,
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/mail/index.twig',$data);
    }
}