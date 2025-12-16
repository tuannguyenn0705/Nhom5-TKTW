<?php
    require_once 'silderbar.php';
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sửa Lịch Làm Việc</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #4f46e5; 
      --bg-gray: #f3f4f6;
      --text-dark: #1f2937;
      --border-color: #e5e7eb;
    }
    * { box-sizing: border-box; }
    
    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-gray);
    }

    .main-content-wrapper {
        display: flex;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        width: 100%;
    }

    .edit-card {
      background: #ffffff;
      width: 100%;
      max-width: 700px;
      border-radius: 12px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      padding: 35px;
      margin: 0 20px;
    }

    .form-header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 20px;
    }

    .form-header h2 {
      margin: 0;
      color: var(--text-dark);
      font-size: 22px;
    }

    .form-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .admin-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .full-width {
      grid-column: 1 / -1; 
    }

    .form-group {
      margin-bottom: 5px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      margin-bottom: 8px;
    }

    .admin-form input[type="text"],
    .admin-form input[type="date"],
    .admin-form select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 14px;
      background-color: #fff;
      transition: all 0.2s;
      outline: none;
      height: 42px; 
    }

    .admin-form input:focus,
    .admin-form select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .input-locked {
        background-color: #f9fafb !important;
        color: #9ca3af !important;
        cursor: not-allowed;
        border-color: #f3f4f6 !important;
    }

    .form-actions {
      grid-column: 1 / -1;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 15px;
      padding-top: 20px;
      border-top: 1px solid var(--border-color);
    }

    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 14px;
      text-decoration: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: 0.2s;
      border: none;
    }

    .btn-cancel {
      background: #fff;
      border: 1px solid var(--border-color);
      color: #374151;
    }
    .btn-cancel:hover {
        background: #f3f4f6;
    }

    .btn-save {
      background: var(--primary-color);
      color: white;
    }
    .btn-save:hover {
      background: #4338ca;
    }

    @media (max-width: 640px) {
      .admin-form { grid-template-columns: 1fr; }
      .form-actions { flex-direction: column-reverse; }
      .btn { width: 100%; }
    }
  </style>
</head>
<body>

  <div class="main-content-wrapper">
      
      <div class="edit-card">
        <div class="form-header">
            <h2>Cập Nhật Lịch Làm Việc</h2>
            <p>Chỉnh sửa thông tin phân công hướng dẫn viên</p>
        </div>
     
        <form class="admin-form" id="editForm" action="<?= BASE_URL ?>?mode=admin&act=updatelichlam&id=<?= $data['MaLichHDV'] ?>" method="post">
          
          <div class="form-group full-width">
            <label>Hướng Dẫn Viên</label>
            <select name="MaNhanSu" required>
                <option value="">-- Chọn nhân sự --</option>
                <?php foreach($dataNhanSu as $value){ 
                    if(strtoupper($value['VaiTro']) === 'ADMIN') { continue; }
                ?>
                    <option value="<?= htmlspecialchars($value['MaNhanSu']) ?>"
                        <?= (isset($data['MaNhanSu']) && $data['MaNhanSu'] == $value['MaNhanSu']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($value['HoTen']) ?>
                    </option>
                <?php } ?>
            </select>
          </div>

          <div class="form-group full-width">
            <label>Tên Tour (Cố định)</label>
            <select class="input-locked" disabled>
                <?php foreach($dataQuanLy as $value){ ?>
                    <option value="<?= htmlspecialchars($value['MaQuanLy']) ?>"
                        <?= (isset($data['MaQuanLy']) && $data['MaQuanLy'] == $value['MaQuanLy']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($value['TenTour']) ?>
                    </option>
                <?php } ?>
            </select>
            <input type="hidden" name="MaQuanLy" value="<?= $data['MaQuanLy'] ?>">
          </div>

          <div class="form-group">
            <label>Ngày bắt đầu</label>
            <input type="date" name="NgayBatDau" 
                   value="<?= $data['NgayBatDau'] ?>" 
                   class="input-locked" readonly required />
          </div>

          <div class="form-group">
            <label>Ngày kết thúc</label>
            <input type="date" name="NgayKetThuc" 
                   value="<?= $data['NgayKetThuc'] ?>" 
                   class="input-locked" readonly required />
          </div>

          <div class="form-actions">
            <a href="<?= BASE_URL ?>?mode=admin&act=lichlamviechdv" class="btn btn-cancel">Quay lại</a>
            
            <button type="submit" class="btn btn-save">Lưu thay đổi</button>
          </div>
        </form>
      </div>
  </div>

</body>
</html>