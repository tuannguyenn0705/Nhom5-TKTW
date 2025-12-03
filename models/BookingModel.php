<?php 
class BookingModel{
    public $conn;
    public function __construct()
    {
        $this -> conn = connectDB();
    }
    public function getAllBooking()
    {
        $sql = "SELECT * FROM dattour"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
    
}

?>