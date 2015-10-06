<?php


class BackendController extends Controller
{
    function __construct()
    {
        parent::__construct();

        if((Session::is_logged() === false) or $_SESSION['role'] != 2 ) {
            header("Location: /auth/index/ ");
        }

    }

    function actionIndex(){}
}