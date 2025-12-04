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
    
}

?>