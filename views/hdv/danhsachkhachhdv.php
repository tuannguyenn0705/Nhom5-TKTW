<?php $MaQuanLy = $_GET['MaQuanLy'] ?? ''; ?>
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
    <?php require_once './views/hdv/silderbar.php'; ?>

    <div class="main-content">
        <div class="content-box">
            <h2><i class="fas fa-users"></i> <?= !empty($MaQuanLy) ? 'Chi Tiết Tour' : 'Danh Sách Tất Cả Khách Hàng' ?></h2>
            
            <?php if(!empty($MaQuanLy)): ?>
            <div class="nav-tabs">
                <a href="?mode=hdv&act=lichtrinhtour&MaQuanLy=<?= $MaQuanLy ?>">Lịch trình</a>
                <a href="#" class="active">Danh sách khách</a>
                <a href="?mode=hdv&act=checkin_form&MaQuanLy=<?= $MaQuanLy ?>">Check-in</a>
            </div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">STT</th>
                        <th style="width: 25%;">Tên khách</th>
                        <th style="width: 25%;">Tên Tour</th>
                        <th style="width: 15%;">SĐT</th>
                        <th style="width: 15%; text-align: center;">Trạng thái</th>
                        <th style="width: 15%;">Yêu cầu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($dskhach)): $stt=1; foreach($dskhach as $k): ?>
                    <tr>
                        <td style="text-align: center;"><?= $stt++ ?></td>
                        <td style="font-weight: 600; color: #1e293b;"><?= htmlspecialchars($k['HoTen']) ?></td>
                        <td><?= htmlspecialchars($k['TenTour'] ?? '') ?></td>
                        <td><?= htmlspecialchars($k['SDT'] ?? '') ?></td>
                        <td style="text-align: center;">
                            <?php 
                                $tt = $k['TrangThai'] ?? '';
                                if($tt == 'Có mặt') echo '<span class="status-badge bg-green">Có mặt</span>';
                                elseif($tt == 'Vắng') echo '<span class="status-badge bg-gray">Vắng</span>';
                                else echo '<span class="status-badge bg-red">Chưa điểm danh</span>';
                            ?>
                        </td>
                        <td>
                            <span style="font-style: italic; font-size: 0.9rem; color: #64748b;"><?= htmlspecialchars($k['YeuCauDacBiet'] ?? '') ?></span>
                            <a href="javascript:void(0)" onclick="updateSpecialRequest(<?= $k['MaKhach'] ?>, '<?= htmlspecialchars($k['YeuCauDacBiet'] ?? '') ?>')">
                                <i class="fas fa-edit edit-icon"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8; font-style: italic;">Không tìm thấy dữ liệu.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateSpecialRequest(id, oldContent) {
            let newContent = prompt("Nhập yêu cầu đặc biệt mới:", oldContent);
            if (newContent !== null) {
                window.location.href = `?mode=hdv&act=update_request&id=${id}&content=${encodeURIComponent(newContent)}`;
            }
        }
    </script>
</body>
</html>