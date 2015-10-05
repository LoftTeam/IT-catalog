<?php

class RegisterModel extends Model{

    public function signUp($name, $lastname, $bithday, $email, $password){

        $sql = 'INSERT INTO users (name, lastname, birthday, email, password) '
            . 'VALUES (:name,:lastname,:bithday, :email, :password)';

        $result = $this->DB->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':bithday', $bithday, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name){
        if(strlen($name) >= 2){
            return true;
        }
        return false;
    }

    public static function checkDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public function checkEmailExists($email){
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
        $result = $this->DB->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()){
            return true;
        }
        return false;
    }

    public static function checkPassword($password){
        if(strlen($password) >= 6){
            return true;
        }
        return false;
    }

}
