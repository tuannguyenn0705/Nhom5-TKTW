<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Sửa Nhật Ký Tour</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=updatenhatkytour' ?>" method="POST">
      
      <!-- Ẩn ID để biết bản ghi nào cần update -->
      <input type="hidden" name="MaNhatKy" value="<?= htmlspecialchars($nhatkytour['MaNhatKy'] ?? '') ?>">

      <div class="form-group">
        <label for="MaQuanLy">Mã Quản Lý (số, bắt buộc):</label>
        <input type="number" class="form-control" id="MaQuanLy" name="MaQuanLy" min="1" required
               value="<?= htmlspecialchars($nhatkytour['MaQuanLy'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label for="MaNhanSu">Mã Nhân Sự (số, bắt buộc):</label>
        <input type="number" class="form-control" id="MaNhanSu" name="MaNhanSu" min="1" required
               value="<?= htmlspecialchars($nhatkytour['MaNhanSu'] ?? '') ?>">
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
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3"><?= htmlspecialchars($nhatkytour['PhanHoiKhach'] ?? '') ?></textarea>
      </div>

<button type="submit" name="btn-update" class="btn btn-default">Cập Nhật Nhật Ký</button>    </form>
  </div>
</div>