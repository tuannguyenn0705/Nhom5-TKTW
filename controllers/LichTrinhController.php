<?php
require_once './models/LichTrinhModel.php';

class LichTrinhController {
    public function lichTrinhHDV() {
        $MaQuanLy = $_GET['MaQuanLy'] ?? 0;

        require_once './models/LichTrinhModel.php';
        $model = new LichTrinhModel();
        $lichtrinh = $model->getLichTrinhByMaQuanLy($MaQuanLy);

        require_once './views/hdv/lichtrinhtour.php';
    }
}
