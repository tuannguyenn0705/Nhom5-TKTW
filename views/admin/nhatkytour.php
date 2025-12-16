<?php require_once 'silderbar.php'; ?>
<div class="container-fluid mt-4">
  
  <h1 class="h3 mb-4 fw-bold text-primary">Quản Lý Nhật Ký Tour</h1>

  <div class="card shadow-sm">
    <div class="card-body">
      
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Tên Tour</th>
              <th>HDV Phụ Trách</th>
              <th>Ngày</th>
              <th>Sự Kiện & Sự Cố</th>
              <th>Hình Ảnh</th>
              <th>Phản Hồi</th>
              <th class="text-center">Hành Động</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><strong>#<?= $row['MaNhatKy'] ?></strong></td>

                    <td class="text-primary fw-semibold">
                        <?= htmlspecialchars($row['TenTour'] ?? '---') ?>
                    </td>

                    <td>
                        <i class="bi bi-person text-secondary me-1"></i>
                        <?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?>
                    </td>

                    <td><?= date('d/m/Y', strtotime($row['Ngay'])) ?></td>

                    <td>
                        <div><?= htmlspecialchars($row['SuKien']) ?></div>
                        <?php if(!empty($row['SuCo'])): ?>
                            <div class="text-danger small fw-bold">
                               <i class="bi bi-exclamation-triangle-fill me-1"></i>
                               <?= htmlspecialchars($row['SuCo']) ?>
                            </div>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <?php if (!empty($row['HinhAnhSuCo'])): ?>
                            <img src="./uploads/<?= htmlspecialchars($row['HinhAnhSuCo']) ?>" 
                                 class="img-thumbnail" style="max-width:60px;" alt="Ảnh lỗi">
                        <?php else: ?>
                            <span class="text-muted fst-italic">Không có ảnh</span>
                        <?php endif; ?>
                    </td>

                    <td class="fst-italic">
                        <?= htmlspecialchars($row['PhanHoiKhach'] ?? '') ?>
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                          <a href="<?= BASE_URL . '?mode=admin&act=editnhatkytour&id=' . $row['MaNhatKy'] ?>" 
                             class="btn btn-warning btn-sm rounded-pill shadow-sm px-3 d-inline-flex align-items-center custom-btn">
                             <i class="bi bi-pencil-square me-1"></i> Sửa
                          </a>
                          
                          <a href="<?= BASE_URL . '?mode=admin&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>" 
                             class="btn btn-danger btn-sm rounded-pill shadow-sm px-3 d-inline-flex align-items-center custom-btn"
                             onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                             <i class="bi bi-trash me-1"></i> Xóa
                          </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        Chưa có dữ liệu nhật ký nào.
                    </td>
                </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
.custom-btn {
  transition: all 0.3s ease;
  font-weight: 500;
}
.custom-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 12px rgba(0,0,0,0.25);
}
.btn-warning.custom-btn {
  background: linear-gradient(135deg, #ffc107, #fd7e14);
  border: none;
  color: #fff;
}
.btn-danger.custom-btn {
  background: linear-gradient(135deg, #dc3545, #c82333);
  border: none;
}
</style>