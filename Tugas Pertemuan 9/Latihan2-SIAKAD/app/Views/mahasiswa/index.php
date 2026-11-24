<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
      <h1 class="h4 fw-bold mb-1">Data Mahasiswa</h1>
      <p class="text-secondary small mb-0">Pengelolaan data master mahasiswa beserta dosen wali.</p>
    </div>
    <div class="d-flex gap-2">
      <form action="<?= site_url('mahasiswa') ?>" method="get" class="d-flex gap-2">
        <input type="search" name="q" value="<?= esc($q ?? '') ?>" class="form-control form-control-sm" placeholder="Cari NRP atau nama...">
        <button type="submit" class="btn btn-sm btn-outline-secondary">Cari</button>
      </form>
      <a href="<?= site_url('mahasiswa/create') ?>" class="btn btn-sm btn-teal text-nowrap">+ Tambah Mahasiswa</a>
    </div>
  </div>

  <?php if (empty($items)): ?>
    <div class="text-center py-5 text-secondary">Belum ada data mahasiswa yang cocok.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>NRP</th>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>Angkatan / Prodi</th>
            <th>Dosen Wali</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $row): ?>
            <tr>
              <td class="tabular-nums fw-semibold"><?= esc($row['nrp']) ?></td>
              <td class="fw-medium"><?= esc($row['nama']) ?></td>
              <td class="small text-secondary"><?= esc($row['email']) ?></td>
              <td class="small"><span class="tabular-nums"><?= esc($row['angkatan']) ?></span> · <?= esc($row['prodi']) ?></td>
              <td class="small"><?= esc($row['nama_dosen_wali'] ?? '-') ?></td>
              <td>
                <span class="badge <?= $row['status'] === 'Aktif' ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= esc($row['status']) ?></span>
              </td>
              <td class="text-end text-nowrap">
                <a href="<?= site_url('mahasiswa/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="<?= site_url('mahasiswa/delete/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus mahasiswa ini beserta KRS-nya?')">
                  <?= csrf_field() ?>
                  <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
