<?php
require_once 'silderbar.php';
?>
<h1>Phân Bố</h1>
<div class="action-container">
  <form action="" method="get" class="search-form">
    
    <input type="text" name="keyword" placeholder="Nhập tên hướng dẫn viên...">
    <button type="submit">Tìm kiếm</button>
  </form>


  <a href="<?= BASE_URL ?>?mode=admin&act=addlichlamviec" class="add-button">Thêm Phân Bố</a>
</div>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Mã Lịch HDV </th>
      <th>Tên HDV</th>
      <th>Tên Tour</th>
      <th>Vai Trò</th>
      <th>Hành Động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $value){ ?>
      <tr>
        <td><?= $value['MaLichHDV'] ?></td>
        <td><?= $value['MaNhanSu'] ?></td>
        <td><?= $value['MaQuanLy'] ?></td>
        <td><?= $value['VaiTro'] ?></td>
        <td>
            <div class="action-buttons">
                <a href="" class="btn-action btn-edit"> Sửa</a>
                <a href="<?= BASE_URL ?>?mode=admin&act=deletelichlam&id=<?= $value['MaLichHDV']?>"class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa lịch này không?')">
                    Xóa
                </a>
            </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>