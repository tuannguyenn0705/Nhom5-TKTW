<?php
require_once './models/QuanlytourModel.php';
require_once './models/LichLamModel.php';

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
        if (!isset($_SESSION['user']['MaNhanSu'])) { 
            header('Location: ?mode=login'); 
            exit; 
        }
        $maHDV = $_SESSION['user']['MaNhanSu'];

        $lichLamModel = new LichLamModel();
        $listQuanLyTour = $lichLamModel->getLichLamByHDV($maHDV); 

        $dskhach = [];
        if(isset($_GET['MaQuanLy']) && !empty($_GET['MaQuanLy'])){
            $MaQuanLy = $_GET['MaQuanLy'];
            $dskhach = $this->modelDsKhach->getDsKhachByMaQL($MaQuanLy);
        }
        
        require_once './views/hdv/checkintour.php';
    }

    public function updateCheckinStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaKhach = $_POST['MaKhach'] ?? null;
            $MaQuanLy = $_POST['MaQuanLy'] ?? null;
            $TrangThai = $_POST['TrangThai'] ?? null; 

            if ($MaKhach && $MaQuanLy && $TrangThai) {
                $this->modelCheckin->saveCheckin($MaQuanLy, $MaKhach, $TrangThai);
                
                echo "<script>
                    alert('Cập nhật trạng thái điểm danh thành công!');
                    window.location.href = '?mode=hdv&act=checkin&MaQuanLy=$MaQuanLy';
                </script>";
            } else {
                header('Location: ?mode=hdv&act=checkin');
                exit;
            }
        }
    }
}
?>