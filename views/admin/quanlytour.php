<?php require_once 'silderbar.php'; ?>

<style>
    .tour-section {
        margin-bottom: 40px;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .active-theme .section-title { color: #2ecc71; }
    .completed-theme .section-title { color: #7f8c8d; }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .modern-table th {
        background-color: #f8f9fa;
        color: #444;
        font-weight: 600;
        padding: 12px 15px;
        text-align: left;
        border-bottom: 2px solid #e9ecef;
    }

    .modern-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
        color: #555;
    }

    .modern-table tr:hover {
        background-color: #fcfcfc;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-sap-khoi-hanh { background-color: #e3f2fd; color: #1976d2; }
    .status-dang-dien-ra { background-color: #e8f5e9; color: #2e7d32; }
    .status-hoan-thanh { background-color: #eceff1; color: #546e7a; }

    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        display: inline-block;
        margin-right: 5px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-detail { background: #17a2b8; color: white; }
    .btn-edit { background: #ffc107; color: #333; }
    .btn-delete { background: #dc3545; color: white; }
    
    .btn-add-diary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        border-radius: 20px;
    }
    .btn-add-diary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0,0,0,0.15);
        color: white;
    }

    .btn-diary-done {
        background-color: #28a745;
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        border-radius: 20px;
        cursor: default;
        opacity: 0.8;
    }

    .add-tour-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        float: right;
        margin-bottom: 20px;
    }
</style>

<div class="main-container" style="padding: 20px;">
    <h1>Quản Lý Tour</h1>
    
    <div style="overflow: hidden; margin-bottom: 20px;">
        <form action="" method="get" class="search-form" style="float: left;">
            <input type="hidden" name="mode" value="admin">
            <input type="hidden" name="act" value="quanlytour">
            <input type="text" name="keyword" placeholder="Nhập tên tour..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px;">Tìm kiếm</button>
        </form>

        <a href="<?= BASE_URL . '?mode=admin&act=formquanlytour' ?>" class="add-tour-btn">+ Thêm Tour Mới</a>
    </div>

    <div class="tour-section active-theme">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-airplane-engines"></i> Tour Đang Hoạt Động (Sắp & Đang diễn ra)
            </h2>
        </div>
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên Tour</th>
                    <th>Thời Gian</th>
                    <th>Giá</th>
                    <th>Trạng Thái</th>
                    <th>Khách</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($activeTours)): ?>
                    <?php foreach ($activeTours as $row): ?>
                        <tr>
                            <td>#<?= $row['MaQuanLy'] ?></td>
                            <td><strong><?= htmlspecialchars($row['TenTour']) ?></strong></td>
                            <td>
                                <?= date('d/m/Y', strtotime($row['NgayBatDau'])) ?> <br>
                                <small>đến <?= date('d/m/Y', strtotime($row['NgayKetThuc'])) ?></small>
                            </td>
                            <td><?= number_format($row['Gia'], 0, '.', ',') ?> đ</td>
                            <td>
                                <span class="status-badge status-<?= $row['TrangThai'] == 'sắp khởi hành' ? 'sap-khoi-hanh' : 'dang-dien-ra' ?>">
                                    <?= ucfirst($row['TrangThai']) ?>
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: bold; color: <?= ($row['SoLuongDaDat'] >= $row['SoLuongToiDa']) ? 'red' : 'green' ?>">
                                    <?= $row['SoLuongDaDat'] ?> / <?= $row['SoLuongToiDa'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL . '?mode=admin&act=editquanlytour&id=' . $row['MaQuanLy'] ?>" class="action-btn btn-edit">Sửa</a>
                                <a href="<?= BASE_URL . '?mode=admin&act=xoaquanlytour&id=' . $row['MaQuanLy'] ?>" class="action-btn btn-delete" onclick="return confirm('Xóa tour này?')">Xóa</a>
                                <a href="<?= BASE_URL . '?mode=admin&act=detailquanlytour&id=' . $row['MaQuanLy'] ?>" class="action-btn btn-detail">Chi Tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align: center; font-style: italic;">Không có tour nào đang hoạt động.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="tour-section completed-theme">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-check-circle-fill"></i> Tour Đã Hoàn Thành
            </h2>
        </div>
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên Tour</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Trạng Thái</th>
                    <th>Thêm Nhật Ký</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($completedTours)): ?>
                    <?php foreach ($completedTours as $row): ?>
                        <tr>
                            <td>#<?= $row['MaQuanLy'] ?></td>
                            <td style="color: #666;"><?= htmlspecialchars($row['TenTour']) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['NgayKetThuc'])) ?></td>
                            <td><span class="status-badge status-hoan-thanh">Hoàn Thành</span></td>
                            <td>
                                <?php if ($row['DaCoNhatKy'] > 0): ?>
                                    <span class="btn-diary-done">
                                        <i class="bi bi-check-circle"></i> Đã Thêm
                                    </span>
                                <?php else: ?>
                                    <a href="<?= BASE_URL . '?mode=admin&act=formnhatkytour&id_tour=' . $row['MaQuanLy'] ?>" class="btn-add-diary">
                                        <i class="bi bi-journal-plus"></i> Viết Nhật Ký
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= BASE_URL . '?mode=admin&act=detailquanlytour&id=' . $row['MaQuanLy'] ?>" class="action-btn btn-detail">Xem</a>
                                <a href="<?= BASE_URL . '?mode=admin&act=xoaquanlytour&id=' . $row['MaQuanLy'] ?>" class="action-btn btn-delete" onclick="return confirm('Xóa tour này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center; font-style: italic;">Chưa có tour nào hoàn thành.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>