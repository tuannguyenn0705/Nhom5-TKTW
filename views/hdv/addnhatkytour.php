<link rel="stylesheet" href="./views/css/addDanhMuc.css">
<div class="main-container">
  <div class="form-container" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin: 20px auto;">
    <h1 style="text-align: center;">Thêm Nhật Ký Tour</h1>
    
    <form action="<?= BASE_URL . '?mode=hdv&act=addnhatkytour' ?>" method="POST">

      <div class="form-group">
        <label for="MaQuanLy">Chọn Tour</label>
        <select class="form-control" name="MaQuanLy" id="MaQuanLy" required onchange="tuDongDienHDV()">
    <option value="" data-guide-id="" data-guide-name="">-- Chọn Tour --</option>
    
    <?php if (!empty($dsTour)): ?>
        <?php foreach ($dsTour as $tour): ?>
            <?php 
                // Kiểm tra xem có HDV hay không
                $hasGuide = !empty($tour['HDVDuocPhanCong']); 
                $guideName = $tour['TenHDV'] ?? 'Chưa Phân Công';
                $displayText = $tour['TenTour'] . ($hasGuide ? "" : " (Chưa có HDV)");
                $style = $hasGuide ? "" : "color: red;"; // Tô đỏ nếu chưa có HDV
            ?>
            <option 
                value="<?= $tour['MaQuanLy'] ?>" 
                data-guide-id="<?= $tour['HDVDuocPhanCong'] ?>" 
                data-guide-name="<?= $guideName ?>"
                style="<?= $style ?>"
            >
                <?= htmlspecialchars($displayText) ?>
            </option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>
      </div>

      <div class="form-group">
        <label for="MaNhanSu">HDV Phụ Trách:</label>
        <input type="text" class="form-control" id="TenNhanSuHienThi" readonly style="background-color: #e9ecef; width: 100%; padding: 8px; margin-bottom: 15px;">
        <input type="hidden" id="MaNhanSu" name="MaNhanSu">
      </div>

      <div class="form-group">
        <label for="Ngay">Ngày (bắt buộc):</label>
        <input type="date" class="form-control" id="Ngay" name="Ngay" required value="<?= date('Y-m-d') ?>" style="width: 100%; padding: 8px; margin-bottom: 15px;">
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện:</label>
        <textarea class="form-control" id="SuKien" name="SuKien" rows="3" placeholder="Mô tả sự kiện..." style="width: 100%; margin-bottom: 15px;"></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố:</label>
        <textarea class="form-control" id="SuCo" name="SuCo" rows="3" placeholder="Ghi nhận sự cố..." style="width: 100%; margin-bottom: 15px;"></textarea>
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3" placeholder="Ý kiến khách hàng..." style="width: 100%; margin-bottom: 15px;"></textarea>
      </div>

      <button type="submit" class="btn btn-default" style="background: #3b82f6; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Thêm Nhật Ký</button>
      <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" style="margin-left: 10px; text-decoration: none; color: #333;">Hủy</a>
    </form>
  </div>
</div>

<script>
  function tuDongDienHDV() {
    var selectBox = document.getElementById('MaQuanLy');
    var selectOption = selectBox.options[selectBox.selectedIndex];
    var guideId = selectOption.getAttribute('data-guide-id');
    var guideName = selectOption.getAttribute('data-guide-name');

    document.getElementById('MaNhanSu').value = guideId;
    document.getElementById('TenNhanSuHienThi').value = guideName;
  }
</script>