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
         $sql = "SELECT * FROM nhansu";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNhanSuByEmail($email) {
        $sql = "SELECT * FROM nhansu WHERE Email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function delete($id){
        $sql = "DELETE FROM nhansu WHERE MaNhanSu = :MaNhanSu"; 
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaNhanSu" => $id]); 
        return $stmt->rowCount();
    }

    function add($data){
        $sql = "INSERT INTO nhansu (HoTen, SDT, Email, VaiTro, GhiChu) 
                VALUES (:HoTen, :SDT, :Email, :VaiTro, :GhiChu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':HoTen' => $data['HoTen'],
            ':SDT'   => $data['SDT'],
            ':Email' => $data['Email'],
            ':VaiTro'=> $data['VaiTro'],
            ':GhiChu'=> $data['GhiChu']
        ]);
        return $stmt->rowCount();
    }

    function getDetail($id){
        $sql = "SELECT * FROM nhansu WHERE MaNhanSu = :MaNhanSu";
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute([":MaNhanSu" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
            ':Email' => $data['Email'],
            ':VaiTro'=> $data['VaiTro'],
            ':GhiChu'=> $data['GhiChu'],
            ':MaNhanSu' => $data['MaNhanSu']
        ]);
        return $stmt->rowCount();
    }
}
?>