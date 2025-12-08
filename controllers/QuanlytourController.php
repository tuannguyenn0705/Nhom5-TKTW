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
        
        
        $result = $this->modelQuanlytour->getDetail($id); 
        $AdminModel = new AdminModel();
        $listDanhMuc = $AdminModel->getAll();
        require_once './views/admin/editquanlytour.php';
    }
}
     public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        $data = [
            'MaQuanLy'     => $_POST['MaQuanLy'],
            'TenTour'      => $_POST['TenTour'] ?? '',
            'MaDanhMuc'    => $_POST['MaDanhMuc'] ?? 0, 
            'NgayBatDau'   => $_POST['NgayBatDau'] ?? '',
            'NgayKetThuc'  => $_POST['NgayKetThuc'] ?? '',
            'Gia'          => $_POST['Gia'] ?? 0,
            'TrangThai'    => $_POST['TrangThai'] ?? 'sắp khởi hành',
            'SoLuongToiDa' => $_POST['SoLuongToiDa'] ?? 20 
        ];
        $this->modelQuanlytour->update($data);
        header("location:" . BASE_URL . '?mode=admin&act=quanlytour');
        exit;
    }
}
}
?>