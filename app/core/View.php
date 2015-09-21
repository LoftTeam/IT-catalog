<?php

class View
{
    public $loader;
    public $twig;
    public $path = ROOT . '/app/views/skins';

    function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem($this->path);
        $this->twig = new Twig_Environment($this->loader);
    }

    function render($content_view,$data)
    {
        echo $this->twig->render($content_view, $data);
    }


}