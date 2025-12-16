<?php require_once 'silderbar.php'; ?>

<style>
    .tour-section { margin-bottom: 40px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .modern-table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
    .modern-table th { background-color: #f8f9fa; color: #444; font-weight: 600; padding: 12px 15px; text-align: left; border-bottom: 2px solid #e9ecef; }
    .modern-table td { padding: 12px 15px; border-bottom: 1px solid #eee; vertical-align: middle; color: #555; }
    .modern-table tr:hover { background-color: #fcfcfc; }
    .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: capitalize; }
    .status-sap-khoi-hanh { background-color: #e3f2fd; color: #1976d2; }
    .status-dang-dien-ra { background-color: #e8f5e9; color: #2e7d32; }
    .status-hoan-thanh { background-color: #eceff1; color: #546e7a; }
    .action-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; display: inline-block; margin-right: 5px; transition: all 0.2s; border: none; cursor: pointer; }
    .btn-detail { background: #17a2b8; color: white; }
    .btn-edit { background: #ffc107; color: #333; }
    .btn-delete { background: #dc3545; color: white; }
    .add-tour-btn { background-color: #28a745; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; float: right; margin-bottom: 20px; }
    .cate-badge { font-size: 0.85rem; padding: 4px 10px; border-radius: 4px; background-color: #f0f0f0; color: #333; border: 1px solid #ddd; }
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

    <div class="tour-section">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên Tour</th>
                    <th>Danh Mục</th>
                    <th>Thời Gian</th>
                    <th>Giá</th>
                    <th>Chi Phí</th> <th>Trạng Thái</th>
                    <th>Khách</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td>#<?= $row['MaQuanLy'] ?></td>
                            <td><strong><?= htmlspecialchars($row['TenTour']) ?></strong></td>
                            
                            <td>
                                <span class="cate-badge">
                                    <?= htmlspecialchars($row['TenDanhMuc'] ?? 'Chưa phân loại') ?>
                                </span>
                            </td>

                            <td>
                                <?= date('d/m/Y', strtotime($row['NgayBatDau'])) ?> <br>
                                <small>đến <?= date('d/m/Y', strtotime($row['NgayKetThuc'])) ?></small>
                            </td>
                            <td><?= number_format($row['Gia'], 0, '.', ',') ?> đ</td>
                            
                            <td style="color: #dc3545; font-weight: 500;">
                                <?= number_format($row['ChiPhi'] ?? 0, 0, '.', ',') ?> đ
                            </td>

                            <td>
                                <span class="status-badge status-<?= str_replace(' ', '-', $row['TrangThai']) ?>">
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
                    <tr><td colspan="9" style="text-align: center; font-style: italic;">Không có tour nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>