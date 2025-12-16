<?php
require_once './controllers/LichTrinhController.php';
require_once './controllers/DsKhachController.php';
require_once './controllers/CheckinController.php';
require_once './controllers/NhatKyTourHDVController.php';

$act = $_GET['act'] ?? '/';

if(isset($_SESSION['user']) && $_SESSION['user']['Role'] == '0'){
    match ($act) {
        // Trang chủ
        '/' => (new HdvController())->HomeHdv(),
        'logout' => (new LoginController())->logout(),

        // Lịch làm việc 
        'lichlamviec' => (new LichLamController())->viewLichLamHDV(),

        // Danh sách khách
        'danhsachkhach' => (new DsKhachController())->DanhsachKhachHDV(),
        'DSachKhachHDVByTour' => (new DsKhachController())->DSachKhachHDVByTour(),
        
        'update_request' => (new DsKhachController())->update_request(),

        // Lịch trình tour
        'lichtrinhtour' => (new LichTrinhController())->lichTrinhHDV(),

        // Nhật ký tour
        'nhatkytour' => (new NhatKyTourHDVController())->nhatkytour(),
        'formnhatkytour' => (new NhatKyTourHDVController())->form(),
        'addnhatkytour' => (new NhatKyTourHDVController())->add(),
        'editnhatkytour' => (new NhatKyTourHDVController())->edit(),
        'updatenhatkytour' => (new NhatKyTourHDVController())->update(),

        // Check-in
        'checkin_form' => (new CheckinController())->formCheckin(),
        'checkin_store' => (new CheckinController())->storeCheckin(),
        'checkin' => (new CheckinController())->Checkin(),
        'updateCheckinStatus' => (new CheckinController())->updateCheckinStatus(),
    };

} else {
    header("Location: ". BASE_URL);
    exit;
}
?>