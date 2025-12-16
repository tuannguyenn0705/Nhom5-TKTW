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
        <div class="content-box">
            <h2 style="font-size:1.8rem;"><i class="fas fa-calendar-days" style="color:#3b82f6;"></i> Lịch làm việc</h2>
            <br>
            <hr>
            <br>
            <div class="table-responsive">
                <table class="table table-fullscreen align-middle">
                    <thead>
                        
                        <tr>
                            <td>Mã Lịch HDV</td>
                            <!-- <th>Mã Quản Lý</th> -->
                            <th>Mã nhân sự</th>
                            <th>Tour</th>
                            <th>Ngày khởi hành</th>
                            <th>Ngày kết thúc</th>
                            <th>Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php foreach($data as $value): ?>
                        <tr>
                            <td><?= $value['MaLichHDV'] ?></td>
                            <!-- <td><?= $value['TenTour'] ?></td> -->
                            <td><?=  $value['HoTen'] ?></td>
                            <td><?= $value['TenTour']  ?></td>
                            <td><?= $value['NgayBatDau'] ?></td>
                            <td><?= $value['NgayKetThuc'] ?></td>
                            <td><button class="btn xem-btn"><i class="fas fa-eye"></i><a href="<?= BASE_URL ?>?mode=hdv&act=DSachKhachHDVByTour&MaQuanLy=<?= $value['MaQuanLy'] ?>">Xem</a></button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
