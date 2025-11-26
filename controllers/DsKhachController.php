<?php 

class DsKhachController 
{
     public $modelDsKhach;

    public function __construct()
    {
        $this->modelDsKhach = new DsKhachModel();
    }
    public function DanhsachKhach() {
      
        $dskhach = $this->modelDsKhach->getAllDsKhach();
        require_once './views/admin/danhsachkhach.php';
    }
}

