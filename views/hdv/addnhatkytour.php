<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Nhật Ký Tour</title>
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

    /* Container chính */
    .main-content {
      flex: 1;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    /* Card form */
    .form-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      max-width: 650px;
      width: 100%;
    }

    .form-header h1 {
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
    .form-actions {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .btn {
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s ease, color 0.3s ease;
    }

    .btn-primary {
      background: #3b82f6;
      color: #fff;
      border: none;
    }

    .btn-primary:hover {
      background: #2563eb;
    }

    .btn-secondary {
      background: #e5e7eb;
      color: #374151;
      border: none;
    }

    .btn-secondary:hover {
      background: #d1d5db;
      color: #111827;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .form-card {
        padding: 20px;
      }
      .form-header h1 {
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
  <div class="main-content">
    <div class="form-card">
      <div class="form-header">
        <h1>Thêm Nhật Ký Tour</h1>
      </div>
      
      <form action="<?= BASE_URL . '?mode=hdv&act=addnhatkytour' ?>" method="POST">

        <div class="form-group">
          <label for="MaQuanLy">Chọn Tour</label>
          <select class="form-control" name="MaQuanLy" id="MaQuanLy" required onchange="tuDongDienHDV()">
            <option value="" data-guide-id="" data-guide-name="">-- Chọn Tour --</option>
            <?php if (!empty($dsTour)): ?>
              <?php foreach ($dsTour as $tour): ?>
                <?php 
                  $hasGuide = !empty($tour['HDVDuocPhanCong']); 
                  $guideName = $tour['TenHDV'] ?? 'Chưa Phân Công';
                  $displayText = $tour['TenTour'] . ($hasGuide ? "" : " (Chưa có HDV)");
                  $class = $hasGuide ? "" : "text-danger"; 
                ?>
                <option 
                  value="<?= $tour['MaQuanLy'] ?>" 
                  data-guide-id="<?= $tour['HDVDuocPhanCong'] ?>" 
                  data-guide-name="<?= $guideName ?>"
                  class="<?= $class ?>"
                >
                  <?= htmlspecialchars($displayText) ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="TenNhanSuHienThi">HDV Phụ Trách</label>
          <input type="text" class="form-control" id="TenNhanSuHienThi" readonly placeholder="Tên HDV sẽ hiển thị tự động...">
          <input type="hidden" id="MaNhanSu" name="MaNhanSu">
        </div>

        <div class="form-group">
          <label for="Ngay">Ngày ghi nhận</label>
          <input type="date" class="form-control" id="Ngay" name="Ngay" required value="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group">
          <label for="SuKien">Sự Kiện</label>
          <textarea class="form-control" id="SuKien" name="SuKien" rows="3" placeholder="Mô tả sự kiện..."></textarea>
        </div>

        <div class="form-group">
          <label for="SuCo">Sự Cố</label>
          <textarea class="form-control" id="SuCo" name="SuCo" rows="3" placeholder="Ghi nhận sự cố (nếu có)..."></textarea>
        </div>

        <div class="form-group">
          <label for="PhanHoiKhach">Phản Hồi Khách Hàng</label>
          <textarea class="form-control" id="PhanHoiKhach" name="PhanHoiKhach" rows="3" placeholder="Ý kiến khách hàng..."></textarea>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Lưu Nhật Ký</button>
          <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="btn btn-secondary">Hủy bỏ</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function tuDongDienHDV() {
      var selectBox = document.getElementById('MaQuanLy');
      var selectOption = selectBox.options[selectBox.selectedIndex];
      
      var guideId = selectOption.getAttribute('data-guide-id');
      var guideName = selectOption.getAttribute('data-guide-name');

      document.getElementById('MaNhanSu').value = guideId;
      document.getElementById('TenNhanSuHienThi').value = guideName;
    }
  </script>
</body>
</html>