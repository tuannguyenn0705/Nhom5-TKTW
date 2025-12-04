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
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh Sach Khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkyTour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="#" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>
    <div class="main-content">
        <div class="header">
            <h2>Tổng quan hệ thống</h2>
            <div style="display: flex; gap: 12px; align-items: center;">

                <div style="text-align: right;">
                    <span style="font-weight: 600; font-size: 14px; color: #334155;">
                        <?php
                        if (isset($_SESSION['user'])) {
                            if (isset($_SESSION['user']['Role']) && $_SESSION['user']['Role'] == '1') {
                                echo "Xin chào, Admin";
                            } else {
                                echo "Xin chào, HDV";
                            }
                        }
                        ?>
                    </span>
                </div>

                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
