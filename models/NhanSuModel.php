<?php 

class NhanSuModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
         $sql = "select * from nhansu ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
    function delete($id){
        $sql = "DELETE FROM nhansu WHERE MaNhanSu = :MaNhanSu"; 
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaNhanSu" => $id]); 
        $result = $stmt ->rowCount();
        return $result;
    }
    function add($data){
        $sql = "INSERT INTO nhansu  (HoTen, SDT, Email, VaiTro, GhiChu) 
        VALUES (:HoTen, :SDT, :Email, :VaiTro, :GhiChu) ";
        $stmt = $this->conn->prepare($sql);
       $stmt->execute([
        ':HoTen' => $data['HoTen'],
        ':SDT'   => $data['SDT'],
        ':Email'       => $data['Email'],
        ':VaiTro'  => $data['VaiTro'],
        ':GhiChu'  => $data['GhiChu']
    ]);
        return $stmt->rowCount();
    }

    function getDetail($id){
        $sql = "SELECT * FROM nhansu WHERE MaNhanSu = :MaNhanSu";
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaNhanSu" => $id]);
        $result = $stmt ->fetch(PDO::FETCH_ASSOC); 
        
        return $result;
    }

public function update($data)
{
    $sql = "UPDATE nhansu SET 
                HoTen = :HoTen, 
                SDT = :SDT, 
                Email = :Email, 
                VaiTro = :VaiTro,
                GhiChu = :GhiChu
            WHERE MaNhanSu = :MaNhanSu";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':HoTen' => $data['HoTen'],
        ':SDT'   => $data['SDT'],
        ':Email'       => $data['Email'],
        ':VaiTro'  => $data['VaiTro'],
        ':GhiChu'  => $data['GhiChu']
    ]);
    
    return $stmt->rowCount();
}
}
    

