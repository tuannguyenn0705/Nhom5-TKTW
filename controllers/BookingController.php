<?php 

class BookingController 
{
     public $modelBooking;

    public function __construct()
    {
        $this->modelBooking = new BookingModel();
    }
    public function booking() {
      
        $booking = $this->modelBooking->getAllBooking();
        require_once './views/admin/booking.php';
    }
}

