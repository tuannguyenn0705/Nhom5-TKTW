<?php
$dashboard = isset($dashboard) ? $dashboard : [];
$totalDoanhThu = isset($totalDoanhThu) ? $totalDoanhThu : 0;
$totalChiPhi = isset($totalChiPhi) ? $totalChiPhi : 0;
$totalLoiNhuan = isset($totalLoiNhuan) ? $totalLoiNhuan : 0;

require_once 'silderbar.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Doanh Thu - Lợi Nhuận Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-box { 
            border-radius: 12px; 
            border: none; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
            transition: transform 0.3s ease; 
            color: white;
            overflow: hidden;
            position: relative;
        }
        .card-box:hover { transform: translateY(-5px); }
        .card-box .icon-box { 
            font-size: 3rem; 
            opacity: 0.3; 
            position: absolute;
            right: 20px;
            bottom: 10px;
        }
        
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-gradient-warning { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); color: #0f5132 !important;} 
        
        .table-container { 
            background: white; 
            border-radius: 12px; 
            padding: 25px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        }
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom-width: 2px;
        }
        
        .fw-bold-money { font-weight: 700; font-family: 'Consolas', 'Monaco', monospace; letter-spacing: -0.5px; }
        .text-success-dark { color: #198754; } 
        .text-danger-dark { color: #dc3545; }
    </style>
</head>
<body>

<div class="container-fluid py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="fas fa-chart-pie me-2 text-primary"></i>Hiệu Quả Kinh Doanh</h3>
            <p class="text-muted mb-0">Thống kê doanh thu, chi phí và lợi nhuận theo từng Tour</p>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <div class="col-md-4">
            <div class="card card-box bg-gradient-primary p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-2">Tổng Doanh Thu</h6>
                        <h2 class="mb-0 fw-bold display-6"><?= number_format($totalDoanhThu,0,',','.') ?> ₫</h2>
                    </div>
                    <div class="icon-box"><i class="fas fa-hand-holding-dollar"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-box bg-gradient-warning p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-2">Tổng Chi Phí</h6>
                        <h2 class="mb-0 fw-bold display-6 text-white"><?= number_format($totalChiPhi,0,',','.') ?> ₫</h2>
                    </div>
                    <div class="icon-box"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-box bg-gradient-success p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 text-uppercase mb-2">Tổng Lợi Nhuận</h6>
<h2 class="mb-0 fw-bold display-6 text-dark"><?= number_format($totalLoiNhuan,0,',','.') ?> ₫</h2>
                    </div>
                    <div class="icon-box"><i class="fas fa-coins text-dark"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-secondary m-0">Chi tiết hiệu quả từng Tour</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="ps-3">Mã Tour</th>
                        <th scope="col">Tên Tour Du Lịch</th>
                        <th scope="col">Ngày Đi - Về</th>
                        <th scope="col" class="text-center">Danh Mục</th>
                        <th scope="col" class="text-end">Doanh Thu</th>
                        <th scope="col" class="text-end">Chi Phí</th>
                        <th scope="col" class="text-end">Lợi Nhuận</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(empty($dashboard)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-search me-2"></i>Không tìm thấy dữ liệu nào trong thời gian này.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($dashboard as $row): ?>
                    <tr>
                        <td class="ps-3 fw-bold text-secondary">#<?= $row['MaQuanLy'] ?></td>
                        <td>
                            <span class="d-block fw-bold text-dark"><?= $row['TenTour'] ?></span>
                        </td>
                        <td>
                            <small class="d-block text-muted">Đi: <?= date('d/m/Y', strtotime($row['NgayBatDau'])) ?></small>
                            <small class="d-block text-muted">Về: <?= date('d/m/Y', strtotime($row['NgayKetThuc'])) ?></small>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border"><?= $row['TenDanhMuc'] ?></span>
                        </td>
                        
                        <td class="text-end fw-bold-money text-primary">
                            <?= number_format($row['DoanhThu'],0,',','.') ?> ₫
                        </td>
                        <td class="text-end fw-bold-money text-secondary">
                            <?= number_format($row['ChiPhi'],0,',','.') ?> ₫
                        </td>
                        
                        <?php 
                            $profitClass = ($row['LoiNhuan'] >= 0) ? 'text-success-dark' : 'text-danger-dark';
?>
                        <td class="text-end fw-bold-money <?= $profitClass ?>">
                            <?= number_format($row['LoiNhuan'],0,',','.') ?> ₫
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>