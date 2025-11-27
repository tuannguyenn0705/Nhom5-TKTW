<?php
class NhanSuController
{
    public $modelNhanSu;

    public function __construct()
    {
        $this->modelNhanSu = new NhanSuModel();
    }

    public function Home()
    {
        require_once './views/admin/silderbar.php';
    }
    public function nhansu()
    {
        $result = $this->modelNhanSu->getAll();
        require_once './views/admin/nhansu.php';
    }

    public function delete()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $nhansu = $this->modelNhanSu->getDetail($id);
            if($nhansu && strtoupper($nhansu['VaiTro']) === 'ADMIN'){
                echo "<script>
                    alert('Không Được Phép Xóa Admin Quản Trị Cao Nhất!');
                    </script>";
                    exit;
            };

            $this->modelNhanSu->delete($_GET["id"]);
        }

        header("location:" . BASE_URL . '?mode=admin&act=nhansu');
    }
    public function form()
    {
        require_once './views/admin/addNhanSu.php';
    }
    public function add()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $_POST;

            $this->modelNhanSu->add($data);
        }
        header("location:" . BASE_URL . '?mode=admin&act=nhansu');
    }
    public function edit()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = $this->modelNhanSu->getDetail($_GET['id']);
            if($result && strtoupper($result['VaiTro']) === 'ADMIN'){
                echo "<script>
                    alert('Không Được Phép Sửa Admin Quản Trị Cao Nhất!');
                    </script>";
                    exit;
            }
            require_once './views/admin/editnhansu.php';
        }
    }

    public function update()
    {
        if (isset($_POST['btn-update'])) {
            $data = [
                'MaNhanSu'  => $_POST['MaNhanSu'] ?? null,
                'HoTen' => $_POST['HoTen'] ?? '',
                'SDT'   => $_POST['SDT'] ?? '',
                'Email'       => $_POST['Email'] ?? '',
                'VaiTro'  => $_POST['VaiTro'] ?? '',
                'GhiChu'  => $_POST['GhiChu'] ?? ''
            ];

            if (empty($data['MaNhanSu'])) {
                header("location:" . BASE_URL . '?mode=admin&act=nhansu');
                exit;
            }

            $this->modelNhanSu->update($data);
            header("location:" . BASE_URL . '?mode=admin&act=nhansu');
            exit;
        } else {
            header("location:" . BASE_URL . '?mode=admin&act=nhansu');
            exit;
        }
    }
}
