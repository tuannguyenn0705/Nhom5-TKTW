<?php
class NhatKyTourHDVController 
{
    public $modelNhatKyTour;

    public function __construct()
    {
        $this->modelNhatKyTour = new NhatKyTourHDVModel();
    }

    // Hiển thị danh sách nhật ký
    public function nhatkytour()
    {
        $data = $this->modelNhatKyTour->getAll();
        require_once './views/hdv/NhatKyTourHDV.php';
    }

    // Hiển thị form thêm mới
    public function form()
    {
        // Giả định các model này đã được include hoặc autoload
        $tourModel = new QuanlytourModel();
        $dsTour = $tourModel->getAll();

        $nhanSuModel = new NhanSuModel();
        $dsNhanSu = $nhanSuModel->getAll();
        
        require_once './views/hdv/addnhatkytour.php';
    }

    // Xử lý thêm mới
    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // KIỂM TRA: Nếu MaNhanSu rỗng
            if (empty($_POST['MaNhanSu'])) {
                echo "<script>
                    alert('Lỗi: Tour này chưa được phân công Hướng Dẫn Viên. Vui lòng cập nhật HDV cho Tour trước khi viết nhật ký!');
                    window.history.back();
                </script>";
                exit; 
            }

            // Xử lý upload ảnh khi thêm mới (nếu có)
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
            $data['HinhAnhSuCo'] = $hinhAnh; // Thêm tên ảnh vào data

            $this->modelNhatKyTour->add($data);
        }
        header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
    }

    // Xử lý xóa
    public function delete()
    {
        if (isset($_GET["id"])) {
            $this->modelNhatKyTour->delete($_GET["id"]);
        }
        header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
    }

    // Hiển thị form sửa
    public function edit()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhatkytour = $this->modelNhatKyTour->getDetail($id);
            if ($nhatkytour) {
                // Cần load lại danh sách tour và nhân sự để hiển thị trong dropdown (nếu cần sửa tour/hdv)
                // Nếu form sửa của bạn chỉ sửa nội dung, không sửa tour/hdv thì có thể bỏ qua đoạn này
                $tourModel = new QuanlytourModel();
                $dsTour = $tourModel->getAll();
                $nhanSuModel = new NhanSuModel();
                $dsNhanSu = $nhanSuModel->getAll();

                require_once './views/hdv/editnhatkytour.php';
            } else {
                echo "<script>alert('Không tìm thấy nhật ký!'); window.location.href='?mode=hdv&act=nhatkytour';</script>";
            }
        }
    }

    // [QUAN TRỌNG] Xử lý cập nhật
    public function update()
    {
        if (isset($_POST['btn-update'])) {
            $id = $_POST['MaNhatKy'];
            
            // 1. Lấy thông tin cũ để giữ lại tên ảnh cũ nếu không upload ảnh mới
            $oldData = $this->modelNhatKyTour->getDetail($id);
            $hinhAnh = $oldData['HinhAnhSuCo']; 

            // 2. Kiểm tra nếu có file mới được upload
            if (isset($_FILES['HinhAnhSuCo']) && $_FILES['HinhAnhSuCo']['error'] == 0) {
                $targetDir = "./uploads/";
                $fileName = time() . "_" . basename($_FILES["HinhAnhSuCo"]["name"]);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES["HinhAnhSuCo"]["tmp_name"], $targetFilePath)) {
                    $hinhAnh = $fileName; // Cập nhật biến $hinhAnh thành tên file mới
                }
            }
            
            // 3. Chuẩn bị mảng dữ liệu để gửi sang Model
            $data = [
                'MaNhatKy' => $id,
                'Ngay' => $_POST['Ngay'],
                'SuKien' => $_POST['SuKien'],
                'SuCo' => $_POST['SuCo'],
                'PhanHoiKhach' => $_POST['PhanHoiKhach'],
                'HinhAnhSuCo' => $hinhAnh // Đưa tên ảnh (mới hoặc cũ) vào đây
            ];

            // 4. Gọi Model để thực hiện UPDATE
            $this->modelNhatKyTour->update($data);

            // 5. Quay về trang danh sách
            header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
        }
    }
}
?>