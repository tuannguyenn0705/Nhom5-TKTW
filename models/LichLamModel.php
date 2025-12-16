<?php 
class LichLamModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }

    public function getAllLichLam(){
        $sql = "SELECT l.*, n.HoTen, q.TenTour, q.NgayBatDau as TourBatDau, q.NgayKetThuc as TourKetThuc
                FROM lichlamviechdv l
                JOIN nhansu n ON l.MaNhanSu = n.MaNhanSu
                JOIN quanlytour q ON l.MaQuanLy = q.MaQuanLy
                ORDER BY l.MaLichHDV DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLichLamByHDV($maHDV){
        $sql = "SELECT l.*, n.HoTen, q.TenTour, q.NgayBatDau, q.NgayKetThuc, q.TrangThai, q.MaQuanLy
                FROM lichlamviechdv l
                JOIN nhansu n ON l.MaNhanSu = n.MaNhanSu
                JOIN quanlytour q ON l.MaQuanLy = q.MaQuanLy
                WHERE l.MaNhanSu = :maHDV
                ORDER BY q.NgayBatDau DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':maHDV' => $maHDV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnassignedTours(){
        $sql = "SELECT * FROM quanlytour 
                WHERE MaQuanLy NOT IN (SELECT DISTINCT MaQuanLy FROM lichlamviechdv)
                ORDER BY MaQuanLy DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert() {
        $sql = "INSERT INTO `lichlamviechdv`(`MaNhanSu`, `MaQuanLy`,`NgayBatDau`,`NgayKetThuc`)
         VALUES (:MaNhanSu, :MaQuanLy, :NgayBatDau, :NgayKetThuc)";
         $stmt = $this->conn->prepare($sql);
         $stmt->bindParam('MaNhanSu',$_POST['MaNhanSu']);
         $stmt->bindParam('MaQuanLy',$_POST['MaQuanLy']);
         $stmt->bindParam('NgayBatDau',$_POST['NgayBatDau']);
         $stmt->bindParam('NgayKetThuc',$_POST['NgayKetThuc']);
         $stmt->execute();
    }

    public function getOneLichLam($id){
        $sql = "SELECT * FROM `lichlamviechdv` WHERE lichlamviechdv.MaLichHDV = :MaLichHDV";
        $stmt = $this -> conn ->prepare($sql);
        $stmt->bindParam(':MaLichHDV',$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id){
        $sql = "UPDATE `lichlamviechdv` SET `MaNhanSu`= :MaNhanSu ,
        `MaQuanLy`= :MaQuanLy,
        `NgayBatDau`= :NgayBatDau ,
        `NgayKetThuc`= :NgayKetThuc
         WHERE lichlamviechdv.MaLichHDV = :id";
         $stmt = $this ->conn->prepare($sql);
         $stmt->bindParam(':MaNhanSu',$_POST['MaNhanSu']);
         $stmt->bindParam(':MaQuanLy',$_POST['MaQuanLy']);
         $stmt->bindParam(':NgayBatDau',$_POST['NgayBatDau']);
         $stmt->bindParam(':NgayKetThuc',$_POST['NgayKetThuc']);
         $stmt->bindParam(':id',$id);
         $stmt->execute();
    }
}
?>