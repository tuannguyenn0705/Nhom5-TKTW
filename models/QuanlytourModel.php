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
        $sql = "SELECT * FROM QuanLyTour";
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
        $sql = "INSERT INTO QuanLyTour (MaChiTietTour, TenTour, NgayBatDau, NgayKetThuc, Gia, TrangThai) 
                VALUES (:MaChiTietTour, :TenTour, :NgayBatDau, :NgayKetThuc, :Gia, :TrangThai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaChiTietTour'   => $data['MaChiTietTour'],
            ':TenTour'         => $data['TenTour'],
            ':NgayBatDau'      => $data['NgayBatDau'],
            ':NgayKetThuc'     => $data['NgayKetThuc'],
            ':Gia' => $data['Gia'],
            ':TrangThai'       => $data['TrangThai']
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
                    MaChiTietTour = :MaChiTietTour, 
                    TenTour = :TenTour, 
                    NgayBatDau = :NgayBatDau, 
                    NgayKetThuc = :NgayKetThuc,
                    Gia = :Gia,
                    TrangThai = :TrangThai
                WHERE MaQuanLy = :MaQuanLy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaChiTietTour'   => $data['MaChiTietTour'],
            ':TenTour'         => $data['TenTour'],
            ':NgayBatDau'      => $data['NgayBatDau'],
            ':NgayKetThuc'     => $data['NgayKetThuc'],
            ':Gia'             => $data['Gia'],
            ':TrangThai'       => $data['TrangThai'],
            ':MaQuanLy'        => $data['MaQuanLy']
        ]);
        return $stmt->rowCount();
    }
}
?>