<?php
class NhatKyTourController 
{
    public $modelNhatKyTour;

    public function __construct()
    {
        $this->modelNhatKyTour = new NhatKyTourModel();
    }

    public function Home()
    {
        require_once './views/admin/sildebar.php'; 
    }

    public function nhatkytour()
    {
        $data = $this->modelNhatKyTour->getAll();
        require_once './views/admin/nhatkytour.php';
    }
  public function delete()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $quanlytour = $this->modelNhatKyTour->getDetail($id);
            if($quanlytour && strtoupper($quanlytour['VaiTro']) === 'ADMIN'){
                echo "<script>
                    alert('Không Được Phép Xóa Admin Quản Trị Cao Nhất!');
                    </script>";
                    exit;
            };

            $this->modelNhatKyTour->delete($_GET["id"]);
        }

        header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
    }
    public function form()
    {
        $tourModel = new QuanlytourModel();
        $dsTour = $tourModel->getAll();

        $nhanSuModel = new NhanSuModel();
        $dsNhanSu = $nhanSuModel->getAll();
        require_once './views/admin/addnhatkytour.php';
    }
   public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            $this->modelNhatKyTour->add($data);
        }
        header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
    }
    public function edit()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
require_once './views/admin/editnhatkytour.php';
        }
    }
      public function update()
    {
        if (isset($_POST['btn-update'])) {
            $data = [
    'MaNhatKy'     => $_POST['MaNhatKy'] ?? null,
    'MaQuanLy'     => $_POST['MaQuanLy'] ?? null,
    'MaNhanSu'     => $_POST['MaNhanSu'] ?? null,
    'Ngay'         => $_POST['Ngay'] ?? '',
    'SuKien'       => $_POST['SuKien'] ?? '',
    'SuCo'         => $_POST['SuCo'] ?? '',
    'PhanHoiKhach' => $_POST['PhanHoiKhach'] ?? ''
];
                $this->modelNhatKyTour->update($data); // gọi model
       header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
                
        }
}
public function detail()
{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $nhatkytour = $this->modelNhatKyTour->getDetail($id);

        if ($nhatkytour) {
            require_once './views/admin/detailnhatkytour.php';
        } else {
            echo "<script>alert('Không tìm thấy nhật ký tour!');</script>";
            header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
        }
    }
}
}
?>