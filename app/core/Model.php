<?php

abstract class Model
{
    /**
     * @var PDO
     */
    protected $_pdo;

    public function __construct(){
        $this->_pdo = new PDO('mysql:dbname=loft_catalog;host=localhost', 'root', '');
        $this->_pdo->query("SET NAMES 'utf8'");
    }


    public function get_data(){}
}