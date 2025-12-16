<?php require_once 'silderbar.php'; ?>
<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Sửa Nhật Ký Tour</h1>
    
    <form action="<?= BASE_URL . '?mode=admin&act=updatenhatkytour' ?>" method="POST" enctype="multipart/form-data">
      
      <input type="hidden" name="MaNhatKy" value="<?= htmlspecialchars($nhatkytour['MaNhatKy'] ?? '') ?>">

      <div class="form-group">
        <label for="MaQuanLy">Chọn Tour:</label>
        <select class="form-control" name="MaQuanLy" id="MaQuanLy">
          <option value="">-- Chọn Tour --</option>
          <?php if (!empty($dsTour)): ?>
              <?php foreach ($dsTour as $tour): ?>
                  <option 
                      value="<?= $tour['MaQuanLy'] ?>"
                      <?= (isset($nhatkytour['MaQuanLy']) && $nhatkytour['MaQuanLy'] == $tour['MaQuanLy']) ? 'selected' : '' ?>
                  >
                      <?= $tour['TenTour'] ?>
                  </option>
              <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="MaNhanSu">HDV Phụ Trách:</label>
        <select class="form-control" name="MaNhanSu" id="MaNhanSu">
            <option value="">-- Chọn HDV --</option>
            <?php if (!empty($dsNhanSu)): ?>
                <?php foreach ($dsNhanSu as $ns): ?>
                    <option 
                        value="<?= $ns['MaNhanSu'] ?>"
                        <?= (isset($nhatkytour['MaNhanSu']) && $nhatkytour['MaNhanSu'] == $ns['MaNhanSu']) ? 'selected' : '' ?>
                    >
                        <?= $ns['HoTen'] ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="Ngay">Ngày (bắt buộc):</label>
        <input type="date" class="form-control" id="Ngay" name="Ngay" required
               value="<?= htmlspecialchars($nhatkytour['Ngay'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện:</label>
        <textarea class="form-control" id="SuKien" name="SuKien" rows="3"><?= htmlspecialchars($nhatkytour['SuKien'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố:</label>
        <textarea class="form-control" id="SuCo" name="SuCo" rows="3"><?= htmlspecialchars($nhatkytour['SuCo'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="HinhAnhSuCo">Hình ảnh sự cố (nếu có):</label>
        
        <?php if (!empty($nhatkytour['HinhAnhSuCo'])): ?>
            <div style="margin: 10px 0;">
                <img src="./uploads/<?= htmlspecialchars($nhatkytour['HinhAnhSuCo']) ?>" alt="Ảnh sự cố hiện tại" style="max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                <br>
                <small>Ảnh hiện tại (Nếu không chọn ảnh mới, ảnh này sẽ được giữ nguyên)</small>
                <input type="hidden" name="HinhAnhCu" value="<?= htmlspecialchars($nhatkytour['HinhAnhSuCo']) ?>">
            </div>
        <?php endif; ?>

        <input type="file" class="form-control" name="HinhAnhSuCo" accept="image/*">
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3"><?= htmlspecialchars($nhatkytour['PhanHoiKhach'] ?? '') ?></textarea>
      </div>

      <button type="submit" name="btn-update" class="btn btn-default">Cập Nhật Nhật Ký</button>    
    </form>
  </div>
</div>