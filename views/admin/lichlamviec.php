<?php
require_once 'silderbar.php';
?>
<h1>Quản Lý Tour</h1>
<div class="action-container">
  <form action="" method="get" class="search-form">
    <?php
    if (isset($_GET['mode'])) {
      echo '<input type="hidden" name="mode" value="' . htmlspecialchars($_GET['mode']) . '">';
    }
    if (isset($_GET['act'])) {
      echo '<input type="hidden" name="act" value="' . htmlspecialchars($_GET['act']) . '">';
    }
    ?>
    <input type="text" name="keyword" placeholder="Nhập tên danh mục..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
    <button type="submit">Tìm kiếm</button>
  </form>


  <a href="#" class="add-button">Thêm lỊch làm</a>
</div>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Mã Lịch HDV </th>
      <th>Mã Nhân Sự</th>
      <th>Mã Quản Lý</th>
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
        <td><?= $value['TenTour'] ?></td>
        <td><?= $value['VaiTro'] ?></td>
        <td>
            <a href=""></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>