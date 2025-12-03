<?php 

class DashboardModel {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDashboard($thang = '', $nam = ''){
        $sqlFilter = "";
        
        // Filter theo ngày bắt đầu của Tour trong bảng quanlytour
        if (!empty($thang)) {
            $sqlFilter .= " AND MONTH(qt.NgayBatDau) = :thang";
        }
        if (!empty($nam)) {
            $sqlFilter .= " AND YEAR(qt.NgayBatDau) = :nam";
        }

        $sql = "
            SELECT 
                qt.MaQuanLy, 
                qt.TenTour,       -- <--- LẤY CHÍNH XÁC TÊN TỪ BẢNG quanlytour
                qt.NgayBatDau, 
                qt.NgayKetThuc, 
                dm.TenDanhMuc,
                
                -- Tính tổng doanh thu: (Số khách * Giá vé) của các đơn ĐÃ XÁC NHẬN thuộc Tour này
                (
                    SELECT COALESCE(SUM(dt.SoLuongKhach * ct.Gia), 0)
                    FROM DatTour dt
                    WHERE dt.MaChiTietTour = ct.MaChiTiet 
                    AND dt.TrangThai = 'đã xác nhận'
                ) AS DoanhThu,

                -- Tính tổng chi phí: Tổng tiền từ bảng ChiPhiTour theo IdTour (MaQuanLy)
                (
                    SELECT COALESCE(SUM(cp.SoTien), 0)
                    FROM ChiPhiTour cp
                    WHERE cp.IdTour = qt.MaQuanLy
                ) AS ChiPhi

            FROM quanlytour qt
            -- Join với ChiTietTour để lấy Giá vé (tính doanh thu) và Danh mục
            JOIN ChiTietTour ct ON qt.MaChiTietTour = ct.MaChiTiet
            JOIN DanhMucTour dm ON ct.MaDanhMuc = dm.MaDanhMuc
            
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

        // Tính lợi nhuận bằng PHP
        foreach ($result as &$row) {
            $row['LoiNhuan'] = $row['DoanhThu'] - $row['ChiPhi'];
        }

        return $result;
    }
}
?>