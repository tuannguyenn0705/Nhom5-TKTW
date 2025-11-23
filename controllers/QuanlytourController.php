<?php
// Dùng __DIR__ để trỏ ra ngoài thư mục cha rồi vào models, tránh lỗi đường dẫn
require_once __DIR__ . '/../models/QuanlytourModel.php';

class QuanlytourController {
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new QuanlytourModel();
    }

    public function Home()
    {
        require_once './views/admin/sildebar.php'; 
    }

    public function Quanlytour()
    {
        // Gọi model để lấy dữ liệu
        $data = $this->modelProduct->getAll();
        // Import view để hiển thị dữ liệu $data
        // Đường dẫn này tính từ file index.php gốc
        require_once './views/admin/quanlytour.php';
    }
}
?>