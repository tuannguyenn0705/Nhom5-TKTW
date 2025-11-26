<?php
$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '1'){
    match ($act) {
    // Trang chủ
    '/'=>(new AdminController())->Home(),
    'logout' =>(new LoginController())->logout(),
    'danhmuctour' =>(new AdminController())->danhmuctuor(),
    'delete' =>(new AdminController())->delete(),
    'form' =>(new AdminController())->form(),
    'add' =>(new AdminController())->add(),
    'edit' =>(new AdminController())->edit(),
    'update' =>(new AdminController())->update(),


    // quản lý tour
    'quanlytour' => (new QuanlytourController())->Quanlytour(),



    //lịch làm việc
    'lichlamviechdv'=>(new LichLamController())->viewLichLam(),
};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>