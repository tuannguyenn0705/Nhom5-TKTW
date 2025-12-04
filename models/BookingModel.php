<?php 
class BookingModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }
    public function getAllBooking()
    {
        $sql = "SELECT * FROM dattour ORDER BY NgayTao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function insertBooking($data){
        $sql = "INSERT INTO dattour (MaChiTietTour, TenKhachHang, SDT, Email, SoLuongKhach, DanhSachKhachDoan, TrangThai) 
                VALUES (:maTour, :ten, :sdt, :email, :soluong, :dskhach, 'chờ xác nhận')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function updateStatus($id, $status){
        $sql = "UPDATE dattour SET TrangThai = '$status' WHERE MaDatTour = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function getBookingById($id){
        $sql = "SELECT * FROM dattour WHERE MaDatTour = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertGuestToTour($maTour, $hoTen, $maBooking){
        $sql = "INSERT INTO khachthamgiatour (MaDatTour, MaQuanLy, HoTen, YeuCauDacBiet) VALUES (:maBooking, :maTour, :ten, '')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'maBooking' => $maBooking,
            'maTour' => $maTour,
            'ten' => $hoTen
        ]);
    }

    public function getAllTours(){
        $sql = "SELECT * FROM quanlytour ORDER BY MaQuanLy DESC"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}

?>