<?php
    require_once 'silderbar.php';
?>

<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Danh mục Tour</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=add'?>" method="POST">
      <div class="form-group">
        <label >TenDanhMuc: </label>
        <input type="text" class="form-control" id="TenDanhMuc" name="TenDanhMuc">
      </div>
      <div class="form-group">
        <label >Mo Ta:</label>
        <input type="text" class="form-control" id="MoTa" name="MoTa">
      </div>
      <div class="form-group">
        <label >TrangThai:</label>
        <select name="TrangThai" id="TrangThai">
            <option value="1">hoạt động</option>
            <option value="2">ngưng hoạt động</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>