<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/hdv/silderbar.css">

    <style>
        /* --- CẤU TRÚC KHUNG CHÍNH --- */
        .main-content {
            /* Đảm bảo nội dung chính giãn hết cỡ */
            width: calc(100% - 250px); /* Trừ đi sidebar nếu cần, hoặc để flex tự lo */
            float: right;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            width: 100%;
        }

        .content-box {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: 100%; /* QUAN TRỌNG: Chiếm 100% chiều rộng khung chứa */
            box-sizing: border-box; /* Để padding không làm vỡ khung */
        }

        h2 { font-weight: 700; margin-bottom: 20px; font-size: 1.8rem; }

        /* --- TABS --- */
        .nav-tabs {
            display: flex;
            gap: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 1.1rem;
            margin-bottom: 30px;
            width: 100%;
        }

        .nav-tabs a { text-decoration: none; color: #374151; font-weight: 600; }

        .nav-tabs a.active {
            color: #2563eb;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 6px;
        }

        /* --- BẢNG CHECK-IN (FULL WIDTH) --- */
        .checkin-table {
            width: 100%; /* QUAN TRỌNG: Bảng giãn full màn hình */
            border-collapse: separate; 
            border-spacing: 0 15px; 
            margin-top: -10px;
        }

        .checkin-table th {
            text-align: left;
            color: #6b7280;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 20px;
        }

        /* Row style - Card-like */
        .checkin-row {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #f3f4f6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .checkin-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            border-color: #3b82f6;
        }

        .checkin-table td {
            padding: 20px;
            vertical-align: middle;
            background: #fff; /* Đảm bảo nền trắng */
        }

        /* Bo góc cho hàng */
        .checkin-row td:first-child { border-radius: 8px 0 0 8px; border-left: 1px solid #f3f4f6;}
        .checkin-row td:last-child { border-radius: 0 8px 8px 0; border-right: 1px solid #f3f4f6;}

        /* --- NỘI DUNG TRONG BẢNG --- */
        .customer-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .customer-note {
            font-size: 0.95rem;
            color: #ef4444; 
            font-weight: 500;
            display: inline-block;
            background: #fef2f2;
            padding: 2px 8px;
            border-radius: 4px;
        }

        /* --- SWITCH BUTTONS (Căn sang phải) --- */
        .status-cell {
            text-align: right; /* Đẩy nút sang phải để tận dụng khoảng trống */
            padding-right: 30px !important;
        }

        .status-switch {
            display: inline-flex;
            background: #f3f4f6;
            border-radius: 30px;
            padding: 4px;
        }

        .status-option input { display: none; }

        .status-option label {
            display: flex;
            align-items: center;
            padding: 10px 25px; /* Nút to hơn chút */
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .status-option label i { margin-right: 8px; }

        /* Active States */
        .status-option input[value="Có mặt"]:checked + label {
            background: #10b981; color: white; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4);
        }
        .status-option input[value="Vắng"]:checked + label {
            background: #ef4444; color: white; box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
        }

        /* --- FLOATING BUTTON --- */
        .btn-update-float {
            position: fixed;
            bottom: 30px;
            right: 40px;
            background: #2563eb;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            font-size: 1.1rem;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 1000;
        }
        .btn-update-float:hover { background: #1d4ed8; transform: scale(1.05); }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>
        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i> Lịch làm việc</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item active"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="content-box">
                
                <h2><i class="fas fa-clipboard-check" style="color:#3b82f6;"></i> Điểm Danh Tour</h2>
                
                <?php $MaQuanLy = $_GET['MaQuanLy'] ?? ''; ?>
                
                <div class="nav-tabs">
                    <a href="?mode=hdv&act=lichtrinhtour&MaQuanLy=<?= $MaQuanLy ?>">Lịch trình</a>
                    <a href="?mode=hdv&act=DSachKhachHDVByTour&MaQuanLy=<?= $MaQuanLy ?>">Danh sách khách</a>
                    <a href="#" class="active">Check-in (Điểm danh)</a>
                </div>

                <form action="?mode=hdv&act=checkin_store" method="POST">
                    <input type="hidden" name="MaQuanLy" value="<?= $MaQuanLy ?>">

                    <table class="checkin-table">
                        <thead>
                            <tr>
                                <th style="width: 60px; text-align: center;">STT</th>
                                <th>Thông tin khách hàng</th>
                                <th style="text-align: right; padding-right: 50px;">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $stt = 1;
                            foreach($dskhach as $khach): 
                                $status = $khach['TrangThai'] ?? 'Chưa điểm danh'; 
                            ?>
                            <tr class="checkin-row">
                                <td style="text-align: center; font-weight: bold; color: #9ca3af;"><?= $stt++ ?></td>
                                
                                <td>
                                    <div class="customer-name"><?= $khach['HoTen'] ?></div>
                                    <?php if($khach['YeuCauDacBiet']): ?>
                                        <span class="customer-note">
                                            <i class="fas fa-exclamation-circle"></i> <?= $khach['YeuCauDacBiet'] ?>
                                        </span>
                                    <?php else: ?>
                                        <span style="color: #9ca3af; font-size: 0.9rem;">Không có yêu cầu</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="status-cell">
                                    <div class="status-switch">
                                        <div class="status-option">
                                            <input type="radio" id="present_<?= $khach['MaKhach'] ?>" name="status[<?= $khach['MaKhach'] ?>]" value="Có mặt" <?= ($status == 'Có mặt') ? 'checked' : '' ?>>
                                            <label for="present_<?= $khach['MaKhach'] ?>">
                                                <i class="fas fa-check"></i> Có mặt
                                            </label>
                                        </div>
                                        <div class="status-option">
                                            <input type="radio" id="absent_<?= $khach['MaKhach'] ?>" name="status[<?= $khach['MaKhach'] ?>]" value="Vắng" <?= ($status == 'Vắng') ? 'checked' : '' ?>>
                                            <label for="absent_<?= $khach['MaKhach'] ?>">
                                                <i class="fas fa-times"></i> Vắng
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn-update-float">
                        <i class="fas fa-save"></i> LƯU ĐIỂM DANH
                    </button>
                    
                    <div style="height: 100px;"></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>