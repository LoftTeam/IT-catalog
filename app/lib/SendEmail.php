
<?php

class SendEmail
{
    private $mail;
    private $body;

    function __construct($msg,$emails,$subjects)
    {
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mail.ru';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Port = 465;
        $this->mail->Username = 'loftteam@mail.ru';
        $this->mail->Password = '5F6GVToU';
        $this->mail->setFrom('loftteam@mail.ru', 'Администратор LoftTeam');
        $this->send($msg,$emails,$subjects);
    }

    private function send($msg,$emails,$subjects)
    {

        $this->mail->Subject = $subjects;
        $this->mail->Body = $msg;

        foreach($emails as $email){
            $this->mail->AddAddress($email,$email);
        }

        if(!$this->mail->send()) {
            throw new Exception('Сообщение не отпарвлено');
        }
    }













}

