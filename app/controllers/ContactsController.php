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

                        $mail = new PHPMailer;

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->SMTPSecure = 'ssl';
                        $mail->CharSet = 'UTF-8';
                        $mail->Port = 465;                                    // TCP port to connect to

                        $body = "ФИО: $fio <br/>
                                         Телефон: $phone <br/>
                                        Email: $email <br/>
                                        $message";

                        $mail->Username = 'loftteam@mail.ru';           // SMTP username
                        $mail->Password = '5F6GVToU';                         // SMTP password

                        $mail->setFrom('loftteam@mail.ru', 'Администратор LoftTeam');

                        $mail->Subject = 'ВЫдуманная тема письма';
                        $mail->Body = $body;

                        $adress = 'eugenevasilsov@gmail.com';
                        $mail->AddAddress($adress,'Евгению Васильцову');

                        if(!$mail->send()) {
                            $errors[] = 'Сообщение не доставлено!';
                        } else {
                            $result = 'Сообщение успешно доставлено!';
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