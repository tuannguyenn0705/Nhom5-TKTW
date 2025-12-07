<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin: 20px auto;">
    <h1 style="text-align: center;">Sửa Nhật Ký Tour</h1>
    
    <form action="<?= BASE_URL . '?mode=hdv&act=updatenhatkytour' ?>" method="POST">
      
      <input type="hidden" name="MaNhatKy" value="<?= htmlspecialchars($nhatkytour['MaNhatKy'] ?? '') ?>">

      <div class="form-group">
        <label for="Ngay">Ngày:</label>
        <input type="date" class="form-control" id="Ngay" name="Ngay" required
               value="<?= htmlspecialchars($nhatkytour['Ngay'] ?? '') ?>" style="width: 100%; padding: 8px; margin-bottom: 15px;">
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện:</label>
        <textarea class="form-control" id="SuKien" name="SuKien" rows="3" style="width: 100%; margin-bottom: 15px;"><?= htmlspecialchars($nhatkytour['SuKien'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố:</label>
        <textarea class="form-control" id="SuCo" name="SuCo" rows="3" style="width: 100%; margin-bottom: 15px;"><?= htmlspecialchars($nhatkytour['SuCo'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3" style="width: 100%; margin-bottom: 15px;"><?= htmlspecialchars($nhatkytour['PhanHoiKhach'] ?? '') ?></textarea>
      </div>

      <button type="submit" name="btn-update" class="btn btn-default" style="background: #f59e0b; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Cập Nhật Nhật Ký</button>
      <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" style="margin-left: 10px; text-decoration: none; color: #333;">Hủy</a>
    </form>
  </div>
</div>