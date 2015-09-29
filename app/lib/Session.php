<?php


class Session
{
    private $alive = false;

    function __construct()
    {
        session_start();
    }

    function __destruct()
    {

    }

    public function delete()
    {
        session_destroy();
        $this->alive = false;
    }

    public function start()
    {
        $this->alive = true;
    }

    public function status()
    {
        var_dump($this->alive);
    }

    private function read($sid)
    {

    }

    private function write($sid, $data)
    {

    }

    private function destroy($sid)
    {

    }


}
