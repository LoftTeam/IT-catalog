<?php


class UserModel extends Model
{
    public function getAllusers()
    {
        $sql = "SELECT id,name,lastname,birthday,email,password,is_active,role,reg_date,last_update,user_hash
            FROM users;";

        $result = $this->DB->prepare($sql);
        $result->execute();

        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }

    public static function encrypt_pass($password)
    {
        return  md5(md5(trim($password)));
    }

    /*
     * Получить пользователя по Id
     */
    public function getUserByID($id)
    {
        $sql = "SELECT id,name,lastname,birthday,email,password,is_active,role,reg_date,last_update,user_hash
            FROM users
            WHERE id = :id;
        ";

        $result = $this->DB->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->execute();

        $records = $result->fetch(PDO::FETCH_ASSOC);
        return $records;

    }
    /*
     * Получить пользователя по Email
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT id,name,lastname,birthday,email,password,is_active,role,reg_date,last_update,user_hash
            FROM users
            WHERE email = :email;
        ";

        $result = $this->DB->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();

        $records = $result->fetch(PDO::FETCH_ASSOC);
        return $records;

    }

    /*
    * Функция для генерации случайной строки
    */
    public static function  generateCode($length=6) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

        $code = "";

        $clen = strlen($chars) - 1;
        while (strlen($code) < $length){
            $code .= $chars[mt_rand(0,$clen)];
        }

         return $code;
    }

    public function updateUserHashById($id,$hash)
    {
        $sql = 'UPDATE users SET user_hash = :hash
                WHERE id = :id';

        $result = $this->DB->prepare($sql);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->execute();
    }


}