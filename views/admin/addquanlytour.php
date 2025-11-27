<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Tour mới</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=addquanlytour'?>" method="POST">
      
      <div class="form-group">
        <label for="MaChiTietTour">Mã Chi Tiết Tour (số, bắt buộc):</label>
        <input type="number" class="form-control" id="MaChiTietTour" name="MaChiTietTour" min="1" required>
      </div>

      <div class="form-group">
        <label for="TenTour">Tên Tour (văn bản, tối đa 255 ký tự):</label>
        <input type="text" class="form-control" id="TenTour" name="TenTour" maxlength="255" required>
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
        <label for="HDVDuocPhanCong">Hướng Dẫn Viên Được Phân Công (số, có thể để trống):</label>
        <input type="number" class="form-control" id="HDVDuocPhanCong" name="HDVDuocPhanCong" min="1" placeholder="Nếu có, nhập ID hướng dẫn viên">
      </div>

      <div class="form-group">
        <label for="TrangThai">Trạng Thái:</label>
        <select class="form-control" id="TrangThai" name="TrangThai">
          <option value="sắp khởi hành" selected> Sắp khởi hành</option>
          <option value="đang diễn ra"> Đang diễn ra</option>
          <option value="hoàn thành"> Hoàn thành</option>
        </select>
      </div>

      <button type="submit" class="btn btn-default">Thêm Tour</button>
    </form>
  </div>
</div>