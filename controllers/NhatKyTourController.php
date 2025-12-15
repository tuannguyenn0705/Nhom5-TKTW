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
        $tourModel = new QuanlytourModel();
        $dsTour = $tourModel->getAll();
        
        // Thêm Model nhân sự để lấy danh sách HDV (cho drop-down)
        $nhanSuModel = new NhanSuModel();
        $dsNhanSu = $nhanSuModel->getAll();

        require_once './views/admin/addnhatkytour.php';
    }

    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            // 1. XỬ LÝ UPLOAD ẢNH
            $hinhAnh = null;
            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                // Đổi tên file để tránh trùng: time_tenfilegoc
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName;
                }
            }
            $data['HinhAnhSuCo'] = $hinhAnh;

            // 2. XỬ LÝ NULL CHO KHÓA NGOẠI
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
            
            // Cần lấy thêm danh sách tour và nhân sự để hiển thị form edit
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
            // Lấy dữ liệu cũ để giữ lại ảnh nếu không up ảnh mới
            $id = $_POST['MaNhatKy'];
            $oldData = $this->modelNhatKyTour->getDetail($id);
            $hinhAnh = $oldData['HinhAnhSuCo']; 

            // Kiểm tra nếu có file mới được upload
            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName; // Cập nhật tên ảnh mới
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
                'HinhAnhSuCo'  => $hinhAnh // Lưu tên ảnh
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
            
            // Xóa ảnh khỏi thư mục uploads nếu tồn tại
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