<?php

class QuanlytourModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function autoUpdateStatus() {
        $today = date('Y-m-d');
        
        $sql1 = "UPDATE QuanLyTour SET TrangThai = 'sắp khởi hành' WHERE :today < NgayBatDau AND TrangThai != 'hoàn thành'";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([':today' => $today]);

        $sql2 = "UPDATE QuanLyTour SET TrangThai = 'đang diễn ra' WHERE :today >= NgayBatDau AND :today <= NgayKetThuc";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute([':today' => $today]);

        $sql3 = "UPDATE QuanLyTour SET TrangThai = 'hoàn thành' WHERE :today > NgayKetThuc";
        $stmt3 = $this->conn->prepare($sql3);
        $stmt3->execute([':today' => $today]);
    }

    public function getAll()
    {
        $this->autoUpdateStatus();

        $sql = "SELECT q.*, 
                   dmt.TenDanhMuc,
                   ncc.TenNhaCungCap,
                   ncc.SDT AS SDTNCC,
                   (SELECT COALESCE(SUM(SoLuongKhach), 0) FROM dattour d WHERE d.MaChiTietTour = q.MaQuanLy AND d.TrangThai = 'đã xác nhận') AS SoLuongDaDat,
                   (SELECT COUNT(*) FROM NhatKyTour nk WHERE nk.MaQuanLy = q.MaQuanLy) AS DaCoNhatKy
            FROM QuanLyTour q
            LEFT JOIN danhmuctour dmt ON q.MaDanhMuc = dmt.MaDanhMuc
            LEFT JOIN nhacungcap ncc ON q.MaNCC = ncc.MaNCC
            ORDER BY q.MaQuanLy DESC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM QuanLyTour WHERE MaQuanLy = :MaQuanLy"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $id]); 
        return $stmt->rowCount();
    }

    public function add($data)
    {
        $today = date('Y-m-d');
        $trangThai = 'sắp khởi hành';
        
        if ($today > $data['NgayKetThuc']) {
            $trangThai = 'hoàn thành';
        } elseif ($today >= $data['NgayBatDau']) {
            $trangThai = 'đang diễn ra';
        }

        $sql = "INSERT INTO QuanLyTour 
            (TenTour, MaDanhMuc, NgayBatDau, NgayKetThuc, Gia, TrangThai, SoLuongToiDa, 
             MaNCC, TenTaiXe, BienSoXe, SdtTaiXe)
            VALUES 
            (:TenTour, :MaDanhMuc, :NgayBatDau, :NgayKetThuc, :Gia, :TrangThai, :SoLuongToiDa,
             :MaNCC, :TenTaiXe, :BienSoXe, :SdtTaiXe)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':TenTour' => $data['TenTour'],
            ':MaDanhMuc'=> $data['MaDanhMuc'],
            ':NgayBatDau'=> $data['NgayBatDau'],
            ':NgayKetThuc'=> $data['NgayKetThuc'],
            ':Gia' => $data['Gia'],
            ':TrangThai'=> $trangThai, 
            ':SoLuongToiDa'=> $data['SoLuongToiDa'],
            ':MaNCC' =>$data['MaNCC'],
            ':TenTaiXe' =>$data['TenTaiXe'],
            ':BienSoXe' =>$data['BienSoXe'],
            ':SdtTaiXe' =>$data['SdtTaiXe'],
        ]);

        $MaQuanLy = $this->conn ->lastInsertId();

        if(!empty($data['NgaySo'])){
            foreach($data['NgaySo'] as $i =>$ngay){
                $sql2 = "INSERT INTO lichtrinh (MaQuanLy, NgaySo, Gio, MoTaSuKien)
                     VALUES (:MaQuanLy, :NgaySo, :Gio, :MoTaSuKien)";
                     $stmt2 = $this ->conn->prepare($sql2);
                     $stmt2->execute([
                        ':MaQuanLy'=> $MaQuanLy,
                        'NgaySo'=> $ngay,
                        ':Gio'=>$data['Gio'][$i],
                        'MoTaSuKien'=>$data['MoTaSuKien'][$i],
                     ]);
            }
        }
        return $MaQuanLy;
    }

    public function getDetail($id)
    {
        $sql = "SELECT * FROM QuanLyTour WHERE MaQuanLy = :MaQuanLy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $today = date('Y-m-d');
        $trangThai = 'sắp khởi hành';
        if ($today > $data['NgayKetThuc']) {
            $trangThai = 'hoàn thành';
        } elseif ($today >= $data['NgayBatDau']) {
            $trangThai = 'đang diễn ra';
        }

        $sql = "UPDATE QuanLyTour SET
                TenTour = :TenTour,
                MaDanhMuc = :MaDanhMuc,
                NgayBatDau = :NgayBatDau,
                NgayKetThuc = :NgayKetThuc,
                Gia = :Gia,
                TrangThai = :TrangThai,
                SoLuongToiDa = :SoLuongToiDa,
                MaNCC = :MaNCC,
                TenTaiXe = :TenTaiXe,
                BienSoXe = :BienSoXe,
                SdtTaiXe = :SdtTaiXe
            WHERE MaQuanLy = :MaQuanLy";
            
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':TenTour'=>$data['TenTour'],
            ':MaDanhMuc'=>$data['MaDanhMuc'],
            ':NgayBatDau'=>$data['NgayBatDau'],
            ':NgayKetThuc'=>$data['NgayKetThuc'],
            ':Gia'=>$data['Gia'],
            ':TrangThai'=>$trangThai,
            ':SoLuongToiDa'=>$data['SoLuongToiDa'],
            ':MaNCC'=>$data['MaNCC'],
            ':TenTaiXe'=>$data['TenTaiXe'],
            ':BienSoXe'=>$data['BienSoXe'],
            ':SdtTaiXe'=>$data['SdtTaiXe'],
            ':MaQuanLy'=>$data['MaQuanLy'],
        ]);
        if(!empty($data['MaLichTrinh']) && is_array($data['MaLichTrinh'])){
        for ($i = 0; $i < count($data['MaLichTrinh']); $i++ ) {
            $sql2= "UPDATE lichtrinh SET
                        NgaySo = :NgaySo,
                        Gio = :Gio,
                        MoTaSuKien = :MoTaSuKien
                     WHERE MaLichTrinh = :MaLichTrinh";
            $stmt2 =$this->conn->prepare($sql2);
            $stmt2->execute([
                ':NgaySo'=>$data['NgaySo'][$i],
                ':Gio'=>$data['Gio'][$i],
                ':MoTaSuKien'=>$data['MoTaSuKien'][$i],
                ':MaLichTrinh'=>$data['MaLichTrinh'][$i],
            ]);
        }
        }
        
        return true;
    }

    public function getDetailTour($id) {
        $sql = "SELECT q.*, d.TenDanhMuc, n.TenNhaCungCap
            FROM quanlytour q
            LEFT JOIN danhmuctour d ON q.MaDanhMuc = d.MaDanhMuc
            LEFT JOIN nhacungcap n ON q.MaNCC = n.MaNCC
            WHERE q.MaQuanLy = :MaQuanLy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLichTrinhByTour($MaQuanLy){
        $sql = "SELECT * FROM lichtrinh WHERE MaQuanLy = :MaQuanLy ORDER BY NgaySo, Gio, MoTaSuKien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":MaQuanLy" => $MaQuanLy]);
        return $stmt->fetchAll();
    }

    public function addLichTrinh($data)
    {
        if (!empty($data['NgaySo'])) {
            foreach ($data['NgaySo'] as $i => $ngay) {
                $sql = "INSERT INTO lichtrinh (MaQuanLy, NgaySo, Gio, MoTaSuKien)
                        VALUES (:MaQuanLy, :NgaySo, :Gio, :MoTaSuKien)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':MaQuanLy' => $data['MaQuanLy'],
                    ':NgaySo' => $ngay,
                    ':Gio' => $data['Gio'][$i],
                    ':MoTaSuKien' => $data['MoTaSuKien'][$i],
                ]);
            }
        }
    }

    public function getAssignedGuide($tourId) {
        $sql = "SELECT n.MaNhanSu, n.HoTen 
                FROM lichlamviechdv l 
                JOIN nhansu n ON l.MaNhanSu = n.MaNhanSu 
                WHERE l.MaQuanLy = :MaQuanLy 
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':MaQuanLy' => $tourId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function checkNhatKyExist($tourId) {
        $sql = "SELECT COUNT(*) FROM NhatKyTour WHERE MaQuanLy = :MaQuanLy";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':MaQuanLy' => $tourId]);
        return $stmt->fetchColumn() > 0;
    }
}
?>