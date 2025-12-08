<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Sửa Tour</title>
  <style>
    :root{
      --bg: #f5f7fb;
      --card: #ffffff;
      --accent: #2563eb;
      --muted: #6b7280;
      --danger: #ef4444;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    *{box-sizing:border-box}
    body{
      margin:0;
      background:linear-gradient(180deg,#eef2ff 0%, var(--bg) 100%);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px;
      color:#0f172a;
      -webkit-font-smoothing:antialiased;
    }

    .card{
      width:100%;
      max-width:720px;
      background:var(--card);
      border-radius:12px;
      box-shadow:0 8px 30px rgba(2,6,23,0.08);
      padding:28px;
    }

    h1{font-size:20px;margin:0 0 6px}
    p.lead{margin:0 0 18px;color:var(--muted)}

    form{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:16px;
    }

    .full{grid-column:1/-1}

    label{
      display:block;
      font-size:13px;
      color:var(--muted);
      margin-bottom:6px;
    }

    input[type="text"], select, input[type="date"]{
      width:100%;
      padding:10px 12px;
      border:1px solid #e6e9ef;
      border-radius:8px;
      font-size:14px;
      background:transparent;
      outline:none;
      transition:box-shadow .12s, border-color .12s;
    }

    input:focus, select:focus, textarea:focus{
      box-shadow:0 4px 14px rgba(37,99,235,0.12);
      border-color:var(--accent);
    }

    .hint{font-size:12px;color:var(--muted);margin-top:6px}

    .row{
      display:flex;gap:8px;align-items:center
    }

    .actions{
      display:flex;gap:10px;justify-content:flex-end;margin-top:18px;grid-column:1/-1
    }

    button{
      padding:10px 14px;border-radius:10px;border:0;font-weight:600;cursor:pointer;
    }
    .btn-save{background:var(--accent);color:#fff}
    .btn-cancel{background:transparent;border:1px solid #e6e9ef;color:var(--muted)}

    .error{color:var(--danger);font-size:13px;margin-top:6px}

    @media (max-width:640px){
      form{grid-template-columns:1fr}
      .actions{justify-content:stretch}
    }
    .a{
      text-decoration: none;
      color: black;
    }
  </style>
</head>
<body>
  <div class="card" role="region" aria-label="Form sửa thông tin tour">
    <p class="lead">Sửa Lịch Làm Việc Của HDV</p>
 
    <form id="editForm" novalidate action="<?= BASE_URL ?>?mode=admin&act=updatelichlam&id=<?= $data['MaLichHDV'] ?>" method="post">
      <div class="full">
        <label for="fullname">Họ tên</label>
        <select name="MaNhanSu" required>
    <option value="">Chọn HDV</option>
    <?php foreach($dataNhanSu as $value){ ?>
        <option value="<?= htmlspecialchars($value['MaNhanSu']) ?>"
            <?= (isset($data['MaNhanSu']) && $data['MaNhanSu'] == $value['MaNhanSu']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($value['HoTen']) ?>
        </option>
    <?php } ?>
</select>
        </select>
      </div>

      <div class="full">
        <label for="tourname">Tên tour</label>
        <select name="MaQuanLy" required>
    <option value="">Chọn Tour</option>
    <?php foreach($dataQuanLy as $value){ ?>
        <option value="<?= htmlspecialchars($value['MaQuanLy']) ?>"
            <?= (isset($data['MaQuanLy']) && $data['MaQuanLy'] == $value['MaQuanLy']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($value['TenTour']) ?>
        </option>
    <?php } ?>
    </select>
      </div>

      <div>
        <label for="role">Vai trò</label>
        <select id="VaiTro" name="VaiTro" required>
           <option value="phụ"   <?= $data['VaiTro']=='phụ' ? 'selected' : '' ?>>Phụ</option>
           <option value="chính" <?= $data['VaiTro']=='chính' ? 'selected' : '' ?>>Chính</option>
        </select>
      </div>

      <div>
        <label for="start">Ngày bắt đầu</label>
        <input type="date" id="NgayBatDau" name="NgayBatDau" value="<?= $data['NgayBatDau'] ?>" required />
      </div>

      <div>
        <label for="end">Ngày kết thúc</label>
        <input type="date" id="NgayKetThuc" name="NgayKetThuc" value="<?= $data['NgayKetThuc'] ?>" required />
      </div>

      <div class="full">
        <div id="dateError" class="error" aria-live="polite" style="display:none"></div>
      </div>

      <div class="actions">
        <button type="button" class="btn-cancel" id="cancelBtn"  ><a class="a" href="<?= BASE_URL ?>?mode=admin&act=lichlamviechdv">Huỷ</a></button>
        <button type="submit" class="btn-save">Lưu thay đổi</button>
      </div>
    </form>
  </div>


</body>
</html>
