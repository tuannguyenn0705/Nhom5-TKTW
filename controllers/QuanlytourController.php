<?php
require_once './models/AdminModel.php';

class QuanlytourController 
{
    public $modelQuanlytour;

    public function __construct()
    {
        $this->modelQuanlytour = new QuanlytourModel();
    }

    public function Home()
    {
        require_once './views/admin/sildebar.php'; 
    }

    public function quanlytour()
    {
        $data = $this->modelQuanlytour->getAll();
        require_once './views/admin/quanlytour.php';
    }
  public function delete()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $quanlytour = $this->modelQuanlytour->getDetail($id);
            if($quanlytour && strtoupper($quanlytour['VaiTro']) === 'ADMIN'){
                echo "<script>
                    alert('Không Được Phép Xóa Admin Quản Trị Cao Nhất!');
                    </script>";
                    exit;
            };

            $this->modelQuanlytour->delete($_GET["id"]);
        }

        header("location:" . BASE_URL . '?mode=admin&act=quanlytour');
    }
    public function form()
    {   
        $AdminModel = new AdminModel();
        $listDanhMuc = $AdminModel->getAll();
        require_once './models/NhaCungCapMoDel.php';
        $NCCmodel = new NhaCungCapMoDel;
        $listNCC = $NCCmodel->getALl();
        require_once './views/admin/addquanlytour.php';

    }
   public function add()
    {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            $this->modelQuanlytour->add($data);
        }
        
        header("location:" . BASE_URL . '?mode=admin&act=quanlytour');

        
    }
    public function edit()
{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
        require_once './models/NhaCungCapMoDel.php';
        $result = $this->modelQuanlytour->getDetail($id);
        $lichtrinh = $this->modelQuanlytour->getLichTrinhByTour($id);
        $listNCC = (new NhaCungCapMoDel())->getAll(); 
        $AdminModel = new AdminModel();
        $listDanhMuc = $AdminModel->getAll();
        require_once './views/admin/editquanlytour.php';
    }
}
     public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        $data = $_POST;
        $this->modelQuanlytour->update($data);
        header("location:" . BASE_URL . '?mode=admin&act=quanlytour');
        exit;
    }
}

    public function detail(){
        if(isset($_GET["id"])){
            $id = $_GET['id'];
            $tour = $this->modelQuanlytour->getDetailTour($id);

            $lichtrinh =$this->modelQuanlytour->getLichTrinhByTour($id);
            require_once "./views/admin/chitiettour.php";
        }
    }

    public function addlichtrinh()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelQuanlytour->addLichTrinh($_POST);

        header("Location: " . BASE_URL .
            "?mode=admin&act=detailquanlytour&id=" . $_POST['MaQuanLy']);
        exit;
    }
}
}


?>