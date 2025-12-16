<?php 
require_once 'silderbar.php';
?>

<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Lịch Làm Việc (Phân Công HDV)</h1>
    <form action="" method="POST">
      
      <div class="form-group">
        <label>Tên HDV</label>
        <select name="MaNhanSu" required>
            <option value="">-- Chọn HDV --</option>
            <?php foreach($dataNhanSu as $value){ 
                if(strtoupper($value['VaiTro']) === 'ADMIN') {
                    continue; 
                }
            ?>
                <option value="<?= $value['MaNhanSu'] ?>">
                    <?= $value['HoTen'] ?>
                </option>
            <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <label>Tour cần phân công</label>
        <?php 
            $id_tour_request = isset($_GET['id_tour']) ? $_GET['id_tour'] : null;
            
            $style_lock = $id_tour_request ? 'pointer-events: none; background-color: #e9ecef;' : '';
        ?>
        
        <select name="MaQuanLy" id="selectTour" required onchange="updateDates()" style="<?= $style_lock ?>">
            <option value="">-- Chọn Tour --</option>
            <?php foreach($dataQuanLy as $value){ 
                
                if($id_tour_request && $value['MaQuanLy'] != $id_tour_request) {
                    continue;
                }

                $is_selected = ($id_tour_request == $value['MaQuanLy']) ? 'selected' : '';
            ?>
                <option value="<?= $value['MaQuanLy'] ?>" 
                        data-start="<?= $value['NgayBatDau'] ?>" 
                        data-end="<?= $value['NgayKetThuc'] ?>"
                        <?= $is_selected ?>>
                    <?= $value['TenTour'] ?>
                </option>
            <?php } ?>
        </select>
      </div>

      <div class="form-group" >
        <label for="">Ngày bắt đầu công tác</label>
        <input type="date" name="NgayBatDau" id="NgayBatDau" class="form-control date-input" required>
      </div>

      <div class="form-group">
        <label for="">Ngày kết thúc công tác</label>
        <input type="date" name="NgayKetThuc" id="NgayKetThuc" class="form-control date-input" required>
      </div>

      <button type="submit" class="btn btn-default">Lưu Phân Công</button>
      <a href="<?= BASE_URL ?>?mode=admin&act=lichlamviechdv" class="btn btn-default" style="text-decoration: none; color: black; display:inline-block; text-align:center; line-height: 20px;">Quay Lại</a>
    </form>
  </div>
</div>

<script>
    function updateDates() {
        var select = document.getElementById('selectTour');
        if(select.selectedIndex === -1) return;

        var selectedOption = select.options[select.selectedIndex];
        
        var startDate = selectedOption.getAttribute('data-start');
        var endDate = selectedOption.getAttribute('data-end');

        if(startDate && endDate) {
            document.getElementById('NgayBatDau').value = startDate;
            document.getElementById('NgayKetThuc').value = endDate;
        } else {
            document.getElementById('NgayBatDau').value = '';
            document.getElementById('NgayKetThuc').value = '';
        }
    }

    window.onload = function() {
        updateDates();
    };
</script>