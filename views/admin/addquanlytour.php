<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Tour mới</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=addquanlytour' ?>" method="POST">

      <div class="form-group">
        <label for="TenTour">Tên Tour (văn bản, tối đa 255 ký tự):</label>
        <input type="text" class="form-control" id="TenTour" name="TenTour" maxlength="255" required>
      </div>

      <div class="form-group">
        <label for="MaDanhMuc">Danh Mục:</label>
        <select class="form-control" id="MaDanhMuc" name="MaDanhMuc" required>
            <option value="">-- Chọn danh mục --</option>
            
            <?php if(isset($listDanhMuc) && is_array($listDanhMuc)): ?>
                <?php foreach ($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['MaDanhMuc'] ?>">
                        <?= $dm['TenDanhMuc'] ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Không tải được danh mục</option>
            <?php endif; ?>
            
        </select>
      </div>
      
      <div class="form-group">
        <label for="NgayBatDau">Ngày Bắt Đầu (bắt buộc):</label>
        <input type="date" class="form-control" id="NgayBatDau" name="NgayBatDau" required>
      </div>

      <div class="form-group">
        <label for="NgayKetThuc">Ngày Kết Thúc (bắt buộc):</label>
        <input type="date" class="form-control" id="NgayKetThuc" name="NgayKetThuc" required>
      </div>

      <div class="form-group">
        <label for="Gia">Giá:</label>
        <input type="number" class="form-control" id="Gia" name="Gia" min="1">
      </div>

      <div class="form-group">
        <label for="TrangThai">Trạng Thái:</label>
        <select class="form-control" id="TrangThai" name="TrangThai">
          <option value="sắp khởi hành" selected> Sắp khởi hành</option>
          <option value="đang diễn ra"> Đang diễn ra</option>
          <option value="hoàn thành"> Hoàn thành</option>
        </select>
      </div>

      <div class="form-group">
        <label for="SoLuongToiDa">Số Lượng Khách Tối Đa:</label>
        <input type="number" class="form-control" id="SoLuongToiDa" name="SoLuongToiDa" min="1" value="20" required>
      </div>

      <button type="submit" class="btn btn-default">Thêm Tour</button>
    </form>
  </div>
</div>