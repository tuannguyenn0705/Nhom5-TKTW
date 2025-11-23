<?php
class QuanlytourModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // hàm connectDB() phải được định nghĩa sẵn
    }
   
    public function getAll()
    {
        $sql = "SELECT q.*, n.HoTen AS TenHDV 
            FROM quanlytour q 
            LEFT JOIN nhansu n ON q.HDVDuocPhanCong = n.MaNhanSu";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // trả về mảng kết hợp
    }
}