<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang HDV - Quản lý Nhật Ký Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --danger-color: #ef4444;  
            --warning-color: #f59e0b; 
            --bg-color: #f3f4f6;     
            --text-color: #1f2937;
            --sidebar-width: 260px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: #1e293b;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #60a5fa;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #cbd5e1;
            text-decoration: none;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .sidebar .menu-item i {
            width: 24px;
            margin-right: 10px;
        }

        .sidebar .menu-item:hover {
            background-color: #334155;
            color: white;
        }

        .sidebar hr {
            border: 0;
            border-top: 1px solid #334155;
            margin: 20px 0;
        }

        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width); 
            padding: 30px;
            width: calc(100% - var(--sidebar-width));
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden; 
            overflow-x: auto; 
        }

        .table-fullscreen {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            text-align: left;
        }

        .table-fullscreen thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table-fullscreen th, 
        .table-fullscreen td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-fullscreen th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        .table-fullscreen tbody tr:last-child td {
            border-bottom: none;
        }

        .table-fullscreen tbody tr:hover {
            background-color: #f8fafc;
        }

        .action-cell {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
            color: white;
        }

        .btn-delete {
            background-color: var(--danger-color);
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }

        .btn-edit {
            background-color: var(--warning-color);
        }
        .btn-edit:hover {
            background-color: #d97706;
        }

        .btn-detail {
            background-color: #64748b;
        }
        .btn-detail:hover {
            background-color: #475569;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 10px;
            }
            .sidebar .logo, .sidebar .menu-item span {
                display: none;
            }
            .sidebar .menu-item {
                justify-content: center;
            }
            .sidebar .menu-item i {
                margin-right: 0;
            }
            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> <span>TravelWorld</span></div>

        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item">
            <i class="fas fa-briefcase"></i> <span>Lịch làm việc</span>
        </a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item">
            <i class="fas fa-user-tie"></i> <span>Danh Sách Khách</span>
        </a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkyTour" class="menu-item" style="background-color: #334155; color: white;">
            <i class="fas fa-book"></i> <span>Nhật ký tour</span>
        </a>
        <a href="#" class="menu-item">
            <i class="fas fa-check-double"></i> <span>Check-in</span>
        </a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span>
        </a>
    </div>

    <div class="main-content">
        
        <div class="page-header">
            <h2>Nhật Ký Tour</h2>
        </div>

        <div class="table-container">
            <table class="table-fullscreen">
                <thead>
                    <tr>
                        <th>Mã NK</th>
                        <th>Tên Tour</th>
                        <th>HDV Phụ Trách</th>
                        <th>Ngày</th>
                        <th>Sự Kiện</th>
                        <th>Sự Cố</th>
                        <th>Phản Hồi</th>
                        <th style="text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['MaNhatKy'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['TenTour'] ?? 'Tour không tồn tại') ?></td>
                            <td><?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?></td>
                            <td><?= htmlspecialchars($row['Ngay'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['SuKien'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['SuCo'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['PhanHoiKhach'] ?? '-') ?></td>
                            <!-- <td class="action-cell">
                                <a href="<?= BASE_URL ?>?mode=admin&act=detail&id=<?= $row['MaNhatKy'] ?>" 
                                   class="btn-action btn-detail" title="Xem chi tiết">
                                   <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASE_URL . '?mode=admin&act=editnhatkytour&id=' . urlencode($row['MaNhatKy']) ?>"
                                   class="btn-action btn-edit" title="Sửa">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASE_URL . '?mode=admin&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>"
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa nhật ký này không?')" title="Xóa">
                                   <i class="fas fa-trash-alt"></i>
                                </a>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 20px;">Không có dữ liệu nhật ký tour nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>