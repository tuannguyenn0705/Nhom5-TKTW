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
  <a href="<?= BASE_URL . '?mode=admin&act=form' ?>" class="add-button">Thêm danh mục</a>
</div>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>MaQuanLy</th>
      <!-- <th>MaChiTietTour</th> -->
      <th>TenTour</th>
      <th>NgayBatDau</th>
      <th>NgayKetThuc</th>
      <th>HDVDuocPhanCong</th>
      <th>Trạng Thái</th>
      <th>Hành Động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaQuanLy']) ?></td>
        <!-- <td><?= htmlspecialchars($row['MaChiTietTour']) ?></td> -->
        <td><?= htmlspecialchars($row['TenTour']) ?></td>
        <td><?= htmlspecialchars($row['NgayBatDau']) ?></td>
        <td><?= htmlspecialchars($row['NgayKetThuc']) ?></td>
        <td><?= htmlspecialchars($row['TenHDV']) ?></td>
        <td><?= htmlspecialchars($row['TrangThai']) ?></td>
        <td>
          <!-- <a href="<?= BASE_URL . '?mode=admin&act=edit-quan-ly-tuor&id=' . $row['MaQuanLy'] ?>">Sửa</a> -->
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>