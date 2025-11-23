<?php
require_once 'silderbar.php';
?>
<h1>Quản Lý Tour</h1>
    <div class="action-container">
        <input type="text" name="search" id="search" placeholder="Tìm kiếm theo Tên Danh Mục...">
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
        <!-- <a href="<?= BASE_URL . '?mode=admin&act=edit-quan-ly-tuor&id='. $row['MaQuanLy']?>">Sửa</a> -->
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>