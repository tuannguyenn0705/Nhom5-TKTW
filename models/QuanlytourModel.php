<?php

class QuanlytourModel 
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

     public function getAll()
{
    $sql = "SELECT q.*, 
                   dmt.TenDanhMuc,
                   ncc.TenNhaCungCap,
                   ncc.SDT AS SDTNCC,
                   (SELECT COALESCE(SUM(SoLuongKhach), 0) 
                    FROM dattour d 
                    WHERE d.MaChiTietTour = q.MaQuanLy AND d.TrangThai = 'đã xác nhận') AS SoLuongDaDat
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
            ':TrangThai'=> $data['TrangThai'],
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
        ':TrangThai'=>$data['TrangThai'],
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
}
?>