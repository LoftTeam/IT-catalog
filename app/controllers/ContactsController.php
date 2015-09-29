<?php

class ContactsController extends  FrontendController
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