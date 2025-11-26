<?php
require_once 'silderbar.php';
?>
<h1>Danh Sách Khách Tham Gia Tour</h1>
<div class="action-container">
  <form action="" method="get" class="search-form">
    
    <input type="text" name="keyword" placeholder="Nhập tên hướng dẫn viên...">
    <button type="submit">Tìm kiếm</button>
  </form>


  <a href="#" class="add-button">Thêm</a>
</div>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Mã Khách </th>
      <th>Mã Đặt Tour</th>
      <th>Mã Quản Lý</th>
      <th>Họ Tên</th>
      <th>Giới Tính</th>
      <th>Yêu cầu Đặc Biệt</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($dskhach as $value){ ?>
      <tr>
        <td><?= $value['MaKhach'] ?></td>
        <td><?= $value['MaDatTour'] ?></td>
        <td><?= $value['MaQuanLy'] ?></td>
        <td><?= $value['HoTen'] ?></td>
        <td><?= $value['GioiTinh'] ?></td>
        <td><?= $value['YeuCauDacBiet'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>