<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa Nhật Ký Tour</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./views/hdv/silderbar.css">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
      display: flex;
    }

    /* Sidebar giữ nguyên từ silderbar.css */

    /* Container chính */
    .main-container {
      flex: 1;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    /* Khung form */
    .form-container {
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      max-width: 600px;
      width: 100%;
    }

    /* Tiêu đề */
    .form-container h1 {
      text-align: center;
      font-size: 1.6rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 25px;
    }

    /* Nhóm input */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: 500;
      margin-bottom: 8px;
      color: #374151;
    }

    /* Input & textarea */
    .form-control {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
      outline: none;
    }

    /* Nút hành động */
    .btn-submit {
      background: #f59e0b;
      color: #fff;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .btn-submit:hover {
      background: #d97706;
    }

    .btn-cancel {
      margin-left: 12px;
      color: #374151;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .btn-cancel:hover {
      color: #ef4444;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .form-container {
        padding: 20px;
      }
      .form-container h1 {
        font-size: 1.4rem;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>
    <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i>Lịch làm việc</a>
    <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
    <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
    <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
    <hr>
    <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;">
      <i class="fas fa-sign-out-alt"></i> Đăng xuất
    </a>
  </div>

  <!-- Form -->
  <div class="main-container">
    <div class="form-container">
      <h1>Sửa Nhật Ký Tour</h1>
     <form action="<?= BASE_URL . '?mode=hdv&act=updatenhatkytour' ?>" method="POST" enctype="multipart/form-data">
  
  <input type="hidden" name="MaNhatKy" value="<?= htmlspecialchars($nhatkytour['MaNhatKy'] ?? '') ?>">

  <div class="form-group">
    <label for="Ngay">Ngày:</label>
    <input type="date" class="form-control" id="Ngay" name="Ngay" required
           value="<?= htmlspecialchars($nhatkytour['Ngay'] ?? '') ?>">
  </div>

  <div class="form-group">
    <label for="SuKien">Sự Kiện:</label>
    <textarea class="form-control" id="SuKien" name="SuKien" rows="3"><?= htmlspecialchars($nhatkytour['SuKien'] ?? '') ?></textarea>
  </div>

  <div class="form-group">
    <label for="HinhAnhSuCo">Hình ảnh sự cố (nếu có):</label>
    
    <?php if (!empty($nhatkytour['HinhAnhSuCo'])): ?>
        <div style="margin: 10px 0;">
            <img src="./uploads/<?= htmlspecialchars($nhatkytour['HinhAnhSuCo']) ?>" alt="Ảnh sự cố hiện tại" style="max-height: 150px; border: 1px solid #ddd; padding: 5px;">
            <br>
            <small>Ảnh hiện tại (Nếu không chọn ảnh mới, ảnh này sẽ được giữ nguyên)</small>
            <input type="hidden" name="HinhAnhCu" value="<?= htmlspecialchars($nhatkytour['HinhAnhSuCo']) ?>">
        </div>
    <?php endif; ?>

    <input type="file" class="form-control" name="HinhAnhSuCo" accept="image/*">
  </div>

  <div class="form-group">
    <label for="SuCo">Sự Cố:</label>
    <textarea class="form-control" id="SuCo" name="SuCo" rows="3"><?= htmlspecialchars($nhatkytour['SuCo'] ?? '') ?></textarea>
  </div>

  <div class="form-group">
    <label for="PhanHoiKhach">Phản Hồi Khách:</label>
    <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3"><?= htmlspecialchars($nhatkytour['PhanHoiKhach'] ?? '') ?></textarea>
  </div>

  <button type="submit" name="btn-update" class="btn-submit">Cập Nhật Nhật Ký</button>
  <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="btn-cancel">Hủy</a>
</form>
    </div>
  </div>
</body>
</html>