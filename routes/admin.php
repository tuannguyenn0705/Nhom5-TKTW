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

    // Nhân Sự
    'nhansu' => (new NhanSuController())->nhansu(),
    'deletenhansu' => (new NhanSuController())->delete(),
    'formnhansu' => (new NhanSuController())->form(),
    'addnhansu' => (new NhanSuController())->add(),
    'editnhansu' => (new NhanSuController())->edit(),
    'updatenhansu' => (new NhanSuController())->update(),


    // quản lý tour
    'quanlytour' => (new QuanlytourController())->quanlytour(),
    'xoaquanlytour' => (new QuanlytourController())->delete(),
    'formquanlytour' => (new QuanlytourController())->form(),
    'addquanlytour' => (new QuanlytourController())->add(),
    'editquanlytour' => (new QuanlytourController())->edit(),
    'updatequanlytour' => (new QuanlytourController())->update(),
    'detailquanlytour' => (new QuanlytourController())-> detail(),
        'addlichtrinh' =>( new QuanlytourController())->addlichtrinh(),

    // nhật ký tour
     'nhatkytour' => (new NhatKyTourController())->nhatkytour(),
     'xoanhatkytour' => (new NhatKyTourController())->delete(),
     'formnhatkytour' => (new NhatKyTourController())->form(),
    'addnhatkytour' => (new NhatKyTourController())->add(),
    'editnhatkytour' => (new NhatKyTourController())->edit(),
    'updatenhatkytour' => (new NhatKyTourController())->update(),
        'detail' => (new NhatKyTourController())->detail(),




    //lịch làm việc
    'lichlamviechdv'=>(new LichLamController())->viewLichLamAdmin(),
    'addlichlamviec'=>(new LichLamController())->addLichLam(),
    // 'deletelichlam'=>(new LichLamController())->deleteLichLam(),
    'editlichlam' => (new LichLamController())->editLichLam(),
    'updatelichlam'=>(new LichLamController())->updateLichLam(),

    //  ds khách
    'danhsachkhach' => (new DsKhachController())->DanhsachKhach(),
    'update_request' => (new DsKhachController())->update_request(),

    // booking
    'booking' => (new BookingController())->booking(),
    'create_booking' => (new BookingController())->create_booking(),
    'store_booking' => (new BookingController())->store_booking(),
    'change_status' => (new BookingController())->changeStatus(),
    //dashboard
        'dashboard' => (new DashboardController())->Dashboard(),


};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>