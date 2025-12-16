<?php require_once './views/admin/silderbar.php' ?>
<link rel="stylesheet" href="./views/css/editTour.css">

<style>
    .lt-item { background: #f9f9f9; padding: 15px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #ddd; position: relative; }
    .btn-remove { background: #ff4d4d; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; position: absolute; top: 10px; right: 10px; }
    .btn-add { background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-bottom: 20px; }
</style>

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
                <label>Chi Phí:</label>
                <input type="number" name="ChiPhi" value="<?= $result['ChiPhi'] ?? 0 ?>" required>
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
            <?php 
            if (!empty($lichtrinh)):
                foreach($lichtrinh as $lt): 
                    $uniqueId = uniqid(); 
            ?>
            <div class="lt-item" id="lt-<?= $uniqueId ?>">
                <button type="button" class="btn-remove" onclick="removeLT('<?= $uniqueId ?>')">Xóa</button>
                
                <div class="form-group">
                    <label>Ngày số:</label>
                    <input type="number" name="NgaySo[]" value="<?= $lt['NgaySo'] ?>" required style="width: 100px;">
                    <label style="margin-left: 20px;">Giờ:</label>
                    <input type="time" name="Gio[]" value="<?= $lt['Gio'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Mô tả sự kiện:</label>
                    <textarea name="MoTaSuKien[]" required rows="3" style="width: 100%;"><?= $lt['MoTaSuKien'] ?></textarea>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>

        <button type="button" class="btn-add" onclick="addLT()">+ Thêm Lịch Trình</button>
        <br><br>
        <button type="submit" class="btn-submit">Cập nhật Tour</button>

    </form>
</div>
</div>

<script>
function addLT() {
    const id = Date.now(); 
    const html = `
        <div class="lt-item" id="lt-${id}">
            <button type="button" class="btn-remove" onclick="removeLT(${id})">Xóa</button>
            <div class="form-group">
                <label>Ngày số:</label>
                <input type="number" name="NgaySo[]" required style="width: 100px;">
                <label style="margin-left: 20px;">Giờ:</label>
                <input type="time" name="Gio[]" required>
            </div>
            <div class="form-group">
                <label>Mô tả sự kiện:</label>
                <textarea name="MoTaSuKien[]" required rows="3" style="width: 100%;"></textarea>
            </div>
        </div>
    `;
    document.getElementById("lichtrinh-area").insertAdjacentHTML("beforeend", html);
}
function removeLT(id) {
    const element = document.getElementById("lt-" + id);
    if(element) element.remove();
}
</script>