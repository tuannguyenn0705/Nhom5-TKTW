<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        require_once './views/admin/silderbar.php';
    }
    public function danhmuctuor(){
        $result = $this->modelProduct->getAll();
        require_once './views/admin/danhmuctour.php';
    }
    // ProductController
    public function delete(){
    if(isset($_GET["id"])){
        // Đảm bảo $_GET["id"] là ID hợp lệ, ví dụ 5
        $this->modelProduct->delete($_GET["id"]); 
        
    }
    // Dòng này hoạt động đúng, chuyển hướng về trang danh sách
    header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
}
    public function form(){
        require_once './views/admin/adddanhmuc.php';
    }
    public function add(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST;
        
        $this->modelProduct->add($data);
    }
    header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
    }
    public function edit(){
        if(isset($_GET["id"])){
            $result = $this->modelProduct->getDetail($_GET['id']);
            require_once './views/admin/edit.php';
        }
        
    }
   // ProductController.php

public function update()
{
    if (isset($_POST['btn-update'])) { 
        
        // BƯỚC 2 ĐÃ SỬA: PHẢI CÓ 'MaDanhMuc'
        $data = [
            'MaDanhMuc'  => $_POST['MaDanhMuc'] ?? null, // <--- THÊM ID VÀO ĐÂY
            'TenDanhMuc' => $_POST['TenDanhMuc'] ?? '',
            'LoaiTour'   => $_POST['LoaiTour'] ?? '',
            'MoTa'       => $_POST['MoTa'] ?? '',
            'TrangThai'  => $_POST['TrangThai'] ?? 0 
        ];

        
        // var_dump($data); 

        // Kiểm tra cơ bản: Đảm bảo MaDanhMuc tồn tại
        if (empty($data['MaDanhMuc'])) {
            // Có thể thêm thông báo lỗi vào $_SESSION tại đây
            header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
            exit;
        }
        
        // Bước 3: Gọi hàm Model để cập nhật
        $this->modelProduct->update($data);
        
        // Bước 4: Chuyển hướng sau khi cập nhật thành công
        header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
        exit;
        
    } else {
        // Xử lý nếu truy cập trực tiếp
        header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
        exit;
    }
}
    

}