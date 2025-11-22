<?php
class LoginModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function Login()
    {
        $sql = "SELECT * FROM `taikhoan` WHERE Email = :Email AND Password = :Password";
        $stmt = $this->conn->prepare($sql);
        $email = $_POST['Email'];
        $password = md5($_POST['Password']); // MÃ HÓA MD5
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':Password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function logout(){
        session_unset();
        session_destroy();
    }

}
