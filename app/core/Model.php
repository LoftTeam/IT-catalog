<?php

abstract class Model
{
    /**
     * @var DB
     */
    protected $DB;
    private $settings;

    public function __construct(){
        try {

            $this->settings = parse_ini_file(ROOT."/app/config/config.ini");
            $dsn = 'mysql:dbname='.$this->settings["dbname"].';host='.$this->settings["host"].'';

            $this->DB = new PDO($dsn, $this->settings["user"],$this->settings["password"]);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DB->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {
            echo 'Невозможно подключиться к серверу баз данных.';
            exit();
        }
    }


    public function get_data(){}
}