<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="surface-card p-3 mb-4">
  <div class="row text-center g-3">
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Total Pengguna</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($totalUsers) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Admin / Operator</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($roleCounts['admin']) ?> / <?= esc($roleCounts['operator']) ?></div>
    </div>
    <div class="col-6 col-md-3 border-end">
      <div class="small text-secondary">Pelanggan Terdaftar</div>
      <div class="fs-3 fw-bold tabular-nums text-success"><?= esc($roleCounts['customer']) ?></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="small text-secondary">Produk / Kategori Katalog</div>
      <div class="fs-3 fw-bold tabular-nums"><?= esc($totalProducts) ?> / <?= esc($totalCats) ?></div>
    </div>
  </div>
</div>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
      <h2 class="h5 fw-bold mb-1">Daftar Akun &amp; Kontrol Akses RBAC</h2>
      <p class="small text-secondary mb-0">Hanya akun berrole <code>admin</code> yang dapat membuka <code>/admin/dashboard</code> melalui <code>AuthFilter</code>.</p>
    </div>
    <a href="<?= site_url('operator/dashboard') ?>" class="btn btn-sm btn-pine">Buka Panel Operator</a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Peran (Role)</th>
          <th>Status</th>
          <th class="text-end">Gagal Login</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td class="tabular-nums text-secondary"><?= esc($u['id']) ?></td>
            <td class="fw-medium"><?= esc($u['name']) ?></td>
            <td><?= esc($u['email']) ?></td>
            <td class="tabular-nums small text-secondary"><?= esc($u['phone'] ?? '-') ?></td>
            <td>
              <?php
                $roleBadge = match ($u['role']) {
                    'admin'    => 'text-bg-dark',
                    'operator' => 'text-bg-primary',
                    default    => 'text-bg-secondary',
                };
              ?>
              <span class="badge <?= $roleBadge ?> text-uppercase"><?= esc($u['role']) ?></span>
            </td>
            <td>
              <span class="badge <?= (int) $u['is_active'] === 1 ? 'text-bg-success' : 'text-bg-danger' ?>">
                <?= (int) $u['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?>
              </span>
            </td>
            <td class="text-end tabular-nums"><?= esc($u['failed_attempts']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
