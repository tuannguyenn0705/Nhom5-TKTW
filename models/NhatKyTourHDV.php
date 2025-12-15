<?php
class NhatKyTourHDVModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT nk.*, 
                       n.HoTen AS TenHDV, 
                       q.TenTour
                FROM NhatKyTour nk
                LEFT JOIN NhanSu n ON nk.MaNhanSu = n.MaNhanSu
                LEFT JOIN QuanLyTour q ON nk.MaQuanLy = q.MaQuanLy
                ORDER BY nk.Ngay DESC";
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
        // Thêm trường HinhAnhSuCo vào câu INSERT
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
            ':HinhAnhSuCo' => $data['HinhAnhSuCo'] ?? '' // Nếu không có ảnh thì để rỗng
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
        // [QUAN TRỌNG] Thêm HinhAnhSuCo = :HinhAnhSuCo
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
            ':HinhAnhSuCo'  => $data['HinhAnhSuCo'], // Bind tham số ảnh
            ':MaNhatKy'     => $data['MaNhatKy']
        ]);
        return $stmt->rowCount();
    }
}
?>