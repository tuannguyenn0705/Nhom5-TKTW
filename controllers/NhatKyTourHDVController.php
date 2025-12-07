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
        // Giả định bạn đã có các model này
        $tourModel = new QuanlytourModel();
        $dsTour = $tourModel->getAll();

        $nhanSuModel = new NhanSuModel();
        $dsNhanSu = $nhanSuModel->getAll();
        
        require_once './views/hdv/addnhatkytour.php';
    }

    // Xử lý thêm mới
    // File: controllers/NhatKyTourHDVController.php

public function add()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // KIỂM TRA: Nếu MaNhanSu rỗng (tức là Tour chưa có HDV)
        if (empty($_POST['MaNhanSu'])) {
            echo "<script>
                alert('Lỗi: Tour này chưa được phân công Hướng Dẫn Viên. Vui lòng cập nhật HDV cho Tour trước khi viết nhật ký!');
                window.history.back();
            </script>";
            exit; // Dừng chương trình ngay lập tức
        }

        $data = $_POST;
        $this->modelNhatKyTour->add($data);
    }
    header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
}

    // Xử lý xóa
    public function delete()
    {
        if (isset($_GET["id"])) {
            // Đã xóa đoạn check Admin sai logic vì đây là Nhật Ký Tour
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
                require_once './views/hdv/editnhatkytour.php';
            } else {
                echo "<script>alert('Không tìm thấy nhật ký!'); window.location.href='?mode=hdv&act=nhatkytour';</script>";
            }
        }
    }

    // Xử lý cập nhật
    public function update()
    {
        if (isset($_POST['btn-update'])) {
            $data = [
                'MaNhatKy'     => $_POST['MaNhatKy'],
                'Ngay'         => $_POST['Ngay'],
                'SuKien'       => $_POST['SuKien'],
                'SuCo'         => $_POST['SuCo'],
                'PhanHoiKhach' => $_POST['PhanHoiKhach']
            ];
            $this->modelNhatKyTour->update($data);
            header("location:" . BASE_URL . '?mode=hdv&act=nhatkytour');
        }
    }
}
?>