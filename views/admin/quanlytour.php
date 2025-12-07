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

  <?php
  $keyword =  isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
  if ($keyword != '') {
    $keyword_lower = strtolower($keyword);
    $keyword_upper = strtoupper($keyword);
    $data = array_filter($data, function ($row) use ($keyword_lower, $keyword_upper) {
      if (strtoupper($row['MaQuanLy']) === $keyword_upper) {
        return true;
      }
      return strpos(strtolower($row['TenTour']), $keyword_lower) !== false;
    });
  }
  ?>
  <a href="<?= BASE_URL . '?mode=admin&act=formquanlytour' ?>" class="add-button">Thêm tour</a>
</div>
<table border="1">
  <thead>
    <tr>
      <th>MaQuanLy</th>
      <th>TenTour</th>
      <!-- <th>Danh Mục Tuor</th> -->
      <th>Ngày Bắt Đầu</th>
      <th>Ngày Kết Thúc</th>
      <th>Giá</th>
      <th>Trạng Thái</th>
      <th>Số Lượng Khách</th>
      <th>Hành Động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaQuanLy'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['TenTour'] ?? '') ?></td>
        <!-- <td><?= htmlspecialchars($row['TenDanhMuc'] ?? '') ?></td> -->
        <td><?= htmlspecialchars($row['NgayBatDau'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['NgayKetThuc'] ?? '') ?></td>
        <td>
          <?php
          $gia = $row['Gia'] ?? 0;
          if (is_numeric($gia)) {
            echo number_format($gia, 0, '.', ',');
          } else {
            echo htmlspecialchars($gia);
          }
          ?>
          VNĐ
        </td>
        <td><?= htmlspecialchars($row['TrangThai'] ?? '') ?></td>
        <td>
          <span style="font-weight: bold; color: <?= ($row['SoLuongDaDat'] >= $row['SoLuongToiDa']) ? 'red' : 'green' ?>">
            <?= $row['SoLuongDaDat'] ?> / <?= $row['SoLuongToiDa'] ?>
          </span>
        </td>
        <td>
          <a href="<?= BASE_URL . '?mode=admin&act=xoaquanlytour&id=' . $row['MaQuanLy'] ?>"
            class="btn-action btn-delete"
            onclick="return confirm('Bạn có chắc chắn muốn xóa tour này không?')">
            Xóa
          </a>
          <a href="<?= BASE_URL . '?mode=admin&act=editquanlytour&id=' . urlencode($row['MaQuanLy']) ?>"
            class="btn-action btn-edit">
            Sửa
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>