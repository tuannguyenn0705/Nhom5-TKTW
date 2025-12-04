<?php
$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '0'){
    match ($act) {
    // Trang chủ
    '/'=>(new HdvController())->HomeHdv(),
    'logout' =>(new LoginController())->logout(),

    //lich lam viec 
    'lichlamviec' =>(new LichLamController())->viewLichLamHDV(),
    'danhsachkhachhdv'=>(new DsKhachController())->DanhsachKhachHDV(),

    //danh sach khach theo tour
    'DSachKhachHDVByTour' =>(new DsKhachController())->DSachKhachHDVByTour(),
    //danh sách khách(tất cả)
    'danhsachkhach' => (new DsKhachController())->AlldanhsachKhachHDV(),

     //nhat ky tour
     'nhatkyTour' => (new NhatKyTourController())->viewNhatKyHDV(),
};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>