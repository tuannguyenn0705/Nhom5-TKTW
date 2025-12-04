<?php
require_once 'silderbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="views/css/DanhSachKhach.css">
</head>
<body>
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
  <!-- <a href="#" class="add-button">Thêm danh mục</a> -->
</div>
  <!-- <div class="menu">
    <a href="?mode=admin&act=danhsachkhach&view=thongtin" class="active">thông tin</a>
  
    <a href="?mode=admin&act=danhsachkhach&view=checkin">checkin</a>

    <a href="?mode=admin&act=danhsachkhach&view=yeucaudacbiet">yêu cầu đặc biệt</a>
  </div> -->
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Mã Khách </th>
      <!-- <th>Mã Đặt Tour</th> -->
      <th>Đi Tour</th>
      <th>Họ Tên</th>
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
        <td>
          <?= $value['YeuCauDacBiet'] ?>
          <br>
          <a href="javascript:void(0)"
              onclick="updateSpecialRequest(<?= $value['MaKhach'] ?>)"
              style="font-size: 15px; color: blue;";>[Sửa yêu cầu]</a>
        </td>
        <script>
          function updateSpecialRequest(id){
            let text = prompt('Nhập yêu cầu đặc biệt...', '');
            if(text != null){
              window.location.href = `?mode=admin&act=update_request&id=${id}&content=${encodeURIComponent(text)}`;
            }
          }
        </script>
      </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>
