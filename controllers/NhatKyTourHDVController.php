<?php
class NhatKyTourHDVController 
{
    public $modelNhatKyTour;

    public function __construct()
    {
        $this->modelNhatKyTour = new NhatKyTourHDVModel();
    }

    public function nhatkytour()
    {
        if (!isset($_SESSION['user']['MaNhanSu'])) { header('Location: ?mode=login'); exit; }
        $maHDV = $_SESSION['user']['MaNhanSu'];

        $data = $this->modelNhatKyTour->getAll($maHDV);
        require_once './views/hdv/NhatKyTourHDV.php';
    }

    public function form()
    {
        if (!isset($_SESSION['user']['MaNhanSu'])) { header('Location: ?mode=login'); exit; }
        $maHDV = $_SESSION['user']['MaNhanSu'];

        $dsTour = $this->modelNhatKyTour->getEligibleToursForHDV($maHDV);

        if (empty($dsTour)) {
            echo "<script>alert('Hiện tại không có tour nào cần viết nhật ký (Hoặc bạn chưa được phân công tour đang chạy/hoàn thành)!'); window.location.href='?mode=hdv&act=nhatkytour';</script>";
            exit;
        }

        require_once './views/hdv/addnhatkytour.php';
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION['user']['MaNhanSu'])) { header('Location: ?mode=login'); exit; }

            $hinhAnh = "";
            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName;
                }
            }

            $data = $_POST;
            $data['HinhAnhSuCo'] = $hinhAnh;
            $data['MaNhanSu'] = $_SESSION['user']['MaNhanSu']; 

            $this->modelNhatKyTour->add($data);
        }
        header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
    }

    public function edit()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
            if ($nhatkytour) {
                require_once './views/hdv/editnhatkytour.php';
            } else {
                echo "<script>alert('Không tìm thấy nhật ký!'); window.location.href='?mode=hdv&act=nhatkytour';</script>";
            }
        }
    }

    public function update()
    {
        if (isset($_POST['btn-update'])) {
            $id = $_POST['MaNhatKy'];
            $oldData = $this->modelNhatKyTour->getDetail($id);
            $hinhAnh = $oldData['HinhAnhSuCo']; 

            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName; 
                }
            }
            
            $data = [
                'MaNhatKy' => $id,
                'Ngay' => $_POST['Ngay'],
                'SuKien' => $_POST['SuKien'],
                'SuCo' => $_POST['SuCo'],
                'PhanHoiKhach' => $_POST['PhanHoiKhach'],
                'HinhAnhSuCo' => $hinhAnh
            ];

            $this->modelNhatKyTour->update($data);
            header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
        }
    }
}
?>