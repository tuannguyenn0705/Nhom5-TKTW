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

    public function DanhsachKhachHDV() {
      
        $dskhach = $this->modelDsKhach->getAllDsKhach();
        require_once './views/hdv/danhsachkhachhdv.php';
    }

    public function DSachKhachHDVByTour(){
        $MaQuanLy = $_GET['MaQuanLy'];
        $dskhach = $this->modelDsKhach->getDsKhachByMaQL($MaQuanLy);
        require_once './views/hdv/danhsachkhachhdv.php';
    }

    public function update_request(){
        if(isset($_GET['id']) && isset($_GET['content'])){
            $id = $_GET['id'];
            $content = $_GET['content'];

            $this->modelDsKhach->updateRequest($id, $content);
        }
        header('Location: ?mode=admin&act=danhsachkhach');
        exit();
    }
}

