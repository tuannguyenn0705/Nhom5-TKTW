<link rel="stylesheet" href="./views/css/edit.css">
<div class="main-container">
  <div class="form-container">
    <h1>Sửa Nhân Sự</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=updatenhansu'?>" method="POST">
      <div class="form-group">
        <input type="hidden" name="MaNhanSu" value="<?php echo $result['MaNhanSu']; ?>">
        <label >TenDanhMuc: </label>
        <input type="text" class="form-control" id="HoTen" name="HoTen" value ="<?= $result ['HoTen'] ?>">
      </div>
      <div class="form-group">
        <label>SDT:</label>
        <input type="text" class="form-control" id="SDT" name="SDT" value ="<?= $result ['SDT'] ?>">
      </div>
      <div class="form-group">
        <label>Email:</label>
        <input type="text" class="form-control" id="Email" name="Email" value ="<?= $result ['Email'] ?>">
      </div>
      <div class="form-group">
        <label >Vai Trò:</label>
        <select name="VaiTro" id="VaiTro">
            <option value="HDV" <?= ($result['VaiTro'] == 'HDV') ? 'selected' : '' ?>>HDV</option>
        </select>
    </div>
      <div class="form-group">
        <label >Ghi Chú:</label>
        <input type="text" class="form-control" id="GhiChu" name="GhiChu" value ="<?= $result ['GhiChu'] ?>">
      </div>
      <button type="submit" name="btn-update" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>