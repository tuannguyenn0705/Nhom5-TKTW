<link rel="stylesheet" href="./views/css/edit.css">
<div class="main-container">
  <div class="form-container">
    <h1>Sửa Danh mục Tour</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=update'?>" method="POST">
      <div class="form-group">
        <input type="hidden" name="MaDanhMuc" value="<?php echo $result['MaDanhMuc']; ?>">
        <label >TenDanhMuc: </label>
        <input type="text" class="form-control" id="TenDanhMuc" name="TenDanhMuc" value ="<?= $result ['TenDanhMuc'] ?>">
      </div>
      <div class="form-group">
        <label >Mo Ta:</label>
        <input type="text" class="form-control" id="MoTa" name="MoTa" value ="<?= $result ['MoTa'] ?>">
      </div>
      <div class="form-group">
        <label >TrangThai:</label>
        <select name="TrangThai" id="TrangThai">
            <option value="1" <?= ($result['TrangThai'] == 1) ? 'selected' : '' ?>>hoạt động</option>
            <option value="2" <?= ($result['TrangThai'] == 2) ? 'selected' : '' ?>>ngưng hoạt động</option>
        </select>
    </div>
      <button type="submit" name="btn-update" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>