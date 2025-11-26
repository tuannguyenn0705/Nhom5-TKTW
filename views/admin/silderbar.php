<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Tour Du Lịch</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/css/danhMucTour.css">
</head>

<body>
    
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld </div>
        <a href="#" class="menu-item" onclick="switchTab('finance', this); return false;">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="<?= BASE_URL .'?mode=admin&act=danhmuctour' ?>" class="menu-item" onclick="switchTab('tours', this); return false;">
            <i class="fas fa-map-marked-alt"></i> Danh mục tour 
        </a>
        <a href="<?= BASE_URL .'?mode=admin&act=quanlytour' ?>" class="menu-item" onclick="switchTab('booking-status', this); return false;">
            <i class="fas fa-tasks"></i> Quản lý tour
        </a>
        <a href="#" class="menu-item" onclick="switchTab('new-booking', this); return false;">
            <i class="fas fa-plus-circle"></i> Tạo booking mới
        </a>
        <a href="#" class="menu-item" onclick="switchTab('staff', this); return false;">
            <i class="fas fa-user-tie"></i> Nhân sự & HDV
        </a>
        <a href="#" class="menu-item" onclick="switchTab('guest-list', this); return false;">
            <i class="fas fa-list-alt"></i> DS Khách
        </a>
        <a href="#" class="menu-item" onclick="switchTab('tour-log', this); return false;">
            <i class="fas fa-book"></i> Nhật ký tour
        </a>
        <a href="<?= BASE_URL .'?mode=admin&act=lichlamviechdv'?>" class="menu-item" onclick="switchTab('work-schedule', this); return false;">
            <i class="fas fa-briefcase"></i> Lịch làm việc
        </a>
        <!-- <a href="#" class="menu-item" onclick="switchTab('group-list', this); return false;">
            <i class="fas fa-users"></i> Khách đoàn
        </a> -->
        <!-- <a href="#" class="menu-item" onclick="switchTab('guide-log', this); return false;">
            <i class="fas fa-pen-nib"></i> Nhật ký HDV
        </a> -->
        <a href="#" class="menu-item" onclick="switchTab('checkin', this); return false;">
            <i class="fas fa-check-double"></i> Check-in
        </a>
        <!-- <a href="#" class="menu-item" onclick="switchTab('requests', this); return false;">
            <i class="fas fa-bell"></i> Yêu cầu đặc biệt
        </a> -->
        <hr>
        <a href="<?= BASE_URL ?>?mode=admin&act=logout" class="menu-item" style="color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Tổng quan hệ thống</h2>
            <div style="display: flex; gap: 12px; align-items: center;">
                
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>  
        </div>
</body>

</html>
