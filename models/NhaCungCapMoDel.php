<?php 
    class NhaCungCapMoDel{
        public $conn;
        public function __construct()
        {
            $this->conn = connectDB();
        }

        public function getAll(){
            $sql = "SELECT * FROM nhacungcap";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt ->fetchAll();
        }
    }