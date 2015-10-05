<?php


class Session
{
    private $data = array();
    private $alive = false;

    function __construct()
    {
        session_start();
    }

    public static function delete()
    {
        session_destroy();

        unset($_COOKIE['id']);
        setcookie('id', null, -1, '/');

        unset($_COOKIE['hash']);
        setcookie('hash', null, -1, '/');
    }

    public function start($data,$hash)
    {
        session_start();

        setcookie("id", $data['id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_name'] = $data['name'];
        $_SESSION['role'] = $data['role'];
    }

    public static function is_logged()
    {
        if(isset($_COOKIE['id']) and isset($_COOKIE['hash'])){

            $model = new UserModel();

            if($user = $model->getUserByID($_COOKIE['id'])){
                if($user['user_hash'] == $_COOKIE['hash']){
                    return true;
                }
            }
        }
        return false;
    }
}
