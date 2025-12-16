<?php
require_once 'silderbar.php';
?>

<link rel="stylesheet" href="./views/css/formbooking.css">

<div class="booking-container">
    <h2>Thêm Booking Mới</h2>
    <form action="?mode=admin&act=store_booking" method="POST">

        <div class="form-group">
            <label>Loại khách:</label>
            <div class="radio-group">
                <label class="radio-item">
                    <input type="radio" id="khach_le" name="loai_khach" value="le" checked onclick="toggleGuestList()">
                    Khách lẻ
                </label>
                <label class="radio-item">
                    <input type="radio" id="khach_doan" name="loai_khach" value="doan" onclick="toggleGuestList()">
                    Khách đoàn
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Tên Khách Đặt:</label>
            <input type="text" name="TenKhachHang" required class="form-control" placeholder="Nhập họ và tên...">
        </div>

        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" name="SDT" required class="form-control" placeholder="Nhập số điện thoại liên hệ...">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="Email" required class="form-control" placeholder="example@gmail.com">
        </div>

        <div class="form-group">
            <label>Yêu cầu đặc biệt:</label>
            <textarea name="YeuCauDacBiet" class="form-control" rows="2" placeholder="VD: Ăn chay, ghế đầu xe..."></textarea>
        </div>

        <div class="form-group">
            <label>Chọn Tour:</label>
            <select name="MaChiTietTour" class="form-control" required>
                <option value="" hidden>Vui lòng chọn tour</option>

                <?php if (!empty($tours)): ?>
                    <?php foreach ($tours as $tour): ?>
                        <option value="<?= $tour['MaQuanLy'] ?>">
                            <?= $tour['TenTour'] ?> (<?= number_format($tour['Gia'], 0, ',', '.') ?> VNĐ)
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Không có tour nào khả dụng</option>
                <?php endif; ?>
            </select>
        </div>

        <div id="guest-list-container" style="display: none;">
            <div class="guest-list-header">
                <h4>Danh sách đoàn (<span id="guest-count">0</span> khách)</h4>
            </div>

            <div id="guest-inputs">
            </div>

            <div class="btn-actions-footer">
                <button type="button" class="btn btn-add" onclick="addGuestInput()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Thêm Khách
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Xác Nhận Tạo Booking</button>
    </form>
</div>

<script>
    function toggleGuestList() {
        var isGroup = document.getElementById('khach_doan').checked;
        var container = document.getElementById('guest-list-container');

        if (isGroup) {
            container.style.display = 'block';
            if (document.getElementById('guest-inputs').children.length === 0) {
                addGuestInput();
            }
        } else {
            container.style.display = 'none';
            document.getElementById('guest-inputs').innerHTML = '';
            updateCount();
        }
    }

    function addGuestInput() {
        var container = document.getElementById('guest-inputs');
        var div = document.createElement('div');
        div.className = 'guest-item';

        div.innerHTML = `
            <div class="guest-index-box">
                <span class="guest-badge">1</span>
            </div>

            <div class="guest-grid-inputs">
                <div>
                    <label style="font-size:11px; font-weight:700; color:#64748b; margin-bottom:4px; display:block">HỌ VÀ TÊN (*)</label>
                    <input type="text" name="KhachDoan[0][HoTen]" class="form-control" placeholder="Nhập tên khách..." required>
                </div>
                <div>
                    <label style="font-size:11px; font-weight:700; color:#64748b; margin-bottom:4px; display:block">SỐ ĐIỆN THOẠI</label>
                    <input type="text" name="KhachDoan[0][SDT]" class="form-control" placeholder="09xxxx...">
                </div>

                <div class="input-half-row">
                    <input type="email" name="KhachDoan[0][Email]" class="form-control" placeholder="Email liên hệ">
                </div>
                <div class="input-half-row">
                    <input type="text" name="KhachDoan[0][YeuCau]" class="form-control" placeholder="Ghi chú đặc biệt (Ăn chay...)">
                </div>
            </div>

            <button type="button" class="btn-delete-row" onclick="removeGuest(this)" title="Xóa khách này">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        `;

        container.appendChild(div);

        container.scrollTop = container.scrollHeight;

        updateGuestIndices();
    }

    function removeGuest(btn) {
        var item = btn.closest('.guest-item');
        if (item) {
            item.remove();
            updateGuestIndices();
        }
    }

    function updateGuestIndices() {
        var container = document.getElementById('guest-inputs');
        var items = container.querySelectorAll('.guest-item');

        items.forEach(function(item, index) {
            var newIndex = index + 1;

            item.querySelector('.guest-badge').innerText = newIndex;

            var inputs = item.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.name = input.name.replace(/KhachDoan\[\d+\]/, 'KhachDoan[' + newIndex + ']');
            });
        });

        updateCount();
    }

    function updateCount() {
        var count = document.getElementById('guest-inputs').children.length;
        var countSpan = document.getElementById('guest-count');
        if (countSpan) countSpan.innerText = count;
    }
</script>