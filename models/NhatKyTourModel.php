<?php
class NhatKyTourModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        // Lấy danh sách kèm tên HDV và Tên Tour
        $sql = "SELECT nk.*, 
                       n.HoTen AS TenHDV, 
                       q.TenTour
                FROM NhatKyTour nk
                LEFT JOIN NhanSu n ON nk.MaNhanSu = n.MaNhanSu
                LEFT JOIN QuanLyTour q ON nk.MaQuanLy = q.MaQuanLy
                ORDER BY nk.MaNhatKy DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM NhatKyTour WHERE MaNhatKy = :MaNhatKy"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaNhatKy" => $id]); 
        return $stmt->rowCount();
    }

    public function add($data)
    {
        // THÊM HinhAnhSuCo VÀO SQL
        $sql = "INSERT INTO NhatKyTour (MaQuanLy, MaNhanSu, Ngay, SuKien, SuCo, HinhAnhSuCo, PhanHoiKhach) 
                VALUES (:MaQuanLy, :MaNhanSu, :Ngay, :SuKien, :SuCo, :HinhAnhSuCo, :PhanHoiKhach)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaQuanLy'     => $data['MaQuanLy'],
            ':MaNhanSu'     => $data['MaNhanSu'],
            ':Ngay'         => $data['Ngay'],
            ':SuKien'       => $data['SuKien'],
            ':SuCo'         => $data['SuCo'],
            ':HinhAnhSuCo'  => $data['HinhAnhSuCo'], // <-- Cột mới
            ':PhanHoiKhach' => $data['PhanHoiKhach']
        ]);
        return $stmt->rowCount();
    }

    public function getDetail($id)
    {
        $sql = "SELECT * FROM NhatKyTour WHERE MaNhatKy = :MaNhatKy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaNhatKy" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
       // THÊM HinhAnhSuCo VÀO SQL UPDATE
       $sql = "UPDATE NhatKyTour SET 
            Ngay = :Ngay, 
            SuKien = :SuKien,
            SuCo = :SuCo,
            HinhAnhSuCo = :HinhAnhSuCo, 
            PhanHoiKhach = :PhanHoiKhach,
            MaQuanLy = :MaQuanLy,
            MaNhanSu = :MaNhanSu
        WHERE MaNhatKy = :MaNhatKy";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':Ngay'         => $data['Ngay'],
            ':SuKien'       => $data['SuKien'],
            ':SuCo'         => $data['SuCo'],
            ':HinhAnhSuCo'  => $data['HinhAnhSuCo'], // <-- Cột mới
            ':PhanHoiKhach' => $data['PhanHoiKhach'],
            ':MaQuanLy'     => $data['MaQuanLy'],
            ':MaNhanSu'     => $data['MaNhanSu'],
            ':MaNhatKy'     => $data['MaNhatKy']
        ]);
        return $stmt->rowCount();
    }
}
?>