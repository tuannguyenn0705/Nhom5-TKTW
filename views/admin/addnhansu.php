<?php
require_once 'silderbar.php';
?>

<link rel="stylesheet" href="./views/css/addDanhMuc.css">

<div class="main-container">
  <div class="form-container">
    <h1>Thêm Nhân Sự</h1>
    <form action="<?= BASE_URL . '?mode=admin&act=addnhansu' ?>" method="POST">
      <div class="form-group">
        <label>Họ Tên: </label>
        <input type="text" class="form-control" id="HoTen" name="HoTen">
      </div>
      <div class="form-group">
        <label>SDT: </label>
        <input type="text" class="form-control" id="SDT" name="SDT">
      </div>
      <div class="form-group">
        <label>Email: </label>
        <input type="text" class="form-control" id="Email" name="Email">
      </div>

      <div class="form-group">
        <label>Vai Trò:</label>
        <select name="VaiTro" id="VaiTro">
          <option value="HDV">HDV</option>
        </select>
      </div>
      <div class="form-group">
        <label>Ghi Chú:</label>
        <input type="text" class="form-control" id="GhiChu" name="GhiChu">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>