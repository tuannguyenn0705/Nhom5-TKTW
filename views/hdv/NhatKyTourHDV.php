<?php 
// Đảm bảo biến $data tồn tại để không báo lỗi nếu controller chưa truyền
$data = $data ?? []; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhật Ký Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="./views/hdv/silderbar.css">
    
    <style>
        .content-card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 24px;
            overflow: hidden;
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
            color: #1f2937;
            display: flex; align-items: center; gap: 10px;
        }
        
        .btn-add {
            background-color: #10b981; color: white;
            padding: 10px 20px; border-radius: 8px;
            font-weight: 600; font-size: 0.9rem;
            border: none; cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-add:hover { background-color: #059669; }

        /* TABLE STYLE */
        .table-container { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }

        /* Header Bảng: Giữ màu xanh như ý bạn */
        thead tr { background-color: #3b82f6; color: white; text-align: left; }
        th { padding: 16px; font-weight: 600; white-space: nowrap; }
        td { padding: 16px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }

        /* Căn giữa các cột ID và Hành động */
        th:first-child, td:first-child,
        th:last-child, td:last-child,
        .text-center { text-align: center; }

        tbody tr:nth-child(even) { background-color: #f9fafb; }
        tbody tr:hover { background-color: #f0f9ff; }

        /* STYLES RIÊNG CỦA BẠN */
        .tour-name { font-weight: 600; color: #3b82f6; }
        .hdv-name { font-weight: 500; }
        .su-co-text { color: #ef4444; font-size: 0.85rem; font-weight: 600; margin-top: 4px; display: block; }
        
        .img-thumb {
            width: 40px; height: 40px; object-fit: cover;
            border-radius: 6px; border: 1px solid #e5e7eb;
        }

        .action-btn {
            display: inline-flex; justify-content: center; align-items: center;
            width: 32px; height: 32px; border-radius: 6px; color: white;
            font-size: 0.85rem; margin: 0 3px; transition: opacity 0.2s;
        }
        .action-btn:hover { opacity: 0.8; }
        .btn-edit { background-color: #3b82f6; }
        .btn-delete { background-color: #ef4444; }
    </style>
</head>

<body>

    <?php require_once './views/hdv/silderbar.php'; ?>

    <div class="main-content">
        
        <div class="content-card">
            
            <div class="page-header">
                <h2 class="page-title">
                    <i class="fas fa-book" style="color: #3b82f6;"></i>
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

                                <td><?= !empty($row['Ngay']) ? date('d/m/Y', strtotime($row['Ngay'])) : '---' ?></td>

                                <td>
                                    <div style="font-weight: 500;"><?= htmlspecialchars($row['SuKien']) ?></div>
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