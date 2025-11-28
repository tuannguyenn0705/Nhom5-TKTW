<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Lịch Làm Việc</h1>
    <form action="" method="POST">
      <div class="form-group">
        <label>Tên HDV</label>
        <select name="MaNhanSu" required>
            <option value="">Chọn HDV</option>
            <?php foreach($dataNhanSu as $value){ ?>
                <option value="<?= $value['MaNhanSu'] ?>">
                    <?=  $value['HoTen'] ?>
                </option>
                <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Loại Tour</label>
        <select name="MaQuanLy" required>
            <option value="">Chọn Tour</option>
            <?php foreach($dataQuanLy as $value){ ?>
                <option value="<?=  $value['MaQuanLy'] ?>">
                    <?=  $value['TenTour'] ?>
                </option>
                <?php } ?>
        </select>
      </div>
      
      <div class="form-group">
        <label >Vai Trò:</label>
        <select name="VaiTro" id="VaiTro" required>
            <option value="chính">chính</option>
            <option value="phụ">phụ</option>
        </select>
      </div>

      <button type="submit" class="btn btn-default">Lưu</button>
      <button class="btn btn-default"><a style="text-decoration: none;" href="<?= BASE_URL ?>?mode=admin&act=lichlamviechdv">Quay Lại</a></button>
    </form>
  </div>
</div>