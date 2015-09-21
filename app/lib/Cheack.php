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
            case 's':
                $data = trim(strip_tags($data)); break;

        }
        return $data;
    }
}