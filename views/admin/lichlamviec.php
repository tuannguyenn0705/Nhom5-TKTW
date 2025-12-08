<?php require_once 'silderbar.php'; ?>

<style>
  /* CSS Riêng cho trang Phân Bố */
  .phanbo-container {
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
  }

  .section-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 15px;
    margin-top: 30px;
    border-left: 5px solid #3498db;
    padding-left: 10px;
    font-weight: bold;
  }

  .table-wrapper {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 30px;
  }

  .custom-table {
    width: 100%;
    border-collapse: collapse;
  }

  .custom-table th,
  .custom-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
    vertical-align: middle; /* Căn giữa theo chiều dọc */
  }

  .custom-table th {
    background-color: #f8f9fa;
    color: #555;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
  }

  .custom-table tr:hover {
    background-color: #f1f5f9;
  }

  .status-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
  }

  .status-unassigned {
    background: #fee2e2;
    color: #991b1b;
  }

  .status-assigned {
    background: #dcfce7;
    color: #166534;
  }

  /* --- CHỈNH SỬA NÚT PHÂN CÔNG ĐẸP HƠN --- */
  .btn-assign {
    background-color: #3b82f6;
    color: white;
    padding: 8px 16px; /* Tăng padding */
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: 0.3s;
    /* Flexbox để căn chỉnh icon và chữ */
    display: inline-flex;
    align-items: center;
    gap: 8px; /* Khoảng cách giữa icon và chữ */
    white-space: nowrap; /* Quan trọng: Chống xuống dòng */
    font-weight: 500;
  }

  .btn-assign:hover {
    background-color: #2563eb;
    box-shadow: 0 2px 5px rgba(37, 99, 235, 0.3); /* Thêm bóng đổ nhẹ khi hover */
  }

  .btn-edit-custom {
    background-color: #f59e0b;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    white-space: nowrap;
  }

  .btn-edit-custom:hover {
    background-color: #d97706;
  }

  .empty-mess {
    padding: 20px;
    text-align: center;
    color: #888;
    font-style: italic;
  }
</style>

<div class="phanbo-container">
  <h1>Quản Lý Phân Bố HDV</h1>

  <div class="section-title">Danh sách Tour CHƯA có HDV</div>
  <div class="table-wrapper">
    <table class="custom-table">
      <thead>
        <tr>
          <th>Mã Tour</th>
          <th>Tên Tour</th>
          <th>Thời gian dự kiến</th>
          <th>Trạng Thái</th>
          <th width="180">Hành Động</th> </tr>
      </thead>
      <tbody>
        <?php if (!empty($listUnassigned)): ?>
          <?php foreach ($listUnassigned as $row): ?>
            <tr>
              <td>#<?= htmlspecialchars($row['MaQuanLy']) ?></td>
              <td style="font-weight: bold; color: #2c3e50;">
                <?= htmlspecialchars($row['TenTour']) ?>
              </td>
              <td>
                <?= date('d/m/Y', strtotime($row['NgayBatDau'])) ?> -
                <?= date('d/m/Y', strtotime($row['NgayKetThuc'])) ?>
              </td>
              <td><span class="status-badge status-unassigned">Chưa phân công</span></td>
              <td>
                <a href="<?= BASE_URL ?>?mode=admin&act=addlichlamviec&id_tour=<?= $row['MaQuanLy'] ?>" class="btn-assign">
                  <i class="fa fa-plus-circle"></i> Phân công ngay
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="empty-mess">Tuyệt vời! Tất cả các tour đều đã có nhân sự.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="section-title">Danh sách Tour ĐÃ CÓ HDV (Lịch làm việc)</div>
  <div class="table-wrapper">
    <table class="custom-table">
      <thead>
        <tr>
          <th>Mã Lịch</th>
          <th>Hướng Dẫn Viên</th>
          <th>Tên Tour</th>
          <th>Thời Gian Công Tác</th>
          <th width="100">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($listAssigned)): ?>
          <?php foreach ($listAssigned as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['MaLichHDV']) ?></td>
              <td style="font-weight: 600; color: #0f172a;">
                <?= htmlspecialchars($row['HoTen']) ?>
              </td>
              <td><?= htmlspecialchars($row['TenTour']) ?></td>
              <td>
                <?php
                // Code hiển thị ngày tháng đã sửa lỗi NULL
                echo !empty($row['NgayBatDau']) ? date('d/m/Y', strtotime($row['NgayBatDau'])) : '...';
                ?>
                <br>
                <span style="font-size:12px; color:#888">đến</span>

                <?php
                echo !empty($row['NgayKetThuc']) ? date('d/m/Y', strtotime($row['NgayKetThuc'])) : '...';
                ?>
              </td>
              <td>
                <a href="<?= BASE_URL ?>?mode=admin&act=editlichlam&id=<?= $row['MaLichHDV'] ?>" class="btn-edit-custom">
                  Sửa
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="empty-mess">Chưa có lịch làm việc nào được tạo.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>