<?php
class LoginController
{
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $user = new LoginModel();
            $data = $user->Login();

            if($data){
                $_SESSION['user'] = $data;

                if ($data['Role'] == '0') {
                    require_once './models/NhanSuModel.php';
                    $nhanSuModel = new NhanSuModel();
                    $infoNhanSu = $nhanSuModel->getNhanSuByEmail($data['Email']);
                    
                    if ($infoNhanSu) {
                        $_SESSION['user']['MaNhanSu'] = $infoNhanSu['MaNhanSu'];
                        $_SESSION['user']['HoTen'] = $infoNhanSu['HoTen'];
                    } else {
                        echo "<script>alert('Lỗi: Tài khoản chưa liên kết với hồ sơ Nhân sự. Liên hệ Admin.'); window.location.href='".BASE_URL."';</script>";
                        exit;
                    }
                    
                    header('Location: ' . BASE_URL . '?mode=hdv&act=lichlamviec'); 
                    exit;
                } 
                
                else if ($data['Role'] == '1') {
                    header('Location: ' . BASE_URL . '?mode=admin&act=danhmuctour');
                    exit;
                }
            } else {
                $_SESSION['failed'] = 'Email hoặc mật khẩu không đúng!';
                header('Location: ' . BASE_URL . '/');
                exit;
            }
        } else {
            require_once './views/login.php';
        }
    } 
    public function logout(){
        session_unset();
        session_destroy();
        header('location:'.BASE_URL);
        exit;
    }
}
?>