<?php

abstract class Controller
{
    /**
     * @var Model
     */
    public $model;
    public $view;
    public $session;

    function __construct()
    {
        $this->view = new View();
        $this->session = new Session();
    }

    abstract function actionIndex();

}