<?php 
class DashboardModel {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDashboard($thang = '', $nam = ''){
        $sqlFilter = "";
        
        if (!empty($thang)) {
            $sqlFilter .= " AND MONTH(qt.NgayBatDau) = :thang";
        }
        if (!empty($nam)) {
            $sqlFilter .= " AND YEAR(qt.NgayBatDau) = :nam";
        }

        $sql = "
            SELECT 
                qt.MaQuanLy, 
                qt.TenTour,
                qt.NgayBatDau, 
                qt.NgayKetThuc, 
                dm.TenDanhMuc,
                
                -- TÍNH TỔNG DOANH THU
                (
                    SELECT COALESCE(SUM(dt.SoLuongKhach * qt.Gia), 0)
                    FROM DatTour dt
                    -- ĐÃ SỬA: Thay dt.MaQuanLy thành dt.MaChiTietTour
                    WHERE dt.MaChiTietTour = qt.MaQuanLy 
                    AND dt.TrangThai = 'đã xác nhận'
                ) AS DoanhThu,

                -- Tạm thời gán ChiPhi = 0 để tránh lỗi (bạn có thể cập nhật logic sau)
                0 AS ChiPhi

            FROM quanlytour qt
            JOIN DanhMucTour dm ON qt.MaDanhMuc = dm.MaDanhMuc
            
            WHERE 1=1 $sqlFilter
            ORDER BY qt.NgayBatDau DESC
        ";

        $stmt = $this->conn->prepare($sql);

        if (!empty($thang)) {
            $stmt->bindParam(':thang', $thang);
        }
        if (!empty($nam)) {
            $stmt->bindParam(':nam', $nam);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tính lợi nhuận sau khi đã có kết quả
        foreach ($result as &$row) {
            $row['LoiNhuan'] = $row['DoanhThu'] - $row['ChiPhi']; 
        }

        return $result;
    }
}
?>