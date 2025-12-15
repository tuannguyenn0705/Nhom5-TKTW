<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Check-in HDV</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./views/hdv/silderbar.css"> 
    
    <style>
        :root {
            --primary: #3b82f6; 
            --white: #ffffff;
            --text-main: #1f2937;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }
  
        .check-in-wrapper {
            margin-top: -15px; 
            background-color: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            max-width: 3600px; /* Thu hẹp lại cho bố cục dễ nhìn hơn */
            margin: 0 auto;
        }
        .check-in-title {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        .check-in-hr {
            border: 0;
            border-top: 1px solid #e2e8f0;
            margin-bottom: 25px;
        }
        .tour-select-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .tour-select-box label {
            font-weight: 600;
            color: var(--text-main);
        }
        .tour-select-box select {
            width: 350px; /* Tăng chiều rộng select */
            padding: 12px;
            border: 1px solid #d1d5db; /* Viền nhẹ nhàng hơn */
            border-radius: 8px;
            font-size: 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            appearance: none; /* Ẩn mũi tên mặc định */
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath fill='%236b7280' d='M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z'/%3E%3C/svg%3E") no-repeat right 0.75rem center / 1.5rem 1.5rem;
            cursor: pointer;
        }
        
        /* Bố cục Bảng */
        .customer-list-box {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f9fafb; /* Nền bảng nhẹ */
        }
        .table-header, .table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 2fr;
            align-items: center;
            padding: 15px 20px;
            font-size: 0.95rem;
        }
        .table-header {
            background-color: var(--primary); /* Header màu chủ đạo */
            color: var(--white);
            font-weight: 600;
        }
        .table-row {
            border-top: 1px solid #e2e8f0;
            background-color: var(--white);
        }
        .table-row:nth-child(even) { /* Màu xen kẽ */
            background-color: #fefeff;
        }
        
        /* Cập nhật các nút hành động */
        .action-group {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: flex-end;
        }
        .action-group select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            min-width: 120px;
        }
        .btn-capnhat {
            background-color: #10b981; /* Màu Xanh lá cây nổi bật hơn */
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-capnhat:hover {
            background-color: #059669;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo"><i class="fas fa-plane-departure"></i> TravelWorld</div>
        <a href="<?= BASE_URL ?>?mode=hdv&act=lichlamviec" class="menu-item"><i class="fas fa-briefcase"></i>Lịch làm việc</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=danhsachkhach" class="menu-item"><i class="fas fa-user-tie"></i> Danh sách khách</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="menu-item"><i class="fas fa-book"></i> Nhật ký tour</a>
        <a href="<?= BASE_URL ?>?mode=hdv&act=checkin" class="menu-item active"><i class="fas fa-check-double"></i> Check-in</a>
        <hr>
        <a href="<?= BASE_URL ?>?mode=hdv&act=logout" class="menu-item" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
    </div>

    <div class="main-content">
        
        <div class="check-in-wrapper">
            <h2 class="check-in-title"><i class="fas fa-calendar-check" style="color: var(--primary);"></i>  Điểm Danh Tour</h2>
            <hr class="check-in-hr">

            <form id="tour_selection_form" method="GET" action="?mode=hdv&act=checkin">
                
                <div class="tour-select-box">
                    <input type="hidden" name="mode" value="hdv">
                    <input type="hidden" name="act" value="checkin">

                    <label for="MaQuanLy">Chọn Tour:</label>
                    <select id="MaQuanLy" name="MaQuanLy" required onchange="this.form.submit()">
                        <option value="">-- Chọn Tour --</option>
                        <?php 
                        if (!empty($listQuanLyTour) && is_array($listQuanLyTour)):
                            $selectedMaQuanLy = $_GET['MaQuanLy'] ?? null; 
                            foreach ($listQuanLyTour as $dm): 
                        ?>
                        <option value="<?= htmlspecialchars($dm['MaQuanLy']) ?>" 
                            <?= (isset($selectedMaQuanLy) && $dm['MaQuanLy'] == $selectedMaQuanLy) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dm['TenTour']) ?>
                        </option>
                        <?php 
                            endforeach; 
                        endif;
                        ?>
                    </select>
                </div>
                
            </form>
               
        </div>
        
        <div class="customer-list-box">
            <div class="table-header">
                <div>Tên Khách</div>
                <div style="text-align: center;">Trạng Thái</div>
                <div style="text-align: right;">Hành Động</div>
            </div>
            <?php if (!empty($dskhach) && is_array($dskhach)): ?>
                <?php foreach ($dskhach as $khach): ?>
                <div class="table-row">
                    <div><?= htmlspecialchars($khach['HoTen']) ?></div>
                    <div style="text-align: center;"><?= htmlspecialchars($khach['TrangThai'] ?? '') ?></div>
                    <div style="text-align: right;">
                        <form method="POST" action="?mode=hdv&act=updateCheckinStatus">
                            <input type="hidden" name="MaKhach" value="<?= htmlspecialchars($khach['MaKhach']) ?>">
                            <input type="hidden" name="MaQuanLy" value="<?= htmlspecialchars($_GET['MaQuanLy'] ?? '') ?>">
                            <div class="action-group">
                                <select name="TrangThai" required>
                                    <option value="">-- Chọn Tình Trạng --</option>
                                    <option value="Có mặt" <?= (isset($khach['TrangThai']) && $khach['TrangThai'] == 'Có mặt') ? 'selected' : '' ?>>Có mặt</option>
                                    <option value="Vắng" <?= (isset($khach['TrangThai']) && $khach['TrangThai'] == 'Vắng') ? 'selected' : '' ?>>Vắng</option>
                                </select>
                                <button type="submit" class="btn-capnhat">Cập Nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="table-row">
                    <div colspan="3" style="text-align: center;">Chưa có khách nào tham gia tour này.</div>
                </div>
            <?php endif; ?>
    </div> 

</body>
</html>
