<?php
require_once 'silderbar.php';
?>
<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Danh Sách Danh Mục Tour</title>
            <link rel="stylesheet" href="./views/css/danhMucTour.css">

        </head>

        <style>
            .box-container { margin-bottom: 30px; padding: 15px; border-radius: 5px; }
            .box-confirmed { background-color: #fff; border: 1px solid #ddd; } /* Bảng chính */
            .box-pending { background-color: #fff3cd; border: 1px solid #ffeeba; } /* Màu vàng nhạt */
            .box-cancelled { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; } /* Màu hồng đỏ */
        
            .btn-action { padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 12px; margin-right: 5px; color: white;}
            .btn-confirm { background-color: green; }
            .btn-cancel { background-color: red; }
            .btn-wait { background-color: orange; }
        </style>

        <body>
        <h1>Quản Lý Booking</h1>
<a href="?mode=admin&act=create_booking" class="add-button">Thêm Booking Mới</a>

<div class="box-container box-confirmed">
    <h3>Danh Sách Booking Đã Xác Nhận</h3>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Mã</th><th>Khách Hàng</th><th>SĐT</th><th>Số Lượng</th><th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookingDaXacNhan as $v): ?>
            <tr>
                <td><?= $v['MaDatTour'] ?></td>
                <td><?= $v['TenKhachHang'] ?></td>
                <td><?= $v['SDT'] ?></td>
                <td><?= $v['SoLuongKhach'] ?></td>
                <td><span style="color:green; font-weight:bold"><?= $v['TrangThai'] ?></span></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="box-container box-pending">
    <h3>Booking Chờ Xác Nhận / Chờ Thanh Toán</h3>
    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="background: white;">
        <thead>
            <tr>
                <th>Mã</th><th>Khách Hàng</th><th>Số Lượng</th><th>Trạng Thái</th><th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookingCho as $v): ?>
            <tr>
                <td><?= $v['MaDatTour'] ?></td>
                <td><?= $v['TenKhachHang'] ?></td>
                <td><?= $v['SoLuongKhach'] ?></td>
                <td>
                    <?= $v['TrangThai'] ?>
                </td>
                <td>
                    <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=đã xác nhận" 
                       class="btn-action btn-confirm" onclick="return confirm('Xác nhận booking và thêm khách vào danh sách?')">
                       Xác nhận
                    </a>

                    <?php if($v['TrangThai'] != 'chờ thanh toán'): ?>
                    <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=chờ thanh toán" 
                       class="btn-action btn-wait">Chờ TT</a>
                    <?php endif; ?>

                    <a href="?mode=admin&act=change_status&id=<?= $v['MaDatTour'] ?>&status=đã hủy" 
                       class="btn-action btn-cancel" onclick="return confirm('Bạn có chắc muốn hủy?')">
                       Hủy
                    </a>
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
                <th>Mã</th><th>Khách Hàng</th><th>Ngày Tạo</th><th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bookingDaHuy as $v): ?>
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