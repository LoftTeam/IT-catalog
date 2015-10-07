<?php

class ContactsController extends  FrontendController
{

    public function __construct(){
        parent::__construct();
        $this->model = new ContactModel();
    }

    function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }

    function actionIndex()
    {
        $managers =  $this->model->getManagers();

        /*  Google capcha settings */
        $config = parse_ini_file(ROOT."/app/config/config.ini");
        $secret = $config['Secret_key'];
        $publicKey = $config['Site_key'];

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $recaptcha=$_POST['g-recaptcha-response'];

            if(!empty($recaptcha))
            {
                $google_url="https://www.google.com/recaptcha/api/siteverify";
                $ip=$_SERVER['REMOTE_ADDR'];
                $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
                $res=$this->getCurlData($url);
                $res= json_decode($res, true);
                //reCaptcha введена
                if($res['success'])
                {
                    $fio = ClearInput::clearInput($_POST['fio'],'s');
                    if(mb_strlen($fio) < 6 ){
                        $errors[] = 'Поле ФИО должно иметь больше 6 символов';
                    }
                    if(!$phone = ClearInput::cheackPhone($_POST['tel'])){
                        $errors[] = 'Телефон должен быть из 10 цифр например:  044 537 02 22';
                    }
                    if(!$email = ClearInput::validate_email($_POST['email'])){
                        $errors[] = 'Email не валидный';
                    }

                    $message = ClearInput::clearInput($_POST['message'],'s');
                    if(mb_strlen($message) < 6){
                        $errors[] = 'Сообщение должно иметь больше 6 символов';
                    }
                }
                else
                {
                    $errors[] = "Please re-enter your reCAPTCHA.";
                }
            }
            else
            {
                $errors[] = "Please re-enter your reCAPTCHA.";
            }

            if(!isset($errors)){

                $body = "ФИО: $fio <br/>
                      Телефон: $phone <br/>
                      Email: $email <br/>
                      $message";
                $subject = 'Форма связаться с нами';
                $emails[] = $config['admin_email'];

                try {
                    $mail = new SendEmail($body,$emails,$subject);
                    $result = 'Письмо успешно отправлено';

                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }
        }

        $data = array(
            'title' => 'Контакты',
            'is_left_slider' => true,
            'is_right_slider' => true,
            'is_logged'=>Session::is_logged(),
            'managers'=> $managers,
            'errors'=> (isset($errors)) ? $errors : null,
            'result'=> (isset($result)) ? $result : null,
            'capchaPublicKey' =>$publicKey
        );
        $this->view->render('contact_view.twig',$data);


    }
}