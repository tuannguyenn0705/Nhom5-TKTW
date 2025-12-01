<?php 

class AdminModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
         $sql = "select * from danhmuctour ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
    function delete($id){
        $sql = "DELETE FROM danhmuctour WHERE MaDanhMuc = :MaDanhMuc"; 
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaDanhMuc" => $id]); 
        $result = $stmt ->rowCount();
        return $result;
    }
    function add($data){
        $sql = "INSERT INTO danhmuctour  (TenDanhMuc, MoTa,TrangThai) 
        VALUES (:TenDanhMuc, :MoTa, :TrangThai) ";
        $stmt = $this->conn->prepare($sql);
       $stmt->execute([
        ':TenDanhMuc' => $data['TenDanhMuc'],       
        ':MoTa'       => $data['MoTa'],
        ':TrangThai'  => $data['TrangThai']
    ]);
        return $stmt->rowCount();
    }

    function getDetail($id){
        $sql = "SELECT * FROM danhmuctour WHERE MaDanhMuc = :MaDanhMuc";
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaDanhMuc" => $id]);
        $result = $stmt ->fetch(PDO::FETCH_ASSOC); 
        
        return $result;
    }

public function update($data)
{
    $sql = "UPDATE danhmuctour SET 
                TenDanhMuc = :TenDanhMuc, 
                MoTa = :MoTa, 
                TrangThai = :TrangThai 
            WHERE MaDanhMuc = :MaDanhMuc";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':TenDanhMuc' => $data['TenDanhMuc'],
        ':MoTa'       => $data['MoTa'],
        ':TrangThai'  => $data['TrangThai'],
        ':MaDanhMuc'  => $data['MaDanhMuc']
    ]);
    
    return $stmt->rowCount();
}
}
    

