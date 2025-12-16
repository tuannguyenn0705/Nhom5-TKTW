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
        $sql = "INSERT INTO dattour (MaChiTietTour, TenKhachHang, SDT, Email, SoLuongKhach, DanhSachKhachDoan, TrangThai, YeuCauDacBiet) 
                VALUES (:maTour, :ten, :sdt, :email, :soluong, :dskhach, 'chờ xác nhận', :yeucau)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function updateStatus($id, $status){
        $sql = "UPDATE dattour SET TrangThai = :status WHERE MaDatTour = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function getBookingById($id){
        $sql = "SELECT * FROM dattour WHERE MaDatTour = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insertGuestToTour($maTour, $hoTen, $maBooking, $sdt = '', $email = '', $yeuCau = ''){
        $sql = "INSERT INTO khachthamgiatour (MaDatTour, MaQuanLy, HoTen, SDT, Email, YeuCauDacBiet) 
                VALUES (:maBooking, :maTour, :ten, :sdt, :email, :yeucau)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'maBooking' => $maBooking,
            'maTour' => $maTour,
            'ten' => $hoTen,
            'sdt' => $sdt,
            'email' => $email,
            'yeucau' => $yeuCau
        ]);
    }

    public function getAllTours(){
        $sql = "SELECT * FROM quanlytour ORDER BY MaQuanLy DESC"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkAvailability($maTour, $soLuongKhachMoi){
        $sqlTour = "SELECT SoLuongToiDa FROM quanlytour WHERE MaQuanLy = :maTour";
        $stmtTour = $this->conn->prepare($sqlTour);
        $stmtTour->execute([':maTour' => $maTour]);
        $tour = $stmtTour->fetch();

        if(!$tour) return false;
        $max = $tour['SoLuongToiDa'];

        $sqlCount = "SELECT SUM(SoLuongKhach) as DaDat FROM dattour 
                       WHERE MaChiTietTour = :maTour AND TrangThai != 'đã hủy'";
        $stmtCount = $this->conn->prepare($sqlCount);
        $stmtCount->execute([':maTour' => $maTour]);
        $result = $stmtCount->fetch();
        $current = $result['DaDat'] ?? 0;

        if(($current + $soLuongKhachMoi) > $max) return false;
        return true;
    }
}
?>