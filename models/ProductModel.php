<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách danh mục tour
    public function getAll()
    {
         $sql = "select * from danhmuctour ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
   // ProductModel
    function delete($id){
        // Giữ placeholder là :MaDanhMuc
        $sql = "DELETE FROM danhmuctour WHERE MaDanhMuc = :MaDanhMuc"; 
        $stmt = $this->conn->prepare($sql);
        // OK: key ":MaDanhMuc" khớp với placeholder ":MaDanhMuc"
        $stmt -> execute([":MaDanhMuc" => $id]); 
        $result = $stmt ->rowCount();
        return $result;
    }
    function add($data){
        $sql = "INSERT INTO danhmuctour  (TenDanhMuc, LoaiTour, MoTa,TrangThai) 
        VALUES (:TenDanhMuc, :LoaiTour, :MoTa, :TrangThai) ";
        $stmt = $this->conn->prepare($sql);
       $stmt->execute([
        ':TenDanhMuc' => $data['TenDanhMuc'],
        ':LoaiTour'   => $data['LoaiTour'],
        ':MoTa'       => $data['MoTa'],
        ':TrangThai'  => $data['TrangThai']
    ]);
        return $stmt->rowCount();
    }

    // ProductModel.php

    function getDetail($id){
        $sql = "SELECT * FROM danhmuctour WHERE MaDanhMuc = :MaDanhMuc";
        $stmt = $this->conn->prepare($sql);
        
        // Thực thi và truyền tham số ID
        $stmt -> execute([":MaDanhMuc" => $id]);
        
        // Sửa: Thêm PDO::FETCH_ASSOC để lấy kết quả dưới dạng Mảng Kết Hợp
        $result = $stmt ->fetch(PDO::FETCH_ASSOC); 
        
        return $result;
    }
   // ProductModel.php (Đã đúng)

public function update($data)
{
    var_dump($data);
    die;
    $sql = "UPDATE danhmuctour SET 
                TenDanhMuc = :TenDanhMuc, 
                LoaiTour = :LoaiTour, 
                MoTa = :MoTa, 
                TrangThai = :TrangThai 
            WHERE MaDanhMuc = :MaDanhMuc"; // 5 Placeholder
    
    $stmt = $this->conn->prepare($sql);
    
    // Mảng execute CÓ ĐỦ 5 PHẦN TỬ (vì Controller đã thêm MaDanhMuc vào $data)
    $stmt->execute([
        ':TenDanhMuc' => $data['TenDanhMuc'],
        ':LoaiTour'   => $data['LoaiTour'],
        ':MoTa'       => $data['MoTa'],
        ':TrangThai'  => $data['TrangThai'],
        ':MaDanhMuc'  => $data['MaDanhMuc'] // Sẽ hoạt động vì đã có trong $data
    ]);
    
    return $stmt->rowCount();
}
}
    

