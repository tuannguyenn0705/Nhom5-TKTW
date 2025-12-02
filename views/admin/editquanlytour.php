<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Sửa Tour</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=updatequanlytour'?>" method="POST">      
      
      <!-- Hidden để truyền MaQuanLy -->
      <input type="hidden" name="MaQuanLy" value="<?php echo $result['MaQuanLy']; ?>">

      <div class="form-group">
        <label for="MaChiTietTour">Mã Chi Tiết Tour:</label>
        <input type="number" class="form-control" id="MaChiTietTour" name="MaChiTietTour" 
               value="<?php echo $result['MaChiTietTour']; ?>" required>
      </div>

      <div class="form-group">
        <label for="TenTour">Tên Tour:</label>
        <input type="text" class="form-control" id="TenTour" name="TenTour" maxlength="255" 
               value="<?php echo $result['TenTour']; ?>" required>
      </div>

      <div class="form-group">
        <label for="NgayBatDau">Ngày Bắt Đầu:</label>
        <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau" 
               value="<?php echo $result['NgayBatDau']; ?>" required>
      </div>

      <div class="form-group">
        <label for="NgayKetThuc">Ngày Kết Thúc:</label>
        <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc" 
               value="<?php echo $result['NgayKetThuc']; ?>" required>
      </div>

      <div class="form-group">
        <label for="Gia">Hướng Dẫn Viên:</label>
        <input type="number" class="form-control" id="Gia" name="Gia" min="1" 
               value="<?php echo $result['Gia']; ?>">
      </div>

      <div class="form-group">
        <label for="TrangThai">Trạng Thái:</label>
        <select class="form-control" id="TrangThai" name="TrangThai">
          <option value="sắp khởi hành" <?= ($result['TrangThai'] == 'sắp khởi hành') ? 'selected' : '' ?>>Sắp khởi hành</option>
          <option value="đang diễn ra" <?= ($result['TrangThai'] == 'đang diễn ra') ? 'selected' : '' ?>>Đang diễn ra</option>
          <option value="hoàn thành" <?= ($result['TrangThai'] == 'hoàn thành') ? 'selected' : '' ?>>Hoàn thành</option>
        </select>
      </div>

      <button type="submit" name="btn-update" class="btn btn-default">Cập nhật Tour</button>
    </form>
  </div>
</div>