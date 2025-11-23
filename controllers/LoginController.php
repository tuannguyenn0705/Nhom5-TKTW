<?php
class LoginController
{
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $user = new LoginModel();
            $data = $user->Login();

            if($data){
                $_SESSION['user'] = $data;

                // Kiểm tra role
                if ($data['Role'] == '1') {
                    header('Location: ' . BASE_URL . '?mode=admin');  // Admin
                    exit;
                } else if ($data['Role'] == '0') {
                    header('Location: ' . BASE_URL . '?mode=hdv');  // Hướng dẫn viên
                    exit;
                }
            } else {
                $_SESSION['failed'] = 'Vui lòng đăng nhập lại';
                header('Location: ' . BASE_URL . '/');
                exit;
            }
        } else {
            require_once './views/login.php';
        }
    } 
    public function logout(){
        $user = new LoginModel();
        $data = $user->logout();
        header('location:'.BASE_URL);
        exit;
    }
}
