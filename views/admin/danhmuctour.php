<?php
require_once 'silderbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Danh Mục Tour</title>
    <link rel="stylesheet" href="./views/admin/style.css">
    
</head>
<body>
    <h1>Danh Sách Danh Mục Tour</h1>
    <div class="action-container">
        <input type="text" name="search" id="search" placeholder="Tìm kiếm theo Tên Danh Mục...">
        
        <a href="<?= BASE_URL . '?mode=admin&act=form'?>" class="add-button">Thêm danh mục</a>
    </div>
    <table border="1">
        <thead>
            <tr>
                <td>Danh mục tour</td>
                <td>Tên Danh Mục</td>
                <td>Loại Tour</td>
                <td>Mô Tả</td>
                <td>Trạng Thái</td>
                <td>Hành Động</td> </tr>
        </thead>
        <tbody>
            <?php
            // ... (Đoạn PHP của bạn)
            if (!empty($result) && is_array($result)) {
                foreach($result as $key => $item){
                    ?>
                    <tr>
                        <td><?php echo $item['MaDanhMuc']; ?></td>
                        <td><?php echo $item['TenDanhMuc']; ?></td>
                        <td><?php echo $item['LoaiTour']; ?></td>
                        <td><?php echo $item['MoTa']; ?></td>
                        <td><?php 
                            // Thêm logic hiển thị trạng thái
                            echo $item['TrangThai']; 
                        ?></td>
                        <td>
                            <a href="<?= BASE_URL . '?mode=admin&act=edit&id='. $item['MaDanhMuc']?>">Sửa</a> |
                            <a href="<?= BASE_URL . '?mode=admin&act=delete&id='. $item['MaDanhMuc']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                        </td>
                    </tr>
                    <?php
                } 
            } else {
                // ...
            }
            ?>
            </tbody>
    </table>
</body>
</html>
