<?php 

class LichLamController 
{
    public function viewLichLamAdmin() {
        $lichLam = new LichLamModel();
        $listAssigned = $lichLam->getAllLichLam();
        $listUnassigned = $lichLam->getUnassignedTours();
        $data = $listAssigned; 
        require_once './views/admin/lichlamviec.php';
    }

    public function viewLichLamHDV() {
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['MaNhanSu'])) {
            header('Location: ?mode=login'); exit;
        }
        $maHDV = $_SESSION['user']['MaNhanSu'];

        $lichLam = new LichLamModel();
        $data = $lichLam->getLichLamByHDV($maHDV); 
        
        require_once './views/hdv/LichLamViecHDV.php';
    }

    public function addLichLam(){
        $nhanSu = new NhanSuModel();
        $dataNhanSu = $nhanSu->getAll();
        $quanLy = new QuanlytourModel();
        $dataQuanLy = $quanLy->getAll();
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $lichLam = new LichLamModel();
            $dataPro = $lichLam->insert();
            header('location: '.BASE_URL.'?mode=admin&act=lichlamviechdv');
            exit;
        }else{
            $selectedTourId = isset($_GET['id_tour']) ? $_GET['id_tour'] : null;
            $selectedTourData = null;
            if($selectedTourId){
                $selectedTourData = $quanLy->getDetail($selectedTourId);
            }
            require_once './views/admin/addlichlamviec.php';
        }
    }

    public function editLichLam(){
        $lichLam = new LichLamModel();
        $data = $lichLam->getOneLichLam($_GET['id']);
        $nhanSu = new NhanSuModel();
        $dataNhanSu = $nhanSu->getAll();

        $quanLy = new QuanlytourModel();
        $dataQuanLy = $quanLy->getAll();
        require_once './views/admin/editlichlamviec.php';
    }

    public function updateLichLam() {
        $lichLam = new LichLamModel();
        $data = $lichLam->update($_GET['id']);
        header('location:'.BASE_URL.'?mode=admin&act=lichlamviechdv');
        exit;
    }
}
?>