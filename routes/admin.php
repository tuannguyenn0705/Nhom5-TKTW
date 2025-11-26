<?php
$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '1'){
    match ($act) {
    // Trang chủ
    '/'=>(new ProductController())->Home(),
    'logout' =>(new LoginController())->logout(),
    'danhmuctour' =>(new ProductController())->danhmuctuor(),
    'delete' =>(new ProductController())->delete(),
    'form' =>(new ProductController())->form(),
    'add' =>(new ProductController())->add(),
    'edit' =>(new ProductController())->edit(),
    'update' =>(new ProductController())->update(),
    'quanlytour' => (new QuanlytourController())->Quanlytour(),



    //lịch làm việc
    'lichlamviechdv'=>(new LichLamController())->viewLichLam(),
};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>