<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/hdv/silderbar.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>

        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i>Lịch làm việc</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh Sách Khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
    </div>
<div class="main-content">
    <div class="header">
        <div class="content-box">
            <h2 style="font-size:1.8rem;">
                <i class="fas fa-users" style="color:#3b82f6;"></i> Danh Sách Khách Tham Gia Tour
            </h2>
            <br><hr><br>
            <table class="table-fullscreen">
                <thead>
                    <tr>
                        <th>Mã Khách</th>
                        <th>Tên Tour</th>
                        <th>Họ Tên</th>
                        <th>SĐT</th>
                        <th>Yêu cầu đặc biệt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dskhach as $value) { ?>
                    <tr>
                        <td><?= $value['MaKhach'] ?></td>
                        <td><?= $value['TenTour'] ?? 'Không xác định' ?></td>
                        <td><?= $value['HoTen'] ?></td>
                        <td><?= $value['sdt'] ?></td>
                        <td><?= $value['YeuCauDacBiet'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
</script>


<style>

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
    text-align: center;
    font-size: 1.1rem;
}

.table-fullscreen tbody td {
    text-align: center;
    padding: 14px 12px;
}

.table-fullscreen tbody tr:hover {
    background-color: #f1f5f9;
    transition: 0.3s;
}

.xem-btn {
    background-color: #3b82f6;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
}
.xem-btn:hover {
    background-color: #2563eb;
}
</style>


</body>
</html>
