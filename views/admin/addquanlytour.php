<?php require_once "./views/admin/silderbar.php" ?>
<link rel="stylesheet" href="./views/css/addTour.css">

<div class="add-tour-wrapper">
<div class="card">
    <h1>Thêm Tour Mới</h1>

    <form action="<?= BASE_URL ?>?mode=admin&act=addquanlytour" method="POST">

        <div class="form-grid">

            <div class="form-group">
                <label>Tên Tour</label>
                <input type="text" name="TenTour" required>
            </div>

            <div class="form-group">
                <label>Danh Mục</label>
                <select name="MaDanhMuc" required>
                    <?php foreach ($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['MaDanhMuc'] ?>"><?= $dm['TenDanhMuc'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Nhà Cung Cấp</label>
                <select name="MaNCC" required>
                    <?php foreach($listNCC as $ncc): ?>
                        <option value="<?= $ncc['MaNCC'] ?>">
                            <?= $ncc['TenNhaCungCap'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày Bắt Đầu</label>
                <input type="date" name="NgayBatDau" required>
            </div>

            <div class="form-group">
                <label>Ngày Kết Thúc</label>
                <input type="date" name="NgayKetThuc" required>
            </div>

            <div class="form-group">
                <label>Giá Tour</label>
                <input type="number" name="Gia" required>
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="TrangThai" required>
                    <option value="sắp khởi hành">Sắp khởi hành</option>
                    <option value="đang diễn ra">Đang diễn ra</option>
                    <option value="hoàn thành"> hoàn thành</option>
                </select>
            </div>
          
            <div class="form-group">
                <label>Số Lượng Tối Đa</label>
                <input type="number" name="SoLuongToiDa" required>
            </div>

            <div class="form-group">
                <label>Tên Tài Xế</label>
                <input type="text" name="TenTaiXe">
            </div>

            <div class="form-group">
                <label>Biển Số Xe</label>
                <input type="text" name="BienSoXe">
            </div>

            <div class="form-group">
                <label>SĐT Tài Xế</label>
                <input type="text" name="SdtTaiXe">
            </div>

        </div>

        <h2 class="schedule-title">📅 Lịch Trình Tour</h2>

        <div id="lichtrinh-area"></div>

        <button type="button" class="btn-add" onclick="addLT()">+ Thêm Lịch Trình</button>

        <button type="submit" class="btn-submit">Thêm Tour</button>
        <br> <br>
        <a href="<?= BASE_URL ?>?mode=admin&act=quanlytour" class="btn-back">⬅ Quay lại</a>
    </form>
</div>
</div>

<script>
function addLT() {
    const id = Date.now(); // tạo id duy nhất cho mỗi lịch trình

    const html = `
        <div class="lt-item" id="lt-${id}">
            <div class="lt-row">
                <div>
                    <label>Ngày Số</label>
                    <input type="number" name="NgaySo[]" required>
                </div>

                <div>
                    <label>Giờ</label>
                    <input type="time" name="Gio[]" required>
                </div>

                <button type="button" class="btn-remove" onclick="removeLT(${id})">X</button>
            </div>

            <label>Mô Tả Sự Kiện</label>
            <textarea name="MoTaSuKien[]" required></textarea>
        </div>
    `;

    document.getElementById("lichtrinh-area").insertAdjacentHTML("beforeend", html);
}

function removeLT(id) {
    document.getElementById("lt-" + id).remove();
}
</script>
