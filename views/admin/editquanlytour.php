<?php require_once './views/admin/silderbar.php' ?>
<link rel="stylesheet" href="./views/css/editTour.css">

<div class="edit-tour-wrapper">
<div class="card">

    <h1>Sửa Tour</h1>

    <form action="<?= BASE_URL . '?mode=admin&act=updatequanlytour' ?>" method="POST">

        <input type="hidden" name="MaQuanLy" value="<?= $result['MaQuanLy'] ?>">

        <div class="form-grid">

            <div class="form-group">
                <label>Tên Tour:</label>
                <input type="text" name="TenTour" value="<?= $result['TenTour'] ?>" required>
            </div>

            <div class="form-group">
                <label>Danh Mục:</label>
                <select name="MaDanhMuc" required>
                    <?php foreach ($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['MaDanhMuc'] ?>" 
                        <?= ($dm['MaDanhMuc'] == $result['MaDanhMuc']) ? 'selected' : '' ?>>
                        <?= $dm['TenDanhMuc'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nhà Cung Cấp:</label>
                <select name="MaNCC" required>
                    <?php foreach($listNCC as $ncc): ?>
                    <option value="<?= $ncc['MaNCC'] ?>" 
                        <?= ($ncc['MaNCC'] == $result['MaNCC']) ? 'selected' : '' ?>>
                        <?= $ncc['TenNhaCungCap'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày Bắt Đầu:</label>
                <input type="date" name="NgayBatDau" value="<?= $result['NgayBatDau'] ?>" required>
            </div>

            <div class="form-group">
                <label>Ngày Kết Thúc:</label>
                <input type="date" name="NgayKetThuc" value="<?= $result['NgayKetThuc'] ?>" required>
            </div>

            <div class="form-group">
                <label>Giá:</label>
                <input type="number" name="Gia" value="<?= $result['Gia'] ?>" required>
            </div>

            <div class="form-group">
                <label>Trạng Thái:</label>
                <select name="TrangThai">
                    <option value="sắp khởi hành" <?= $result['TrangThai']=="sắp khởi hành" ? "selected" : "" ?>>Sắp khởi hành</option>
                    <option value="đang diễn ra" <?= $result['TrangThai']=="đang diễn ra" ? "selected" : "" ?>>Đang diễn ra</option>
                    <option value="hoàn thành" <?= $result['TrangThai']=="hoàn thành" ? "selected" : "" ?>>Hoàn thành</option>
                </select>
            </div>

            <div class="form-group">
                <label>Số Lượng Tối Đa:</label>
                <input type="number" name="SoLuongToiDa" value="<?= $result['SoLuongToiDa'] ?>" required>
            </div>

            <div class="form-group">
                <label>Tên Tài Xế:</label>
                <input type="text" name="TenTaiXe" value="<?= $result['TenTaiXe'] ?>">
            </div>

            <div class="form-group">
                <label>Biển Số Xe:</label>
                <input type="text" name="BienSoXe" value="<?= $result['BienSoXe'] ?>">
            </div>

            <div class="form-group">
                <label>SĐT Tài Xế:</label>
                <input type="number" name="SdtTaiXe" value="<?= $result['SdtTaiXe'] ?>">
            </div>

        </div>

        <h2 class="schedule-title">📅 Lịch Trình Tour</h2>

        <div id="lichtrinh-area">

            <?php foreach($lichtrinh as $lt): ?>
            <div class="lt-item">

                <input type="hidden" name="MaLichTrinh[]" value="<?= $lt['MaLichTrinh'] ?>">

                <label>Ngày số:</label>
                <input type="number" name="NgaySo[]" value="<?= $lt['NgaySo'] ?>" required>

                <label>Giờ:</label>
                <input type="time" name="Gio[]" value="<?= $lt['Gio'] ?>" required>

                <label>Mô tả sự kiện:</label>
                <textarea name="MoTaSuKien[]" required><?= $lt['MoTaSuKien'] ?></textarea>

            </div>
            <?php endforeach; ?>

        </div>

        <button type="submit" class="btn-submit">Cập nhật Tour</button>

    </form>

</div>
</div>
