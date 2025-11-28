<?php 

class LichLamController 
{
    public function viewLichLam() {
        $lichLam = new LichLamModel();
        $data = $lichLam -> getAllLichLam();
        require_once './views/admin/lichlamviec.php';
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
            require_once './views/admin/addlichlamviec.php';
        }
    }

    public function deleteLichLam(){
        $lichLam = new LichLamModel();
        $data = $lichLam->delete($_GET['id']);
        header("location: ".BASE_URL.'?mode=admin&act=lichlamviechdv');
        exit;
    }
}

