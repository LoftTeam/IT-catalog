<?php

class ContactsController extends  Controller
{
    function actionIndex()
    {
        $data = array(
            'title' => 'Контакты',
            'is_left_slider' => true,
            'is_right_slider' => true,
        );
        $this->view->render('contact_view.twig',$data);
    }
}