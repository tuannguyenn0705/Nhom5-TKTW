<?php 
class LichLamModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }
    public function getAllLichLam(){
        $sql = "SELECT * FROM `lichlamviechdv`";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>