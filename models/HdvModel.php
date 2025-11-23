<?php 

class HdvModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function logout(){
        session_unset();
        session_destroy();
    }

}