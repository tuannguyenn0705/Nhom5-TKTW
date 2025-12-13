<?php
require_once 'silderbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục Tour</title>
</head>

<style>

    .box-container { margin-bottom: 30px; padding: 15px; border-radius: 5px; }
    .box-confirmed { background-color: #fff; border: 1px solid #ddd; }
    .box-pending { background-color: #fff3cd; border: 1px solid #ffeeba; }
    .box-cancelled { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    
    .btn-action { padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 12px; margin-right: 5px; color: white; }
    .btn-confirm { background-color: green; }
    .btn-cancel { background-color: red; }
    .btn-wait { background-color: orange; }

    .expanded-row {
        background-color: #f8fafc !important;
        border-top: 2px solid #e2e8f0;
        box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.1);
    }
    .guest-details-wrapper { padding: 20px 40px; }
    
    .guest-details-title {
        font-size: 14px; font-weight: 700; color: #3b82f6;
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-bottom: 15px; display: flex; align-items: center; gap: 8px;
        border-bottom: 1px dashed #cbd5e1; padding-bottom: 10px;
    }

    .guest-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
    }

    .guest-card-mini {
        background: #ffffff; border: 1px solid #e2e8f0;
        border-radius: 8px; padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.2s ease; position: relative; overflow: hidden;
    }
    .guest-card-mini:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: #bfdbfe;
    }
    .guest-card-mini::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0;
        width: 4px; background-color: #3b82f6;
    }

    .guest-mini-name { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 8px; display: block; }
    .guest-mini-info { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b; margin-bottom: 4px; }
    .guest-mini-info svg { width: 14px; height: 14px; color: #94a3b8; flex-shrink: 0; }
    
    .guest-mini-note {
        margin-top: 10px; background-color: #fff7ed;
        border: 1px dashed #fdba74; color: #c2410c;
        font-size: 12px; padding: 6px 10px; border-radius: 6px;
        display: inline-flex; align-items: start; gap: 5px; width: 100%; box-sizing: border-box;
    }

    .btn-toggle-guest {
        background-color: #eff6ff; color: #2563eb;
        border: 1px solid #dbeafe; padding: 4px 10px;
        border-radius: 20px; font-size: 11px; font-weight: 600;
        cursor: pointer; margin-top: 5px; transition: all 0.2s;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .btn-toggle-guest:hover {
        background-color: #2563eb; color: white; border-color: #2563eb;
    }
</style>

<body>
    <h1>Quản Lý Booking</h1>
    <a href="?mode=admin&act=create_booking" class="add-button">Thêm Booking Mới</a>

    <div class="box-container box-confirmed">
        <h3>Danh Sách Booking Đã Xác Nhận</h3>
        <table width="100%" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Khách Hàng</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Số Lượng</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookingDaXacNhan as $v): ?>
                    <?php
                    $guests = json_decode($v['DanhSachKhachDoan'] ?? '[]', true);
                    $hasGroup = !empty($guests) && count($guests) > 0;
                    $rowId = 'detail-' . $v['MaDatTour'];
                    ?>
                    <tr>
                        <td><?= $v['MaDatTour'] ?></td>
                        <td>
                            <?= $v['TenKhachHang'] ?>
                            <?php if ($hasGroup): ?>
                                <br>
                                <button type="button" class="btn-toggle-guest" onclick="toggleDetail('<?= $rowId ?>')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                                    Xem <?= count($guests) ?> khách đi cùng
                                </button>
                            <?php endif; ?>
                        </td>
                        <td><?= $v['SDT'] ?></td>
                        <td><?= $v['Email'] ?></td>
                        <td><?= $v['SoLuongKhach'] ?></td>
                        <td><span style="color:green; font-weight:bold"><?= $v['TrangThai'] ?></span></td>
                    </tr>

                    <?php if ($hasGroup): ?>
                        <tr id="<?= $rowId ?>" style="display:none;" class="expanded-row">
                            <td colspan="6" style="padding: 0;"> 
                                <div class="guest-details-wrapper">
                                    <div class="guest-details-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        Danh sách thành viên đoàn
                                    </div>

                                    <div class="guest-list-grid">
                                        <?php foreach ($guests as $g): ?>
                                            <div class="guest-card-mini">
                                                <?php if (is_array($g)): ?>
                                                    <span class="guest-mini-name"><?= htmlspecialchars($g['HoTen'] ?? 'Chưa nhập tên') ?></span>
                                                    
                                                    <?php if(!empty($g['SDT'])): ?>
                                                    <div class="guest-mini-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                                        <?= htmlspecialchars($g['SDT']) ?>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if(!empty($g['Email'])): ?>
                                                    <div class="guest-mini-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                                        <?= htmlspecialchars($g['Email']) ?>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if(!empty($g['YeuCau'])): ?>
                                                    <div class="guest-mini-note">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                        <span><?= htmlspecialchars($g['YeuCau']) ?></span>
                                                    </div>
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                    <span class="guest-mini-name"><?= htmlspecialchars($g) ?></span>
                                                    <div class="guest-mini-note">Dữ liệu cũ</div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="box-container box-pending">
        <h3>Booking Chờ Xác Nhận / Chờ Thanh Toán</h3>
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="background: white;">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Khách Hàng</th>
                    <th>Số Lượng</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookingCho as $v): ?>
                    <tr>
                        <td><?= $v['MaDatTour'] ?></td>
                        <td><?= $v['TenKhachHang'] ?></td>
                        <td><?= $v['SoLuongKhach'] ?></td>
                        <td><?= $v['TrangThai'] ?></td>
                        <td>
                            <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=đã xác nhận" class="btn-action btn-confirm" onclick="return confirm('Xác nhận booking và thêm khách vào danh sách?')">Xác nhận</a>
                            <?php if ($v['TrangThai'] != 'chờ thanh toán'): ?>
                                <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=chờ thanh toán" class="btn-action btn-wait">Chờ TT</a>
                            <?php endif; ?>
                            <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=đã hủy" class="btn-action btn-cancel" onclick="return confirm('Bạn có chắc muốn hủy?')">Hủy</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="box-container box-cancelled">
        <h3>Lịch Sử Booking Đã Hủy</h3>
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="background: white;">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Khách Hàng</th>
                    <th>Ngày Tạo</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookingDaHuy as $v): ?>
                    <tr>
                        <td><?= $v['MaDatTour'] ?></td>
                        <td><?= $v['TenKhachHang'] ?></td>
                        <td><?= $v['NgayTao'] ?></td>
                        <td><?= $v['TrangThai'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleDetail(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "table-row";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>
</html>