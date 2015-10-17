<?php

class ClearInput
{
    public function __construct(){

    }
    public static  function clearInput($data, $type = 's'){

        switch($type){
            case 'i+':
                $data = abs((int)$data); break;
            case 'i':
                $data = (int)($data); break;
            case 'd':
                $data = (double)$data; break;
            case 'f':
                $data = floatval($data); break;
            case 's':
                $data = trim(strip_tags($data)); break;

        }
        return $data;
    }

    public static function cheackPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if(strlen($phone) === 10) {
            return $phone;
        }
        return false;
    }

    public static function validate_email($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $email;
        }
        return false;
    }
}