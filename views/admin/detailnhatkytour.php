 <?php
        require_once 'silderbar.php';
        ?>
<h2>Chi tiết Nhật ký Tour</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Mã Nhật Ký</th>
        <td><?= $nhatkytour['MaNhatKy'] ?></td>
    </tr>
    <tr>
        <th>Mã Quản Lý</th>
        <td><?= $nhatkytour['MaQuanLy'] ?></td>
    </tr>
    <tr>
        <th>Mã Nhân Sự</th>
        <td><?= $nhatkytour['MaNhanSu'] ?></td>
    </tr>
    <tr>
        <th>Ngày</th>
        <td><?= $nhatkytour['Ngay'] ?></td>
    </tr>
    <tr>
        <th>Sự Kiện</th>
        <td><?= $nhatkytour['SuKien'] ?></td>
    </tr>
    <tr>
        <th>Sự Cố</th>
        <td><?= $nhatkytour['SuCo'] ?></td>
    </tr>
    <tr>
        <th>Phản Hồi Khách</th>
        <td><?= $nhatkytour['PhanHoiKhach'] ?></td>
    </tr>
</table>
<h1></h1>
<a href="<?= BASE_URL ?>?mode=admin&act=nhatkytour">Quay lại danh sách</a>