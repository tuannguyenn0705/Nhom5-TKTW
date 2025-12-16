<?php require_once 'silderbar.php'; ?>
<div class="container-fluid mt-4">
  
  <h1 class="h3 mb-4 fw-bold text-primary">Quản Lý Nhật Ký Tour (Admin)</h1>

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
                    <td class="text-primary fw-semibold"><?= htmlspecialchars($row['TenTour'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($row['TenHDV'] ?? 'Chưa phân công') ?></td>
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
                    <td class="fst-italic"><?= htmlspecialchars($row['PhanHoiKhach'] ?? '') ?></td>
                    <td class="text-center">
                        <a href="<?= BASE_URL . '?mode=admin&act=xoanhatkytour&id=' . $row['MaNhatKy'] ?>" 
                           class="btn btn-danger btn-sm rounded-pill shadow-sm px-3"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa nhật ký này không? Hành động này không thể hoàn tác!')">
                           <i class="bi bi-trash me-1"></i> Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">Chưa có dữ liệu nhật ký nào.</td>
                </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>