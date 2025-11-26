<?php
require_once 'silderbar.php';
?>
<h1>Danh Sách Khách Tham Gia Tour</h1>
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

  <?php
  $keyword =  isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
  if ($keyword != '') {
    $keyword_lower = strtolower($keyword);
    $keyword_upper = strtoupper($keyword);
    $dskhach = array_filter($dskhach, function ($value) use ($keyword_lower, $keyword_upper) {
      if (strtoupper($value['MaKhach']) === $keyword_upper) {
        return true;
      }
      return strpos(strtolower($value['TenTour']), $keyword_lower) !== false ||
        strpos(strtolower($value['HoTen']), $keyword_lower) !== false;
    });
  }
  ?>
  <a href="#" class="add-button">Thêm danh mục</a>
</div>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Mã Khách </th>
      <!-- <th>Mã Đặt Tour</th> -->
      <th>Đi Tour</th>
      <th>Họ Tên</th>
      <th>Giới Tính</th>
      <th>Yêu cầu Đặc Biệt</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dskhach as $value) { ?>
      <tr>
        <td><?= $value['MaKhach'] ?></td>
        <!-- <td><?= $value['MaDatTour'] ?></td> -->
        <td><?= $value['TenTour'] ?? 'Tour không tồn tại' ?></td>
        <td><?= $value['HoTen'] ?></td>
        <td><?= $value['GioiTinh'] ?></td>
        <td><?= $value['YeuCauDacBiet'] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>