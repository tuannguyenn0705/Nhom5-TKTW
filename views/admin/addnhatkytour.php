<?php require_once 'silderbar.php'; ?>
<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<style>
    .readonly-field {
        background-color: #e9ecef !important;
        cursor: not-allowed;
        color: #495057;
        font-weight: 500;
    }
    .hdv-field {
        color: #0d6efd;
        font-weight: bold;
    }
</style>

<div class="main-container">
  <div class="form-container">
    <h1>Viết Nhật Ký Tour (Kết thúc)</h1>
    
    <form action="<?= BASE_URL . '?mode=admin&act=addnhatkytour' ?>" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label>Tour:</label>
        <input type="text" class="form-control readonly-field" value="<?= htmlspecialchars($currentTour['TenTour']) ?>" readonly>
        <input type="hidden" name="MaQuanLy" value="<?= $currentTour['MaQuanLy'] ?>">
      </div>

      <div class="form-group">
        <label>HDV Phụ Trách:</label>
        <input type="text" class="form-control readonly-field hdv-field" value="<?= htmlspecialchars($assignedGuide['HoTen']) ?>" readonly>
        <input type="hidden" name="MaNhanSu" value="<?= $assignedGuide['MaNhanSu'] ?>">
      </div>

      <div class="form-group">
        <label for="Ngay">Ngày ghi:</label>
        <input type="date" class="form-control" name="Ngay" value="<?= date('Y-m-d') ?>" required>
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện nổi bật:</label>
        <textarea class="form-control" name="SuKien" rows="3" placeholder="Mô tả các hoạt động chính..."></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố (Nếu có):</label>
        <textarea class="form-control" name="SuCo" rows="3" placeholder="Ghi nhận sự cố phát sinh..."></textarea>
      </div>

      <div class="form-group">
        <label for="HinhAnhSuCo">Hình ảnh sự cố/sự kiện:</label>
        <input type="file" class="form-control" name="HinhAnhSuCo" accept="image/*">
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách:</label>
        <textarea class="form-control" name="PhanHoiKhach" rows="3" placeholder="Ý kiến của khách hàng..."></textarea>
      </div>

      <button type="submit" class="btn btn-default" style="background-color: #28a745; color: white;">Lưu Nhật Ký</button>
      <a href="<?= BASE_URL . '?mode=admin&act=quanlytour' ?>" class="btn btn-default" style="text-decoration: none; color: black; display: inline-block; text-align: center; line-height: 20px;">Hủy bỏ</a>
    </form>
  </div>
</div>