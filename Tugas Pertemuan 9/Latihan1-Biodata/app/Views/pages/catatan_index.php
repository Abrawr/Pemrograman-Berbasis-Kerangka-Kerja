<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
      <h2 class="h4 fw-bold mb-1">Catatan Praktikum (Model &amp; CRUD)</h2>
      <p class="text-secondary mb-0">Operasi tambah, ubah, dan hapus dilindungi oleh <code>AuthFilter</code>.</p>
    </div>
    <div class="d-flex gap-2">
      <form action="<?= site_url('catatan') ?>" method="get" class="d-flex gap-2">
        <input type="search" name="q" value="<?= esc($keyword ?? '') ?>" class="form-control form-control-sm" placeholder="Cari modul atau judul...">
        <button type="submit" class="btn btn-sm btn-outline-secondary">Cari</button>
      </form>
      <?php if (session()->get('is_logged_in')): ?>
        <a href="<?= site_url('catatan/create') ?>" class="btn btn-sm btn-primary text-nowrap">+ Tambah Catatan</a>
      <?php else: ?>
        <a href="<?= site_url('login') ?>" class="btn btn-sm btn-outline-primary text-nowrap">Login untuk Kelola</a>
      <?php endif; ?>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="text-center py-5 text-secondary">
      Belum ada catatan yang cocok dengan pencarian Anda.
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Modul</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Ringkasan</th>
            <?php if (session()->get('is_logged_in')): ?>
              <th class="text-end">Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $idx => $row): ?>
            <tr>
              <td class="tabular-nums text-secondary"><?= $idx + 1 ?></td>
              <td class="fw-semibold text-nowrap"><?= esc($row['modul_pbkk']) ?></td>
              <td class="fw-medium"><?= esc($row['judul']) ?></td>
              <td><span class="badge text-bg-light border text-dark"><?= esc($row['kategori']) ?></span></td>
              <td>
                <?php
                  $badgeClass = match ($row['status']) {
                      'Selesai' => 'text-bg-success',
                      'Proses'  => 'text-bg-warning',
                      default   => 'text-bg-secondary',
                  };
                ?>
                <span class="badge <?= $badgeClass ?>"><?= esc($row['status']) ?></span>
              </td>
              <td class="small text-secondary"><?= esc($row['isi']) ?></td>
              <?php if (session()->get('is_logged_in')): ?>
                <td class="text-end text-nowrap">
                  <a href="<?= site_url('catatan/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                  <form action="<?= site_url('catatan/delete/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus catatan ini?')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                  </form>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
