<?php
class HdvController
{
    public $modelHdv;

    public function __construct()
    {
        $this->modelHdv = new HdvModel();
    }

    public function HomeHdv()
    {
        require_once './views/hdv/silderbar.php';
    }

}