<?php require_once "./views/admin/silderbar.php" ?>

</style>

<div class="page-wrapper">

    <div class="detail-container">

        <h2>Thông Tin Chi Tiết Tour</h2>

        <table class="detail-table">
            <tbody>
                <tr><th>Mã Quản Lý</th> <td><?= $tour['MaQuanLy'] ?></td></tr>
                <tr><th>Mã Danh Mục</th> <td><?= $tour['TenDanhMuc'] ?></td></tr>
                <tr><th>Tên Tour</th> <td><?= $tour['TenTour'] ?></td></tr>
                <tr><th>Ngày Bắt Đầu</th> <td><?= $tour['NgayBatDau'] ?></td></tr>
                <tr><th>Ngày Kết Thúc</th> <td><?= $tour['NgayKetThuc'] ?></td></tr>
                <tr><th>Giá Tour</th> <td><?= number_format($tour['Gia']) ?> VNĐ</td></tr>
                <tr><th>Trạng Thái</th> <td><?= $tour['TrangThai'] ?></td></tr>
                <tr><th>Số lượng tối đa</th> <td><?= $tour['SoLuongToiDa'] ?></td></tr>
                <tr><th>Nhà Cung Cấp</th> <td><?= $tour['TenNhaCungCap'] ?></td></tr>
                <tr><th>Tên Tài Xế</th> <td><?= $tour['TenTaiXe'] ?></td></tr>
                <tr><th>Biển Số Xe</th> <td><?= $tour['BienSoXe'] ?></td></tr>
                <tr><th>SĐT Tài Xế</th> <td><?= $tour['SdtTaiXe'] ?></td></tr>
            </tbody>
        </table>

        <h3 class="schedule-title">📅 Lịch Trình Chi Tiết</h3>

        <?php if (!empty($lichtrinh)): ?>
            <?php foreach ($lichtrinh as $lt): ?>
                <div class="schedule-card">
                    <b>Ngày <?= $lt['NgaySo'] ?></b><br>
                    <b>Giờ:</b> <?= $lt['Gio'] ?><br>
                    <b>Sự kiện:</b> <?= $lt['MoTaSuKien'] ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: #777;">Chưa có lịch trình cho tour này.</p>
        <?php endif; ?>

        <br>

        <hr>

<h3 class="schedule-title">➕ Thêm Lịch Trình Mới</h3>

<form action="<?= BASE_URL ?>?mode=admin&act=addlichtrinh" method="POST">
    <input type="hidden" name="MaQuanLy" value="<?= $tour['MaQuanLy'] ?>">

    <div id="lichtrinh-area"></div>

    <button type="button" class="btn-add" onclick="addLT()">+ Thêm Lịch Trình</button>
    <br><br>
    <button type="submit" class="btn-submit">Lưu Lịch Trình</button>
</form>
<br>

        <a href="<?= BASE_URL . '?mode=admin&act=quanlytour' ?>" class="back-btn">← Quay lại danh sách</a>

    </div>

</div>

<style>
    .page-wrapper {
    margin-left: 0px;
    padding: 0; 
    background: #f5f7fb;
    min-height: 100vh;
}


    .detail-container {
    width: 100%;
    margin: 0;
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}


    h2 {
        margin-bottom: 20px;
        font-size: 26px;
        color: #222;
        font-weight: bold;
    }

    table.detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    table.detail-table th {
        text-align: left;
        background: #f0f2f7;
        padding: 14px;
        width: 220px;
        font-weight: 600;
        border-bottom: 1px solid #ddd;
    }

    table.detail-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
    }

    .schedule-title {
        margin-top: 30px;
        margin-bottom: 10px;
        font-size: 22px;
        font-weight: bold;
        color: #333;
    }

    .schedule-card {
        background: #ffffff;
        border-left: 5px solid #4CAF50;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        margin-bottom: 12px;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #2563eb;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }
    .back-btn:hover {
        background: #1e4fc7;
    }

    .lt-item {
    background: #f9fafb;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.lt-row {
    display: flex;
    gap: 15px;
    align-items: end;
}

.lt-row div {
    flex: 1;
}

.lt-row label {
    font-weight: 600;
}

.lt-row input {
    width: 100%;
    padding: 8px;
}

textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 8px;
}

.btn-add {
    padding: 10px 16px;
    background: #16a34a;
    color: white;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.btn-submit {
    padding: 10px 20px;
    background: #2563eb;
    color: white;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.btn-remove {
    background: #ef4444;
    color: white;
    border: none;
    padding: 8px 10px;
    border-radius: 6px;
    cursor: pointer;
}

</style>
<script>
function addLT() {
    const id = Date.now();

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

    document.getElementById("lichtrinh-area")
        .insertAdjacentHTML("beforeend", html);
}

function removeLT(id) {
    document.getElementById("lt-" + id).remove();
}
</script>
