<?php

abstract class Controller
{
    /**
     * @var Model
     */
    public $model;
    public $view;
    public $session;
    public $data;

    function __construct()
    {
        $this->view = new View();
        $this->session = new Session();
        $this->data['is_logged'] = Session::is_logged();
    }

    abstract function actionIndex();

}