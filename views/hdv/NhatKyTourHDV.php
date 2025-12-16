<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhật Ký Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* --- RESET & GLOBAL VARIABLES --- */
        :root {
            --primary-blue: #3b82f6; /* Xanh dương giống header bảng trong ảnh */
            --sidebar-bg: #111827;   /* Xanh đen đậm cho sidebar */
            --bg-color: #f3f4f6;     /* Xám nhạt nền web */
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; }

        /* --- SIDEBAR (Giống ảnh bên trái) --- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: #9ca3af;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar .logo {
            padding: 24px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-item {
            padding: 12px 24px;
            color: #d1d5db;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--white);
            border-left-color: var(--primary-blue);
        }

        .menu-item i { width: 20px; text-align: center; }

        .logout-section {
            margin-top: auto; /* Đẩy xuống đáy */
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .text-danger { color: #ef4444 !important; }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
        }

        /* CARD CONTAINER (Khối trắng chứa bảng) */
        .content-card {
            background-color: var(--white);
            border-radius: 16px; /* Bo góc mềm mại giống ảnh */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 24px;
            overflow: hidden; /* Đảm bảo bo góc header bảng */
        }

        /* HEADER SECTION */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark); /* Hoặc màu xanh nếu muốn giống hệt ảnh: color: var(--primary-blue); */
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Nút Thêm Mới */
        .btn-add {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-add:hover { background-color: #059669; }

        /* --- TABLE STYLE (GIỐNG ẢNH) --- */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        /* Header Bảng: Màu xanh dương */
        thead tr {
            background-color: var(--primary-blue);
            color: white;
            text-align: left;
        }

        th {
            padding: 16px;
            font-weight: 600;
            white-space: nowrap;
        }
        
        /* Căn giữa cột đầu và cuối giống ảnh */
        th:first-child, td:first-child,
        th:last-child, td:last-child,
        th.text-center, td.text-center {
            text-align: center;
        }

        td {
            padding: 16px;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        /* Zebra Striping: Dòng chẵn màu xám nhạt */
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #f0f9ff; /* Hover màu xanh rất nhạt */
        }

        /* --- STYLES CHO CÁC PHẦN TỬ CON TRONG BẢNG --- */
        .tour-name {
            font-weight: 600;
            color: var(--primary-blue);
        }

        .hdv-name {
            font-weight: 500;
        }

        .su-co-text {
            color: #ef4444;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 4px;
            display: block;
        }

        .img-thumb {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        /* Action Buttons */
        .action-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            color: white;
            font-size: 0.85rem;
            margin: 0 3px;
            transition: opacity 0.2s;
        }
        
        .action-btn:hover { opacity: 0.8; }
        .btn-edit { background-color: var(--primary-blue); }
        .btn-delete { background-color: #ef4444; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .main-content { margin-left: 0; width: 100%; padding: 15px; }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>
        
        <nav style="flex: 1; display: flex; flex-direction: column;">
            <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i> Lịch làm việc</a>
            <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
            <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item active" style="background-color: rgba(255,255,255,0.1); color: #fff; border-left-color: #3b82f6;"><i class="fas fa-book"></i> Nhật ký tour</a>
            <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
        </nav>

        <div class="logout-section">
            <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item text-danger"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="content-card">
            
            <div class="page-header">
                <h2 class="page-title">
                    <i class="fas fa-book text-primary" style="color: var(--primary-blue);"></i>
                    Quản Lý Nhật Ký Tour
                </h2>
                <a href="<?= BASE_URL . '?mode=hdv&act=formnhatkytour' ?>" class="btn-add">
                    <i class="fas fa-plus"></i> Thêm mới
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">Tên Tour</th>
                            <th style="width: 15%;">HDV Phụ Trách</th>
                            <th style="width: 10%;">Ngày</th>
                            <th style="width: 20%;">Sự Kiện & Sự Cố</th>
                            <th class="text-center" style="width: 10%;">Hình Ảnh</th>
                            <th style="width: 15%;">Phản Hồi</th>
                            <th class="text-center" style="width: 10%;">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $row): ?>
                            <tr>
                                <td class="text-center"><strong><?= $row['MaNhatKy'] ?></strong></td>

                                <td>
                                    <span class="tour-name"><?= htmlspecialchars($row['TenTour'] ?? '---') ?></span>
                                </td>

                                <td class="hdv-name">
                                    <?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?>
                                </td>

                                <td><?= date('d/m/Y', strtotime($row['Ngay'])) ?></td>

                                <td>
                                    <div><?= htmlspecialchars($row['SuKien']) ?></div>
                                    <?php if(!empty($row['SuCo'])): ?>
                                        <span class="su-co-text">
                                           <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($row['SuCo']) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php if (!empty($row['HinhAnhSuCo'])): ?>
                                        <img src="./uploads/<?= htmlspecialchars($row['HinhAnhSuCo']) ?>" 
                                             class="img-thumb" alt="Ảnh lỗi">
                                    <?php else: ?>
                                        <span style="color: #ccc; font-size: 0.8rem;">---</span>
                                    <?php endif; ?>
                                </td>

                                <td style="font-style: italic; color: #6b7280;">
                                    <?= htmlspecialchars($row['PhanHoiKhach'] ?? '') ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= BASE_URL . '?mode=hdv&act=editnhatkytour&id=' . urlencode($row['MaNhatKy']) ?>"
                                       class="action-btn btn-edit" title="Sửa"><i class="fas fa-edit"></i></a>
                                    
                                    <a href="<?= BASE_URL . '?mode=hdv&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>"
                                       class="action-btn btn-delete" title="Xóa"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="8" style="text-align: center; padding: 30px; color: #999;">Chưa có dữ liệu nhật ký nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

</body>
</html>