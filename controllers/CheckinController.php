<?php
require_once './models/QuanlytourModel.php';

    class CheckinController{
        public $modelDsKhach;
        public $modelCheckin;
       

        public function __construct()
        {
            $this->modelDsKhach = new DsKhachModel();
            $this->modelCheckin = new CheckinModel();
            
        }

        public function formCheckin(){
            if(!isset($_GET['MaQuanLy'])){
                header('Location: ?mode=hdv');
                exit;
            }

            $MaQuanLy = $_GET['MaQuanLy'];
            $dskhach = $this->modelDsKhach->getDsKhachByMaQL($MaQuanLy);
            require_once './views/hdv/checkin.php';
        }

        public function storeCheckin(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $MaQuanLy = $_POST['MaQuanLy'];
                $statuses = $_POST['status'] ?? [];

                foreach($statuses as $maKhach => $trangThai){
                    $this->modelCheckin->saveCheckin($MaQuanLy, $maKhach, $trangThai);
                }
                echo "<script>
                    alert('Đã cập nhật điểm danh thành công!');
                    window.location.href = '?mode=hdv&act=DSachKhachHDVByTour&MaQuanLy=$MaQuanLy';
                  </script>";
            }
        }
        public function Checkin(){
            $QuanlytourModel = new QuanlytourModel();
            $listQuanLyTour = $QuanlytourModel->getAll();
            if(isset($_GET['MaQuanLy']) && !empty($_GET['MaQuanLy'])){
                $MaQuanLy = $_GET['MaQuanLy'];
                $dskhach = $this->modelDsKhach->getDsKhachByMaQL($MaQuanLy);
            }
            require_once './views/hdv/checkintour.php';
        }
        public function updateCheckinStatus()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy các giá trị được gửi từ form của một khách hàng cụ thể
        $MaKhach = $_POST['MaKhach'] ?? null;
        $MaQuanLy = $_POST['MaQuanLy'] ?? null;
        $TrangThai = $_POST['TrangThai'] ?? null; // Lấy giá trị từ select có name="TrangThai"

        if ($MaKhach && $MaQuanLy && $TrangThai) {
            // Gọi hàm trong Model để cập nhật trạng thái
            // Lưu ý: Tên hàm trong CheckinModel là `saveCheckin`, nó xử lý cả INSERT và UPDATE
            $this->modelCheckin->saveCheckin($MaQuanLy, $MaKhach, $TrangThai);
            
            echo "<script>
                alert('Cập nhật trạng thái điểm danh thành công!');
                // Điều hướng quay lại trang check-in với tour đã chọn
                window.location.href = '?mode=hdv&act=checkin&MaQuanLy=$MaQuanLy';
            </script>";
        } else {
            // Xử lý lỗi nếu thiếu dữ liệu
            header('Location: ?mode=hdv&act=checkin');
            exit;
        }
    }
}
    }
?>