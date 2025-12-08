<?php

class QuanlytourModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

     public function getAll()
{
    $sql = "SELECT q.*, 
                   dmt.TenDanhMuc, 
                   (SELECT COALESCE(SUM(SoLuongKhach), 0) 
                    FROM dattour d 
                    WHERE d.MaChiTietTour = q.MaQuanLy AND d.TrangThai = 'đã xác nhận') as SoLuongDaDat
            FROM QuanLyTour q 
            LEFT JOIN danhmuctour dmt ON q.MaDanhMuc = dmt.MaDanhMuc 
            ORDER BY q.MaQuanLy DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function delete($id)
    {
        $sql = "DELETE FROM QuanLyTour WHERE MaQuanLy = :MaQuanLy"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $id]); 
        return $stmt->rowCount();
    }

    public function add($data)
    {
        $sql = "INSERT INTO QuanLyTour (TenTour, MaDanhMuc,NgayBatDau, NgayKetThuc, Gia, TrangThai, SoLuongToiDa) 
                VALUES (:TenTour, :MaDanhMuc, :NgayBatDau, :NgayKetThuc, :Gia, :TrangThai, :SoLuongToiDa)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':TenTour'         => $data['TenTour'],
            ':MaDanhMuc'         => $data['MaDanhMuc'],
            ':NgayBatDau'      => $data['NgayBatDau'],
            ':NgayKetThuc'     => $data['NgayKetThuc'],
            ':Gia' => $data['Gia'],
            ':TrangThai'       => $data['TrangThai'],
            ':SoLuongToiDa'    => $data['SoLuongToiDa']
        ]);
        return $stmt->rowCount();
        
    }

    public function getDetail($id)
    {
        $sql = "SELECT * FROM QuanLyTour WHERE MaQuanLy = :MaQuanLy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
{
    $sql = "UPDATE QuanLyTour SET 
                TenTour = :TenTour, 
                MaDanhMuc = :MaDanhMuc, 
                NgayBatDau = :NgayBatDau, 
                NgayKetThuc = :NgayKetThuc,
                Gia = :Gia,
                TrangThai = :TrangThai,
                SoLuongToiDa = :SoLuongToiDa
            WHERE MaQuanLy = :MaQuanLy";
            
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':TenTour'      => $data['TenTour'],
        ':MaDanhMuc'    => $data['MaDanhMuc'],
        ':NgayBatDau'   => $data['NgayBatDau'],
        ':NgayKetThuc'  => $data['NgayKetThuc'],
        ':Gia'          => $data['Gia'],
        ':TrangThai'    => $data['TrangThai'],
        ':SoLuongToiDa' => $data['SoLuongToiDa'], 
        ':MaQuanLy'     => $data['MaQuanLy']
    ]);
    
    return $stmt->rowCount();
}
}
?>