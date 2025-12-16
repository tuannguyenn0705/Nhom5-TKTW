<?php 
class DashboardController 
{
    public $modelDashboard;

    public function __construct()
    {
        $this->modelDashboard = new DashboardModel();
    }

    public function Dashboard() {
        $thang = isset($_GET['thang']) ? $_GET['thang'] : '';
        $nam   = isset($_GET['nam']) ? $_GET['nam'] : date('Y');

        $dashboard = $this->modelDashboard->getAllDashboard($thang, $nam);

        $totalDoanhThu = array_sum(array_column($dashboard, 'DoanhThu'));
        
        $totalChiPhi   = array_sum(array_column($dashboard, 'ChiPhi')); 
        
        $totalLoiNhuan = $totalDoanhThu - $totalChiPhi;

        require_once './views/admin/dashboard.php';
    }
}
?>