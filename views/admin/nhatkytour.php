<?php
require_once 'silderbar.php';
?>
<h1>Quản Lý Nhật Ký Tour</h1>
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
    <input type="text" name="keyword" placeholder="Nhập mã quản lý hoặc sự kiện..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
    <button type="submit">Tìm kiếm</button>
  </form>

  <?php
  $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
  if ($keyword != '') {
    $keyword_lower = strtolower($keyword);
    $keyword_upper = strtoupper($keyword);
    $data = array_filter($data, function ($row) use ($keyword_lower, $keyword_upper) {
      return strpos(strtolower($row['SuKien'] ?? ''), $keyword_lower) !== false ||
             strpos(strtolower($row['SuCo'] ?? ''), $keyword_lower) !== false ||
             strpos(strtolower($row['PhanHoiKhach'] ?? ''), $keyword_lower) !== false ||
             strtoupper($row['MaNhatKy' ?? '']) === $keyword_upper;
    });
  }
  ?>
  <a href="<?= BASE_URL . '?mode=admin&act=formnhatkytour' ?>" class="add-button">Thêm nhật ký</a>
</div>
<table border="1">
  <thead>
    <tr>
      <th>MaNhatKy</th>
      <th>Tên Tour</th>
      <th>HDV Phụ Trách</th>
      <th>Ngày</th>
      <th>Sự Kiện</th>
      <th>Sự Cố</th>
      <th>Phản Hồi Khách</th>
      <th>Hành Động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaNhatKy'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['TenTour'] ?? 'Tour không tồn tại') ?></td>
        <td><?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?></td>
        <td><?= htmlspecialchars($row['Ngay'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['SuKien'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['SuCo'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['PhanHoiKhach'] ?? '') ?></td>
        <td>
          <a href="<?= BASE_URL . '?mode=admin&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>"
             class="btn-action btn-delete"
             onclick="return confirm('Bạn có chắc chắn muốn xóa nhật ký này không?')">
             Xóa
          </a>
          <a href="<?= BASE_URL . '?mode=admin&act=editnhatkytour&id=' . urlencode($row['MaNhatKy']) ?>"
             class="btn-action btn-edit">
             Sửa
          </a>
           <a  href="<?= BASE_URL ?>?mode=admin&act=detail&id=<?= $row['MaNhatKy'] ?>">Xem chi tiết</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>