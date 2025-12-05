<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./views/hdv/silderbar.css">

    <style>
        .content-box {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .nav-tabs {
            display: flex;
            gap: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 1.1rem;
        }

        .nav-tabs a {
            text-decoration: none;
            color: #374151;
            font-weight: 600;
        }

        .nav-tabs a.active {
            color: #2563eb;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 6px;
        }

        .guest-table {
            width: 1100px;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 1.05rem;
        }

        .guest-table th {
            background: #3b82f6;
            color: #fff;
            padding: 14px;
            text-align: center;
        }

        .guest-table td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .guest-table tr:hover {
            background-color: #f3f4f6;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            color: #fff;
            font-weight: 600;
        }

        .da-checkin {
            background: #16a34a;
        }

        .chua-den {
            background: #ef4444;
        }

        .btn-back {
            margin-top: 20px;
            padding: 8px 18px;
            border: none;
            border-radius: 8px;
            background: #6b7280;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-back:hover {
            background: #4b5563;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>

        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i>Lịch làm việc</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkyTour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="#" class="menu-item"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="content-box">
                <h2><i class="fas fa-users" style="color:#3b82f6;"></i> Danh sách khách</h2>
                <div class="nav-tabs">
                    <a href="#">Lịch trình</a>
                    <a href="#" class="active">Danh sách khách</a>
                    <a href="#">Check-in</a>
                </div>
                <table class="guest-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách</th>
                            <th>Tình trạng</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 1;
                        foreach($dskhach as $khach):
                      ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td><?= $khach['HoTen'] ?></td>

                            <td>
                              <?php if($khach['TrangThai']=='đã điểm danh'): ?>
                                <span class="badge da-checkin">Đã điểm danh</span>
                              <?php else: ?>
                                <span class="badge chua-den">Chưa điểm danh</span>
                              <?php endif; ?>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
