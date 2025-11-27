<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/QuanlytourController.php';
require_once './controllers/AdminController.php';
require_once './controllers/LoginController.php';
require_once './controllers/HdvController.php';
require_once './controllers/LichLamController.php';
require_once './controllers/DsKhachController.php';
require_once './controllers/NhanSuController.php';
require_once './controllers/NhatKyTourController.php';



// Require toàn bộ file Models
require_once './models/QuanlytourModel.php';
require_once './models/AdminModel.php';
require_once './models/LoginModel.php';
require_once './models/HdvModel.php';
require_once './models/LichLamModel.php';
require_once './models/DsKhachModel.php';
require_once './models/NhanSuModel.php';
require_once './models/NhatKyTourModel.php';
// Route

if (!isset($_SESSION['user'])) {
    (new LoginController())->login();
    exit;
}

if(isset($_GET['mode']) && $_GET['mode'] =='admin') {
     require_once './routes/admin.php';
}else if(isset($_GET['mode'])&& $_GET['mode'] =='hdv'){
    require_once './routes/hdv.php';
}
else if(isset($_GET['mode'])&& $_GET['mode'] =='hdv'){
    require_once './routes/hdv.php';
}
else{
    (new LoginController())->login();
}


