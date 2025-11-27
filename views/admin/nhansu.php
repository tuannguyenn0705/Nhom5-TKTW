<?php
require_once 'silderbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Sự</title>
    <link rel="stylesheet" href="./views/css/nhanSu.css">

</head>

<body>
    <h1>Danh Sách Nhân Sự</h1>
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
                if (strtoupper($item['MaNhanSu']) === $keyword_upper) {
                    return true;
                }
                return strpos(strtolower($item['HoTen']), $keyword_lower) !== false ||
                    strpos(strtolower($item['VaiTro']), $keyword_lower) !== false;
            });
        }
        ?>
        <a href="<?= BASE_URL . '?mode=admin&act=formnhansu' ?>" class="add-button">Thêm nhân sự</a>
    </div>
    <table border="1">
        <thead>
            <tr>
                <td>STT</td>
                <td>Họ Tên</td>
                <td>SDT</td>
                <td>Email</td>
                <td>Vai Trò</td>
                <td>Ghi Chú</td>
                <td>Hành Động</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($result) && is_array($result)) {
                foreach ($result as $key => $item) {
            ?>
                    <tr>
                        <td><?php echo $item['MaNhanSu']; ?></td>
                        <td><?php echo $item['HoTen']; ?></td>
                        <td><?php echo $item['SDT']; ?></td>
                        <td><?php echo $item['Email']; ?></td>
                        <td><?php echo $item['VaiTro']; ?></td>
                        <td><?php echo $item['GhiChu']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <?php if (strtoupper($item['VaiTro']) !== 'ADMIN') { ?>

                                    <a href="<?= BASE_URL . '?mode=admin&act=editnhansu&id=' . $item['MaNhanSu'] ?>" class="btn-action btn-edit">
                                        Sửa
                                    </a>

                                <?php } ?>

                                <?php if (strtoupper($item['VaiTro']) !== 'ADMIN') { ?>

                                    <a href="<?= BASE_URL . '?mode=admin&act=deletenhansu&id=' . $item['MaNhanSu'] ?>"
                                        class="btn-action btn-delete"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa nhân sự này không?')">
                                        Xóa
                                    </a>

                                <?php } ?>
                            </div>
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