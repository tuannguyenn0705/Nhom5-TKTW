<?php 
class LichLamModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }

    public function getAllLichLam(){
        $sql = "SELECT l.*, n.HoTen, q.TenTour
            FROM lichlamviechdv l
            LEFT JOIN nhansu n ON l.MaNhanSu = n.MaNhanSu
            LEFT JOIN quanlytour q ON l.MaQuanLy = q.MaQuanLy";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert() {
        $sql = "INSERT INTO `lichlamviechdv`(`MaNhanSu`, `MaQuanLy`, `VaiTro`)
         VALUES (:MaNhanSu, :MaQuanLy, :VaiTro)";
         $stmt = $this->conn->prepare($sql);
         $stmt->bindParam('MaNhanSu',$_POST['MaNhanSu']);
         $stmt->bindParam('MaQuanLy',$_POST['MaQuanLy']);
         $stmt->bindParam('VaiTro',$_POST['VaiTro']);
         $stmt->execute();
    }


    public function delete($id){
        $sql = "DELETE FROM `lichlamviechdv` WHERE lichlamviechdv.MaLichHDV = :MaLichHDV";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('MaLichHDV',$id);
        $stmt->execute();
    }
}

?>