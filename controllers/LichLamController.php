<?php 

class LichLamController 
{
    public function viewLichLam() {
        $lichLam = new LichLamModel();
        $data = $lichLam -> getAllLichLam();
        require_once './views/admin/lichlamviec.php';
    }
}

