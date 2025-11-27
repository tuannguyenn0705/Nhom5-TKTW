<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Nhật Ký Tour</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=addnhatkytour' ?>" method="POST">
      
      <div class="form-group">
        <label for="MaQuanLy">Mã Quản Lý (số, bắt buộc):</label>
        <input
          type="number"
          class="form-control"
          id="MaQuanLy"
          name="MaQuanLy"
          min="1"
          required
          value="<?= htmlspecialchars($_POST['MaQuanLy'] ?? '') ?>"
        >
      </div>

      <div class="form-group">
        <label for="MaNhanSu">Mã Nhân Sự (số, bắt buộc):</label>
        <input
          type="number"
          class="form-control"
          id="MaNhanSu"
          name="MaNhanSu"
          min="1"
          required
          value="<?= htmlspecialchars($_POST['MaNhanSu'] ?? '') ?>"
        >
      </div>

      <div class="form-group">
        <label for="Ngay">Ngày (bắt buộc):</label>
        <input
          type="date"
          class="form-control"
          id="Ngay"
          name="Ngay"
          required
          value="<?= htmlspecialchars($_POST['Ngay'] ?? '') ?>"
        >
      </div>

      <div class="form-group">
        <label for="SuKien">Sự Kiện (mô tả, có thể để trống):</label>
        <textarea
          class="form-control"
          id="SuKien"
          name="SuKien"
          rows="3"
          placeholder="Mô tả sự kiện nếu có..."
        ><?= htmlspecialchars($_POST['SuKien'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="SuCo">Sự Cố (mô tả, có thể để trống):</label>
        <textarea
          class="form-control"
          id="SuCo"
          name="SuCo"
          rows="3"
          placeholder="Ghi nhận sự cố nếu có..."
        ><?= htmlspecialchars($_POST['SuCo'] ?? '') ?></textarea>
      </div>

      <div class="form-group">
        <label for="PhanHoiKhach">Phản Hồi Khách (mô tả, có thể để trống):</label>
        <textarea
          class="form-control"
          id="PhanHoiKhach"
          name="PhanHoiKhach"
          rows="3"
          placeholder="Ý kiến hoặc phản hồi của khách..."
        ><?= htmlspecialchars($_POST['PhanHoiKhach'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="btn btn-default">Thêm Nhật Ký</button>
    </form>
  </div>
</div>