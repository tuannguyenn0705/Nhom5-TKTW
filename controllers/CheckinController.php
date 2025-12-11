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
            require_once './views/hdv/checkintour.php';
        }
    }
?>