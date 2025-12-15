<?php
require_once './controllers/LichTrinhController.php';
require_once './controllers/DsKhachController.php';
require_once './controllers/CheckinController.php';
require_once './controllers/NhatKyTourHDVController.php';

$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '0'){
    match ($act) {
    // Trang chủ
    '/'=>(new HdvController())->HomeHdv(),
    'logout' =>(new LoginController())->logout(),

    //lich lam viec 
    'lichlamviec' =>(new LichLamController())->viewLichLamHDV(),
    'danhsachkhachhdv'=>(new DsKhachController())->DanhsachKhachHDV(),

    //
    'lichtrinhtour' => (new LichTrinhController())->lichTrinhHDV(),
    //danh sach khach theo tour
    'DSachKhachHDVByTour' =>(new DsKhachController())->DSachKhachHDVByTour(),
    //danh sách khách(tất cả)
    'danhsachkhach' => (new DsKhachController())->AlldanhsachKhachHDV(),
    

     //nhat ky tour
     'nhatkytour' => (new NhatKyTourHDVController())->nhatkytour(),
     'xoanhatkytour' => (new NhatKyTourHDVController())->delete(),
     'formnhatkytour' => (new NhatKyTourHDVController())->form(),
    'addnhatkytour' => (new NhatKyTourHDVController())->add(),
    'editnhatkytour' => (new NhatKyTourHDVController())->edit(),
    'updatenhatkytour' => (new NhatKyTourHDVController())->update(),

     // check-in
     'checkin_form' => (new CheckinController())->formCheckin(),
     'checkin_store' => (new CheckinController())->storeCheckin(),
     'checkin' => (new CheckinController())->Checkin(),
     'updateCheckinStatus' => (new CheckinController())->updateCheckinStatus(),
};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>