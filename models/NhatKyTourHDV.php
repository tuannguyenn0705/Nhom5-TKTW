<?php
class NhatKyTourHDVModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll($maHDV)
    {
        $sql = "SELECT nk.*, n.HoTen AS TenHDV, q.TenTour
                FROM NhatKyTour nk
                LEFT JOIN NhanSu n ON nk.MaNhanSu = n.MaNhanSu
                LEFT JOIN QuanLyTour q ON nk.MaQuanLy = q.MaQuanLy
                WHERE nk.MaNhanSu = :maHDV
                ORDER BY nk.Ngay DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maHDV' => $maHDV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEligibleToursForHDV($maHDV) {
        $sql = "SELECT q.MaQuanLy, q.TenTour 
                FROM lichlamviechdv l
                JOIN quanlytour q ON l.MaQuanLy = q.MaQuanLy
                WHERE l.MaNhanSu = :maHDV
                AND (q.TrangThai = 'đang diễn ra' OR q.TrangThai = 'hoàn thành')
                AND q.MaQuanLy NOT IN (SELECT MaQuanLy FROM nhatkytour)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maHDV' => $maHDV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data)
    {
        $sql = "INSERT INTO NhatKyTour (MaQuanLy, MaNhanSu, Ngay, SuKien, SuCo, PhanHoiKhach, HinhAnhSuCo) 
                VALUES (:MaQuanLy, :MaNhanSu, :Ngay, :SuKien, :SuCo, :PhanHoiKhach, :HinhAnhSuCo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaQuanLy'   => $data['MaQuanLy'],
            ':MaNhanSu'   => $data['MaNhanSu'],
            ':Ngay'       => $data['Ngay'],
            ':SuKien'     => $data['SuKien'],
            ':SuCo'       => $data['SuCo'],
            ':PhanHoiKhach' => $data['PhanHoiKhach'],
            ':HinhAnhSuCo' => $data['HinhAnhSuCo'] ?? ''
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
        $sql = "UPDATE NhatKyTour SET 
                    Ngay = :Ngay, 
                    SuKien = :SuKien,
                    SuCo = :SuCo,
                    PhanHoiKhach = :PhanHoiKhach,
                    HinhAnhSuCo = :HinhAnhSuCo
                WHERE MaNhatKy = :MaNhatKy";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':Ngay'         => $data['Ngay'],
            ':SuKien'       => $data['SuKien'],
            ':SuCo'         => $data['SuCo'],
            ':PhanHoiKhach' => $data['PhanHoiKhach'],
            ':HinhAnhSuCo'  => $data['HinhAnhSuCo'], 
            ':MaNhatKy'     => $data['MaNhatKy']
        ]);
        return $stmt->rowCount();
    }
}
?>