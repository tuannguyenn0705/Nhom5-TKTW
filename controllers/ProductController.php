<?php
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        require_once './views/admin/silderbar.php';
    }
    public function danhmuctuor()
    {
        $result = $this->modelProduct->getAll();
        require_once './views/admin/danhmuctour.php';
    }

    public function delete()
    {
        if (isset($_GET["id"])) {
            $this->modelProduct->delete($_GET["id"]);
        }

        header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
    }
    public function form()
    {
        require_once './views/admin/adddanhmuc.php';
    }
    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            $this->modelProduct->add($data);
        }
        header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
    }
    public function edit()
    {
        if (isset($_GET["id"])) {
            $result = $this->modelProduct->getDetail($_GET['id']);
            require_once './views/admin/edit.php';
        }
    }

    public function update()
    {
        if (isset($_POST['btn-update'])) {
            $data = [
                'MaDanhMuc'  => $_POST['MaDanhMuc'] ?? null,
                'TenDanhMuc' => $_POST['TenDanhMuc'] ?? '',
                'LoaiTour'   => $_POST['LoaiTour'] ?? '',
                'MoTa'       => $_POST['MoTa'] ?? '',
                'TrangThai'  => $_POST['TrangThai'] ?? 0
            ];

            if (empty($data['MaDanhMuc'])) {
                header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
                exit;
            }

            $this->modelProduct->update($data);
            header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
            exit;
        } else {
            header("location:" . BASE_URL . '?mode=admin&act=danhmuctour');
            exit;
        }
    }
}
