<?php 

class BookingController 
{
     public $modelBooking;

    public function __construct()
    {
        $this->modelBooking = new BookingModel();
    }
    public function booking() {
        $allBooking = $this->modelBooking->getAllBooking();

        $bookingCho = [];
        $bookingDaXacNhan = [];
        $bookingDaHuy = [];

        foreach($allBooking as $b){
            if($b['TrangThai'] == 'đã xác nhận'){
                $bookingDaXacNhan[] = $b;
            }else if($b['TrangThai'] == 'đã hủy'){
                $bookingDaHuy[] = $b;
            }else{
                $bookingCho[] = $b;
            }
        }

        require_once './views/admin/booking.php';
    }

    public function store_booking(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tenKhach = $_POST['TenKhachHang'];
            $khachDoan = isset($_POST['KhachDoan']) ? array_values($_POST['KhachDoan']) : []; 
            $soLuongKhach = 1 + count($khachDoan);

            $maTour = $_POST['MaChiTietTour'];

            $isAvailable = $this->modelBooking->checkAvailability($maTour, $soLuongKhach);

            if(!$isAvailable){
                echo "<script>
                        alert('Thất bại! Tour này đã đầy hoặc không đủ số lượng ghế trống cho đoàn của bạn.');
                        window.history.back();
                      </script>";
                    exit;
            }

            $jsonKhachDoan = json_encode($khachDoan, JSON_UNESCAPED_UNICODE);

            $yeuCau = isset($_POST['YeuCauDacBiet']) ? $_POST['YeuCauDacBiet'] : '';

            $data = [
                ':maTour' => $_POST['MaChiTietTour'],
                ':ten' => $tenKhach,
                ':sdt' => $_POST['SDT'],
                ':email' => $_POST['Email'],
                ':soluong' => $soLuongKhach,
                ':dskhach' => $jsonKhachDoan,
                ':yeucau' => $yeuCau
            ];

            $this->modelBooking->insertBooking($data);
            header('Location: ?mode=admin&act=booking');
        }
    }

    public function changeStatus(){
        $id = $_GET['id'];
        $status = $_GET['status'];

        if($status == 'đã xác nhận') {
            $booking = $this->modelBooking->getBookingById($id);
            
            $yeuCauNguoiDat = !empty($booking['YeuCauDacBiet']) ? $booking['YeuCauDacBiet'] : 'Người đặt tour';

            $this->modelBooking->insertGuestToTour(
                $booking['MaChiTietTour'], 
                $booking['TenKhachHang'], 
                $id, 
                $booking['SDT'], 
                $booking['Email'], 
                $yeuCauNguoiDat
            );

            if(!empty($booking['DanhSachKhachDoan'])){
                $memberList = json_decode($booking['DanhSachKhachDoan'], true);
                if(is_array($memberList)){
                    foreach($memberList as $mem){
                        if(is_array($mem)){
                            $this->modelBooking->insertGuestToTour(
                                $booking['MaChiTietTour'], 
                                $mem['HoTen'], 
                                $id, 
                                $mem['SDT'] ?? '', 
                                $mem['Email'] ?? '', 
                                $mem['YeuCau'] ?? ''
                            );
                        } else {
                            $this->modelBooking->insertGuestToTour(
                                $booking['MaChiTietTour'], 
                                $mem, 
                                $id
                            );
                        }
                    }
                }
            }
        }

        $this->modelBooking->updateStatus($id, $status);
        header('Location: ?mode=admin&act=booking');
    }

    public function create_booking(){
        $tours = $this->modelBooking->getAllTours();
        require_once './views/admin/addbooking.php';
    }
}
?>