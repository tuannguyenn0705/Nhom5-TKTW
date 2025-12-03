<?php 
class DashboardController 
{
    public $modelDashboard;

    public function __construct()
    {
        $this->modelDashboard = new DashboardModel();
    }

    public function Dashboard() {
        // 1. Lấy tham số filter
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        $nam   = isset($_GET['nam']) ? $_GET['nam'] : date('Y');

        // 2. Gọi Model lấy dữ liệu
        $dashboard = $this->modelDashboard->getAllDashboard($thang, $nam);

        // 3. Tính tổng hiển thị lên 3 thẻ Card trên cùng
        $totalDoanhThu = array_sum(array_column($dashboard, 'DoanhThu'));
        $totalChiPhi   = array_sum(array_column($dashboard, 'ChiPhi'));
        $totalLoiNhuan = array_sum(array_column($dashboard, 'LoiNhuan'));

        // 4. Load View
        require_once './views/admin/dashboard.php';
    }
}
?>