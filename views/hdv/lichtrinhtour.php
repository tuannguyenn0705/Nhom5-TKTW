<?php
$MaQuanLy = $_GET['MaQuanLy'] ?? '';
$currentAct = $_GET['act'] ?? '';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch trình tour</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/hdv/silderbar.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
        }

        .content-box {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* ===== NAV TABS (KHÔNG NHẢY) ===== */
        .nav-tabs {
            display: flex;
            gap: 30px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 1.1rem;
            margin-top: 15px;
        }

        .nav-tabs a {
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            padding-bottom: 8px;
            border-bottom: 3px solid transparent;
            transition: color .2s ease, border-color .2s ease;
        }

        .nav-tabs a:hover {
            color: #2563eb;
        }

        .nav-tabs a.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
        }

        /* ===== TABLE ===== */
        .schedule-table {
            width: 1100px;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 1.05rem;
        }

        .schedule-table th {
            background: #3b82f6;
            color: #fff;
            padding: 14px;
            text-align: center;
        }

        .schedule-table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .schedule-table tr:hover {
            background: #f9fafb;
        }

        .day-badge {
            background: #2563eb;
            color: #fff;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        .time {
            color: #2563eb;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>

    <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item">
        <i class="fas fa-briefcase"></i> Lịch làm việc
    </a>

    <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item">
        <i class="fas fa-user-tie"></i> Danh sách khách
    </a>

    <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item">
        <i class="fas fa-book"></i> Nhật ký tour
    </a>

    <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item">
        <i class="fas fa-check-double"></i> Check-in
    </a>

    <hr>

    <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color:#ef4444;">
        <i class="fas fa-sign-out-alt"></i> Đăng xuất
    </a>
</div>

<div class="main-content">
    <div class="content-box">

        <h2><i class="fas fa-calendar-alt" style="color:#3b82f6;"></i> Lịch trình tour</h2>

        <!-- TAB -->
        <div class="nav-tabs">
            <a href="?mode=hdv&act=lichtrinhtour&MaQuanLy=<?= $MaQuanLy ?>"
               class="<?= $currentAct == 'lichtrinhtour' ? 'active' : '' ?>">
                Lịch trình
            </a>

            <a href="?mode=hdv&act=DSachKhachHDVByTour&MaQuanLy=<?= $MaQuanLy ?>"
               class="<?= $currentAct == 'DSachKhachHDVByTour' ? 'active' : '' ?>">
                Danh sách khách
            </a>

            <a href="?mode=hdv&act=checkin_form&MaQuanLy=<?= $MaQuanLy ?>"
               class="<?= $currentAct == 'checkin_form' ? 'active' : '' ?>">
                Check-in
            </a>
        </div>

        <!-- TABLE LỊCH TRÌNH -->
        <table class="schedule-table">
            <thead>
            <tr>
                <th style="width:120px">Ngày</th>
                <th style="width:120px">Giờ</th>
                <th>Nội dung</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lichtrinh as $lt): ?>
                <tr>
                    <td align="center">
                        <span class="day-badge">Ngày <?= $lt['NgaySo'] ?></span>
                    </td>
                    <td align="center">
                        <span class="time"><?= substr($lt['Gio'],0,5) ?></span>
                    </td>
                    <td><?= nl2br($lt['MoTaSuKien']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
