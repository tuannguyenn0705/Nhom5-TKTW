<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Tour Du Lịch</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --bg-body: #f3f4f6;
            --sidebar-bg: #0f172a;
            --sidebar-width: 260px;
            --white: #ffffff;
            --text-main: #334155;
            --text-light: #94a3b8;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #1e293b 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 35px;
            padding-left: 10px;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }

        .logo i {
            color: var(--primary);
        }

        /* Cập nhật style cho thẻ A */
        a.menu-item {
            padding: 12px 16px;
            color: var(--text-light);
            text-decoration: none;
            /* Quan trọng: bỏ gạch chân của thẻ a */
            border-radius: 10px;
            margin-bottom: 4px;
            cursor: pointer;
            display: flex;
            /* Giữ bố cục flex */
            align-items: center;
            gap: 14px;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            width: 100%;
            /* Đảm bảo thẻ a chiếm hết chiều rộng */
        }

        a.menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--white);
            transform: translateX(4px);
        }

        a.menu-item.active {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 10px;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 32px 40px;
            width: calc(100% - var(--sidebar-width));
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-dark);
            color: white;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: #e2e8f0;
            color: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid white;
        }

        .section {
            display: none;
            animation: fadeIn 0.4s ease-out;
        }

        .section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Placeholder Box */
        .empty-state-box {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 12px;
            border: 2px dashed #cbd5e1;
            color: var(--secondary);
        }
        </style>
</head>

<body>
    
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelAdmin</div>
        <a href="#" class="menu-item" onclick="switchTab('finance', this); return false;">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="#" class="menu-item" onclick="switchTab('tours', this); return false;">
            <i class="fas fa-map-marked-alt"></i> Danh mục tour
        </a>
        <a href="#" class="menu-item" onclick="switchTab('booking-status', this); return false;">
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
        <a href="#" class="menu-item" onclick="switchTab('work-schedule', this); return false;">
            <i class="fas fa-briefcase"></i> Lịch làm việc
        </a>
        <a href="#" class="menu-item" onclick="switchTab('group-list', this); return false;">
            <i class="fas fa-users"></i> Khách đoàn
        </a>
        <a href="#" class="menu-item" onclick="switchTab('guide-log', this); return false;">
            <i class="fas fa-pen-nib"></i> Nhật ký HDV
        </a>
        <a href="#" class="menu-item" onclick="switchTab('checkin', this); return false;">
            <i class="fas fa-check-double"></i> Check-in
        </a>
        <a href="#" class="menu-item" onclick="switchTab('requests', this); return false;">
            <i class="fas fa-bell"></i> Yêu cầu đặc biệt
        </a>
        <hr>
        <a href="#" class="menu-item" style="color: #ef4444;">
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

    <div class="content-wrapper">
        <?php
        if (isset($view)) {
            require_once PATH_VIEW . $view . '.php';
        }
        ?>
    </div>
</body>

</html>