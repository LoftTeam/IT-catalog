
<?php

class Left_menu
{
    public $cat;

    public function __construct($cat)
    {
        $this->cat = $cat;
    }

    public function get_left_menu()
    {
        $res = array();
        $cat =  $this->cat;
        for($i=0,$data=count($cat); $i<$data;$i++ )
        {
            $res[] = $cat[$i];
        }

        var_dump($res);
    }

    public function get_left_category()
    {

    }
}

