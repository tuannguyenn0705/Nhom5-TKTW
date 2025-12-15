<?php
class LichTrinhModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getLichTrinhByMaQuanLy($MaQuanLy) {
        $sql = "SELECT * FROM lichtrinh 
                WHERE MaQuanLy = :MaQuanLy
                ORDER BY NgaySo ASC, Gio ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':MaQuanLy' => $MaQuanLy
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
