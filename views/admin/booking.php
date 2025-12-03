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

        <body>
            <h1>Quản Lý Booking</h1>
            <div class="action-container">
                <input type="text">
                <a href="<?= BASE_URL . '?mode=admin&act=' ?>" class="add-button">Thêm Booking</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Mã Đặt Tour</td>
                        <td>Mã chi tiết Tour</td>
                        <td>Tên Khách Hàng</td>
                        <td>SDT</td>
                        <td>Email</td>
                        <td>Số Lượng Khách</td>
                        <td>Trạng Thái</td>
                        <td>Ngày tạo</td>
                        <td>Hành Động</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($booking as $value){ ?>
                    <tr>
                        <td><?= $value['MaDatTour'] ?></td>
                        <td><?= $value['MaChiTietTour'] ?></td>
                        <td><?= $value['TenKhachHang'] ?></td>
                        <td><?= $value['SDT'] ?></td>
                        <td><?= $value['Email'] ?></td>
                        <td><?= $value['SoLuongKhach'] ?></td>
                        <td><?= $value['TrangThai'] ?></td>
                        <td><?= $value['NgayTao'] ?></td>
                        <td>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>