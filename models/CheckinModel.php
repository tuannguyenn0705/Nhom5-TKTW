<?php
class CheckinModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function saveCheckin($maTour, $maKhach, $trangThai)
    {
        $sqlCheck = "SELECT MaCheckIn FROM checkin WHERE MaQuanLy = :maTour AND MaKhach = :maKhach";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute(['maTour' => $maTour, 'maKhach' => $maKhach]);
        $exists = $stmtCheck->fetch();

        if ($exists) {
            $sql = "UPDATE checkin SET TrangThai = :trangThai, ThoiGianCheckIn = NOW() WHERE MaCheckIn = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':trangThai' => $trangThai, ':id' => $exists['MaCheckIn']]);
        } else{
            $sql = "INSERT INTO checkin (MaQuanLy, MaKhach, TrangThai, ThoiGianCheckIn) VALUES (:maTour, :maKhach, :trangThai, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':maTour' => $maTour, ':maKhach' => $maKhach, ':trangThai' => $trangThai]);
        }
    }
    public function updateCheckinStatus($maTour, $maKhach, $trangThai)
{
    $sql = "UPDATE checkin SET TrangThai = :trangThai, ThoiGianCheckIn = NOW() WHERE MaQuanLy = :maTour AND MaKhach = :maKhach";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':trangThai' => $trangThai, ':maTour' => $maTour, ':maKhach' => $maKhach]);
}
     
}
?>