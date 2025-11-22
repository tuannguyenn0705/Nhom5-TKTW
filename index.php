<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/LoginController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/LoginModel.php';
// Route

if (!isset($_SESSION['user'])) {
    (new LoginController())->login();
    exit;
}

if(isset($_GET['mode']) ?? $_GET['mode'] =='admin') {
     require_once './routes/admin.php';
}
else{
    require_once './routes/hdv.php';
}
 






// // Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
