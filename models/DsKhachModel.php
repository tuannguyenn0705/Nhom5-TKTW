<?php 
class DsKhachModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }
    public function getAllDsKhach(){
        $sql = "SELECT k.*, q.TenTour 
            FROM khachthamgiatour k 
            LEFT JOIN quanlytour q ON k.MaQuanLy = q.MaQuanLy";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRequest($id, $content){
        $sql = "UPDATE khachthamgiatour SET YeuCauDacBiet = :content WHERE MaKhach = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':content' => $content,
            ':id' => $id
        ]);
    }

    public function getDsKhachByMaQL($MaQuanLy){
        $sql = "SELECT k.*, q.TenTour, c.TrangThai AS TrangThai
            FROM khachthamgiatour k
            JOIN quanlytour q ON k.MaQuanLy = q.MaQuanLy
            LEFT JOIN checkin c ON c.MaKhach = k.MaKhach
            WHERE k.MaQuanLy = :maql";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['maql' => $MaQuanLy]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>