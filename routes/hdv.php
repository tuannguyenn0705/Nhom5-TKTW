<?php
// $act = $_GET['act'] ?? '/';
$act = $_GET['act'] ?? '/';

    match ($act) {
    // Trang chủ
    '/'=>(new LoginController())->Login(),

};
?>