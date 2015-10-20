
<?php

class SendEmail
{
    private $mail;
    private $body;

    function __construct()
    {
        $config = parse_ini_file(ROOT."/app/config/config.ini");
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->Host = $config['smtp_host'];
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = $config['smtp_SMTPSecure'];
        $this->mail->CharSet = $config['smtp_charset'];
        $this->mail->Port = $config['smtp_port'];
        $this->mail->Username = $config['smtp_username'];
        $this->mail->Password = $config['smtp_password'];
        $this->mail->setFrom($config['smtp_email'], 'Администратор LoftTeam');
    }

    public function send($msg,$emails,$subjects)
    {
        $this->mail->Subject = $subjects;
        $this->mail->Body = $msg;
        $emails = (array)$emails;
        foreach($emails as $email){
            $this->mail->AddAddress($email,$email);
        }

        if(!$this->mail->send()) {
            throw new Exception('Сообщение не отпарвлено');
        }
    }













}

