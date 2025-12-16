<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhật Ký Tour</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="./views/hdv/silderbar.css">

    <style>
        /* CSS riêng cho Form để đẹp hơn */
        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            max-width: 800px; /* Giới hạn chiều rộng form cho đẹp */
            margin: 0 auto; /* Căn giữa form */
        }
        
        .form-header h1 {
            font-size: 1.5rem;
            color: #1f2937;
            margin-bottom: 25px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 15px;
        }

        .form-group { margin-bottom: 20px; }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary { background-color: #3b82f6; color: white; }
        .btn-primary:hover { background-color: #2563eb; }

        .btn-secondary { background-color: #e5e7eb; color: #374151; }
        .btn-secondary:hover { background-color: #d1d5db; }
    </style>
</head>

<body>
    <?php require_once './views/hdv/silderbar.php'; ?>

    <div class="main-content">
        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-plus-circle" style="color: #3b82f6;"></i> Thêm Nhật Ký Tour</h1>
            </div>
            
            <form action="<?= BASE_URL . '?mode=hdv&act=addnhatkytour' ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="MaQuanLy">Chọn Tour <span style="color:red">*</span>:</label>
                    <select class="form-control" name="MaQuanLy" id="MaQuanLy" required>
                        <option value="">-- Chọn Tour --</option>
                        <?php if (!empty($dsTour)): ?>
                            <?php foreach ($dsTour as $tour): ?>
                                <option value="<?= $tour['MaQuanLy'] ?>"><?= htmlspecialchars($tour['TenTour']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>HDV Phụ Trách:</label>
                    <input type="text" class="form-control" value="<?= $_SESSION['user']['HoTen'] ?? 'Trần Hướng Dẫn' ?>" readonly style="background-color: #f3f4f6; color: #6b7280;">
                </div>

                <div class="form-group">
                    <label for="Ngay">Ngày ghi nhận <span style="color:red">*</span>:</label>
                    <input type="date" class="form-control" name="Ngay" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label for="SuKien">Sự Kiện / Hoạt Động:</label>
                    <textarea class="form-control" name="SuKien" rows="3" placeholder="Mô tả hoạt động chính trong ngày..."></textarea>
                </div>

                <div class="form-group">
                    <label for="SuCo" style="color: #ef4444;">Sự Cố (Nếu có):</label>
                    <textarea class="form-control" name="SuCo" rows="2" placeholder="Nhập sự cố phát sinh (tắc đường, khách ốm...)" style="border-color: #fca5a5;"></textarea>
                </div>

                <div class="form-group">
                    <label for="HinhAnhSuCo">Hình ảnh sự cố:</label>
                    <input type="file" class="form-control" name="HinhAnhSuCo" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="PhanHoiKhach">Phản Hồi Khách Hàng:</label>
                    <textarea class="form-control" name="PhanHoiKhach" rows="2" placeholder="Khách hàng khen/chê gì..."></textarea>
                </div>

                <div class="form-actions">
                    <a href="<?= BASE_URL ?>?mode=hdv&act=nhatkytour" class="btn btn-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save" style="margin-right: 8px;"></i> Lưu Nhật Ký
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>