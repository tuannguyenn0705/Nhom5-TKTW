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
            <label>Chọn Tour:</label>
            <select name="MaChiTietTour" class="form-control" required>
                <option value="" hidden>Vui lòng chọn tour</option>

                <?php if(!empty($tours)): ?>
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
            <h4>Danh sách thành viên đoàn</h4>
            <div id="guest-inputs">
                </div>
            <button type="button" class="btn btn-add" onclick="addGuestInput()">+ Thêm thành viên</button>
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
            // Nếu chưa có ô nào thì tự động thêm 1 ô cho tiện
            if(document.getElementById('guest-inputs').children.length === 0){
                addGuestInput();
            }
        } else {
            container.style.display = 'none';
            // Xóa hết input khi quay về khách lẻ để tránh gửi dữ liệu thừa
            document.getElementById('guest-inputs').innerHTML = '';
        }
    }

    function addGuestInput() {
        var container = document.getElementById('guest-inputs');
        var index = container.children.length + 1;
        
        var div = document.createElement('div');
        div.className = 'guest-item';
        
        div.innerHTML = `
            <label>Thành viên ${index}:</label>
            <input type="text" name="KhachDoan[]" class="form-control" placeholder="Nhập tên thành viên..." required>
            <button type="button" class="btn btn-delete" onclick="removeGuest(this)">Xóa</button>
        `;
        container.appendChild(div);
    }

    function removeGuest(btn) {
        btn.parentElement.remove();
    }
</script>