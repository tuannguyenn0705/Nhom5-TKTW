<?php $MaQuanLy = $_GET['MaQuanLy'] ?? ''; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Trình Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/hdv/silderbar.css">
</head>
<body>
    <?php require_once './views/hdv/silderbar.php'; ?> 

    <div class="main-content">
        <div class="content-box">
            <h2><i class="fas fa-map-marked-alt"></i> Chi Tiết Tour</h2>
            
            <div class="nav-tabs">
                <a href="#" class="active">Lịch trình</a>
                <a href="?mode=hdv&act=DSachKhachHDVByTour&MaQuanLy=<?= $MaQuanLy ?>">Danh sách khách</a>
                <a href="?mode=hdv&act=checkin_form&MaQuanLy=<?= $MaQuanLy ?>">Check-in</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 15%; text-align: center;">Thời gian</th>
                        <th style="width: 15%; text-align: center;">Giờ</th>
                        <th style="width: 70%;">Nội dung hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($lichtrinh)): ?>
                        <?php foreach ($lichtrinh as $lt): ?>
                        <tr>
                            <td style="text-align: center;"><span class="day-badge">Ngày <?= $lt['NgaySo'] ?></span></td>
                            <td style="text-align: center;"><span class="time-text"><?= substr($lt['Gio'],0,5) ?></span></td>
                            <td style="line-height: 1.6;"><?= nl2br($lt['MoTaSuKien']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" style="text-align:center; padding: 40px; color:#94a3b8; font-style: italic;">Chưa có lịch trình chi tiết.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>