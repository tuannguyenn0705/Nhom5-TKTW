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
    $sql = "SELECT nk.*, n.HoTen AS TenHDV 
            FROM NhatKyTour nk
            LEFT JOIN NhanSu n ON nk.MaNhanSu = n.MaNhanSu";
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
        $sql = "INSERT INTO NhatKyTour (MaQuanLy, MaNhanSu, Ngay, SuKien, SuCo, PhanHoiKhach) 
                VALUES (:MaQuanLy, :MaNhanSu, :Ngay, :SuKien, :SuCo, :PhanHoiKhach)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaQuanLy'   => $data['MaQuanLy'],
            ':MaNhanSu'  => $data['MaNhanSu'],
            ':Ngay'  => $data['Ngay'],
            ':SuKien'=> $data['SuKien'],
            ':SuCo' => $data['SuCo'],
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
       $sql = "UPDATE NhatKyTour SET 
            MaQuanLy = :MaQuanLy, 
            MaNhanSu = :MaNhanSu, 
            Ngay = :Ngay, 
            SuKien = :SuKien,
            SuCo = :SuCo,
            PhanHoiKhach = :PhanHoiKhach
        WHERE MaNhatKy = :MaNhatKy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
    ':MaQuanLy'     => $data['MaQuanLy'],
    ':MaNhanSu'     => $data['MaNhanSu'],
    ':Ngay'         => $data['Ngay'],
    ':SuKien'       => $data['SuKien'],
    ':SuCo'         => $data['SuCo'],
    ':PhanHoiKhach' => $data['PhanHoiKhach'],
    ':MaNhatKy'     => $data['MaNhatKy']
]);
        return $stmt->rowCount();
    }
}
?>