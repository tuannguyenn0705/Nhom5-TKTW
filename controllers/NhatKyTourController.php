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

    public function form()
    {
        if (isset($_GET['id_tour'])) {
            $idTour = $_GET['id_tour'];
            
            require_once './models/QuanlytourModel.php';
            $tourModel = new QuanlytourModel();

            if ($tourModel->checkNhatKyExist($idTour)) {
                echo "<script>alert('Tour này đã có nhật ký rồi!'); window.location.href='" . BASE_URL . "?mode=admin&act=quanlytour';</script>";
                exit;
            }
            
            $currentTour = $tourModel->getDetail($idTour);
            
            $assignedGuide = $tourModel->getAssignedGuide($idTour);
            
            if (!$assignedGuide) {
                $assignedGuide = ['MaNhanSu' => '', 'HoTen' => 'Chưa phân công (Cần kiểm tra lại phân bố)'];
            }

            require_once './views/admin/addnhatkytour.php';
        } else {
            echo "<script>alert('Vui lòng chọn Tour đã hoàn thành để viết nhật ký!'); window.location.href='" . BASE_URL . "?mode=admin&act=quanlytour';</script>";
        }
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            require_once './models/QuanlytourModel.php';
            $tourModel = new QuanlytourModel();
            if ($tourModel->checkNhatKyExist($data['MaQuanLy'])) {
                echo "<script>alert('Tour này đã có nhật ký!'); window.location.href='" . BASE_URL . "?mode=admin&act=quanlytour';</script>";
                exit;
            }

            $hinhAnh = null;
            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName;
                }
            }
            $data['HinhAnhSuCo'] = $hinhAnh;

            if (empty($data['MaNhanSu'])) $data['MaNhanSu'] = null;
            if (empty($data['MaQuanLy'])) $data['MaQuanLy'] = null;

            $this->modelNhatKyTour->add($data);
        }
        header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
    }

    public function edit()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
            
            require_once './models/QuanlytourModel.php';
            require_once './models/NhanSuModel.php';
            
            $tourModel = new QuanlytourModel();
            $dsTour = $tourModel->getAll();
            $nhanSuModel = new NhanSuModel();
            $dsNhanSu = $nhanSuModel->getAll();

            require_once './views/admin/editnhatkytour.php';
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
                'MaNhatKy'     => $_POST['MaNhatKy'],
                'MaQuanLy'     => !empty($_POST['MaQuanLy']) ? $_POST['MaQuanLy'] : null,
                'MaNhanSu'     => !empty($_POST['MaNhanSu']) ? $_POST['MaNhanSu'] : null,
                'Ngay'         => $_POST['Ngay'] ?? '',
                'SuKien'       => $_POST['SuKien'] ?? '',
                'SuCo'         => $_POST['SuCo'] ?? '',
                'PhanHoiKhach' => $_POST['PhanHoiKhach'] ?? '',
                'HinhAnhSuCo'  => $hinhAnh 
            ];

            $this->modelNhatKyTour->update($data); 
            header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');     
        }
    }

    public function delete()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
            
            if (!empty($nhatkytour['HinhAnhSuCo']) && file_exists('./uploads/' . $nhatkytour['HinhAnhSuCo'])) {
                unlink('./uploads/' . $nhatkytour['HinhAnhSuCo']);
            }

            $this->modelNhatKyTour->delete($id);
        }
        header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
    }

    public function detail()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
            if ($nhatkytour) {
                require_once './views/admin/detailnhatkytour.php';
            } else {
                header("location:" . BASE_URL . '?mode=admin&act=nhatkytour');
            }
        }
    }
}
?>