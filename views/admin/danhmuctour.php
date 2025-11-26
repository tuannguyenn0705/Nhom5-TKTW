        <?php
        require_once 'silderbar.php';
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Danh Sách Danh Mục Tour</title>
            <link rel="stylesheet" href="./views/css/danhMucTour.css">

        </head>

        <body>
            <h1>Danh Sách Danh Mục Tour</h1>
            <div class="action-container">
                    <form action="" method="get" class="search-form">
                        <?php
                        if (isset($_GET['mode'])) {
                            echo '<input type="hidden" name="mode" value="' . htmlspecialchars($_GET['mode']) . '">';
                        }
                        if (isset($_GET['act'])) {
                            echo '<input type="hidden" name="act" value="' . htmlspecialchars($_GET['act']) . '">';
                        }
                        ?>  
                        <input type="text" name="keyword" placeholder="Nhập tên danh mục..." value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                        <button type="submit">Tìm kiếm</button>
                    </form>
                    
                    <?php
                    $keyword =  isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
                    if ($keyword != '') {
                        $keyword_lower = strtolower($keyword);
                        $keyword_upper = strtoupper($keyword);
                        $result = array_filter($result, function ($item) use ($keyword_lower, $keyword_upper) {
                            if (strtoupper($item['MaDanhMuc']) === $keyword_upper) {
                                return true;
                            }
                            return strpos(strtolower($item['TenDanhMuc']), $keyword_lower) !== false ||
                                strpos(strtolower($item['LoaiTour']), $keyword_lower) !== false;
                        });
                    }
                    ?>
                <a href="<?= BASE_URL . '?mode=admin&act=form' ?>" class="add-button">Thêm danh mục</a>
            </div>
            <table border="1">
                <thead>
                    <tr>
                        <td>Danh mục tour</td>
                        <td>Tên Tour</td>
                        <td>Loại Tour</td>
                        <td>Mô Tả</td>
                        <td>Trạng Thái</td>
                        <td>Hành Động</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($result) && is_array($result)) {
                        foreach ($result as $key => $item) {
                    ?>
                            <tr>
                                <td><?php echo $item['MaDanhMuc']; ?></td>
                                <td><?php echo $item['TenDanhMuc']; ?></td>
                                <td><?php echo $item['LoaiTour']; ?></td>
                                <td><?php echo $item['MoTa']; ?></td>
                                <td><?php
                                    echo $item['TrangThai'];
                                    ?></td>
                                <td>
                                    <button><a href="<?= BASE_URL . '?mode=admin&act=edit&id=' . $item['MaDanhMuc'] ?>">Sửa</a> </button>
                                    
                                    <button><a href="<?= BASE_URL . '?mode=admin&act=delete&id=' . $item['MaDanhMuc'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</a></button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                    }
                    ?>
                </tbody>
            </table>
        </body>

        </html>