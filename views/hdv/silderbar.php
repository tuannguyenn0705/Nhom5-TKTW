<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang HDV</title>

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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #1e293b 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 35px;
            padding-left: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo i {
            color: var(--primary);
        }

        .menu-item {
            padding: 12px 16px;
            color: var(--text-light);
            display: flex;
            gap: 14px;
            align-items: center;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: var(--transition);
        }

        .menu-item:hover {
            background-color: rgba(255,255,255,0.05);
            color: var(--white);
            transform: translateX(4px);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 32px 40px;
            width: calc(100% - var(--sidebar-width));
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .header h2 {
            color: var(--text-main);
            font-size: 26px;
            font-weight: 600;
        }

        .content-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }

        .content-box h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .module-list li {
            margin-bottom: 12px;
            font-size: 15px;
            color: var(--text-main);
        }

        .module-list li i {
            color: var(--primary);
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelAdmin</div>

        <a href="#" class="menu-item"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="#" class="menu-item"><i class="fas fa-map-marked-alt"></i> Danh mục tour</a>
        <a href="#" class="menu-item"><i class="fas fa-user-tie"></i> Nhân sự & HDV</a>
        <a href="#" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="#" class="menu-item"><i class="fas fa-briefcase"></i> Lịch làm việc</a>
        <a href="#" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>

        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <!-- MAIN HDV PAGE -->
    <div class="main-content">
        <div class="header">
            <h2>Trang dành cho Hướng Dẫn Viên (HDV)</h2>
        </div>

        <div class="content-box">
            <h3>Chức năng của HDV</h3>

            <ul class="module-list">
                <li><i class="fas fa-calendar-check"></i> Xem lịch làm việc HDV (lịch tour của mình)</li>
                <li><i class="fas fa-users"></i> Quản lí danh sách khách theo tour + yêu cầu cá nhân</li>
                <li><i class="fas fa-book-open"></i> Ghi nhật ký tour, ghi nhận sự cố, phản hồi khách</li>
                <li><i class="fas fa-check"></i> Check-in khách theo tour, hiển thị chi tiết danh sách khách</li>
            </ul>
        </div>
    </div>

</body>
</html>
