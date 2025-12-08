<?php 

class LichLamController 
{
    public function viewLichLamAdmin() {
        $lichLam = new LichLamModel();

        $lichLamModel = new LichLamModel();

        $listAssigned = $lichLamModel->getAllLichLam();
        $listUnassigned = $lichLamModel->getUnassignedTours();

        $data = $lichLam -> getAllLichLam();
        require_once './views/admin/lichlamviec.php';
    }

    public function viewLichLamHDV() {
        $lichLam = new LichLamModel();
        $data = $lichLam -> getAllLichLam();
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

    // public function deleteLichLam(){
    //     $lichLam = new LichLamModel();
    //     $data = $lichLam->delete($_GET['id']);
    //     header("location: ".BASE_URL.'?mode=admin&act=lichlamviechdv');
    //     exit;
    // }

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

