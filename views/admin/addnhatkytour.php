<?php require_once 'silderbar.php'; ?>
<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Nhật Ký Tour</h1>
    
    <form action="<?= BASE_URL . '?mode=admin&act=addnhatkytour' ?>" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label for="MaQuanLy">Chọn Tour</label>
        <select class="form-control" name="MaQuanLy" id="MaQuanLy">
          <option value="">-- Chọn Tour --</option>
          <?php if (!empty($dsTour)): ?>
              <?php foreach ($dsTour as $tour): ?>
                  <option value="<?= $tour['MaQuanLy'] ?>"><?= $tour['TenTour'] ?></option>
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
                    <option value="<?= $ns['MaNhanSu'] ?>"><?= $ns['HoTen'] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="Ngay">Ngày:</label>
        <input type="date" class="form-control" name="Ngay" required>
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện:</label>
        <textarea class="form-control" name="SuKien" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố:</label>
        <textarea class="form-control" name="SuCo" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="HinhAnhSuCo">Hình ảnh sự cố (nếu có):</label>
        <input type="file" class="form-control" name="HinhAnhSuCo" accept="image/*">
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" name="PhanHoiKhach" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-default">Thêm Nhật Ký</button>
    </form>
  </div>
</div>