
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang HDV</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/hdv/silderbar.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>

        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i>Lịch làm việc</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        <div class="header">
           <h1>Quản Lý Nhật Ký Tour</h1>
        </div>
        
        <div class="action-container">
            <a href="<?= BASE_URL . '?mode=hdv&act=formnhatkytour' ?>" class="add-button"><i class="fas fa-plus"></i> Thêm nhật ký</a>
        </div>

        <table class="table-fullscreen">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Tour</th>
                    <th>HDV Phụ Trách</th>
                    <th>Ngày</th>
                    <th>Sự Kiện</th>
                    <th>Sự Cố</th>
                    <th>Phản Hồi</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                    <tr>
                        <td style="text-align: center;"><?= htmlspecialchars($row['MaNhatKy'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['TenTour'] ?? 'Tour không tồn tại') ?></td>
                        <td><?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['Ngay'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['SuKien'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['SuCo'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['PhanHoiKhach'] ?? '') ?></td>
                        <td style="text-align: center;">
                            <a href="<?= BASE_URL . '?mode=hdv&act=editnhatkytour&id=' . urlencode($row['MaNhatKy']) ?>"
                               class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                            <a href="<?= BASE_URL . '?mode=hdv&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>"
                               class="btn-action btn-delete"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa nhật ký này không?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" style="text-align: center;">Chưa có nhật ký nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<style>

    /* Reset cơ bản cho main-content */
    body {
        background-color: #f3f4f6; /* Màu nền tổng thể xám nhẹ */
        margin: 0;
        font-family: 'Inter', sans-serif;
    }

    /* --- PHẦN MAIN CONTENT --- */
    .main-content {
        /* Giả định sidebar rộng 260px. Hãy chỉnh số này bằng đúng width của sidebar bạn */
        margin-left: 260px; 
        padding: 40px;
        min-height: 100vh;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    /* Header chứa Tiêu đề */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background-color: #fff;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .header h1 {
        margin: 0;
        font-size: 1.5rem;
        color: #1f2937;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Container chứa nút Thêm */
    .action-container {
        display: flex;
        justify-content: flex-end; /* Đẩy nút sang phải */
        margin-bottom: 20px;
    }

    /* Nút Thêm Nhật Ký */
    .add-button {
        background-color: #10b981; /* Màu xanh lá */
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        transition: background 0.3s, transform 0.2s;
    }

    .add-button:hover {
        background-color: #059669;
        transform: translateY(-2px);
    }

    /* --- PHẦN BẢNG (TABLE) --- */
    .table-fullscreen {
        width: 100%; /* Lấp đầy main-content */
        border-collapse: separate;
        border-spacing: 0;
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden; /* Bo tròn góc bảng */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        font-size: 0.95rem;
    }

    .table-fullscreen thead {
        background-color: #3b82f6; /* Màu xanh dương chủ đạo */
        color: #fff;
    }

    .table-fullscreen th {
        padding: 16px;
        font-weight: 600;
        text-align: left; /* Tiêu đề canh trái nhìn đẹp hơn */
        font-size: 0.9rem;
        text-transform: uppercase;
    }
    
    /* Căn giữa cho các cột ID, Ngày, Hành động */
    .table-fullscreen th:first-child,
    .table-fullscreen th:nth-child(4), 
    .table-fullscreen th:last-child {
        text-align: center;
    }

    .table-fullscreen td {
        padding: 16px;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
        vertical-align: middle;
    }

    .table-fullscreen tr:last-child td {
        border-bottom: none;
    }

    .table-fullscreen tbody tr:hover {
        background-color: #f8fafc;
    }

    /* --- NÚT HÀNH ĐỘNG (SỬA / XÓA) --- */
    .btn-action {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        color: white;
        font-size: 0.9rem;
        transition: opacity 0.3s;
        margin: 0 4px;
    }

    .btn-action:hover {
        opacity: 0.85;
    }

    .btn-edit {
        background-color: #3b82f6; /* Xanh dương */
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }

    .btn-delete {
        background-color: #ef4444; /* Đỏ */
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 1024px) {
        .main-content {
            padding: 20px;
        }
        .table-fullscreen th, .table-fullscreen td {
            padding: 12px;
        }
    }
    
    /* Mobile: Nếu sidebar ẩn đi thì main-content full màn hình */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0; 
            padding: 15px;
        }
        
        .table-fullscreen {
            display: block;
            overflow-x: auto; /* Cho phép cuộn ngang nếu bảng quá dài */
            white-space: nowrap;
        }
    }

    a {
        text-decoration: none;
    }
.table-fullscreen {
    width: 75vw;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    background-color: #fff;
    font-size: 1rem; 
}

.table-fullscreen thead {
    background-color: #3b82f6;
    color: #fff;
    font-weight: 700;
    text-align: center;
    font-size: 1.1rem; 
}

.table-fullscreen tbody td {
    vertical-align: middle;
    text-align: center;
    padding: 14px 12px;
}

.table-fullscreen tbody tr:hover {
    background-color: #f1f5f9;
    transition: background 0.3s;
}

.status {
    display: inline-block;
    padding: 6px 18px;
    border-radius: 20px;
    font-weight: 600;
    color: #fff;
    font-size: 0.95rem;
}

.status.dang-thuc-hien {
    background-color: #f59e0b;
}

.status.chua-bat-dau {
    background-color: #3b82f6;
}

.status.hoan-thanh {
    background-color: #10b981;
}


.xem-btn {
    background-color: #3b82f6;
    color: #fff;
    border: none;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s;
}

.xem-btn i {
    margin-right: 6px;
}

.xem-btn:hover {
    background-color: #2563eb;
}


@media (max-width: 1200px) {
    .table-fullscreen thead, .table-fullscreen tbody td {
        font-size: 0.95rem;
        padding: 10px 8px;
    }
    .status {
        padding: 5px 14px;
        font-size: 0.85rem;
    }
    .xem-btn {
        padding: 6px 14px;
        font-size: 0.9rem;
    }
}
a{
    text-decoration: none;
    color: white;
}
</style>


</div>
        
    </div>
</body>
</html>
