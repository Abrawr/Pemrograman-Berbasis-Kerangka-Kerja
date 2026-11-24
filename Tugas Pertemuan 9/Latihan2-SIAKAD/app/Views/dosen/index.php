<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 fw-bold mb-1">Data Dosen</h1>
      <p class="text-secondary small mb-0">Daftar dosen pengampu mata kuliah dan dosen wali mahasiswa.</p>
    </div>
    <a href="<?= site_url('dosen/create') ?>" class="btn btn-sm btn-teal">+ Tambah Dosen</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>NIDN</th>
          <th>Nama Dosen</th>
          <th>Email</th>
          <th>Bidang Keahlian</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $row): ?>
          <tr>
            <td class="tabular-nums fw-semibold"><?= esc($row['nidn']) ?></td>
            <td class="fw-medium"><?= esc($row['nama']) ?></td>
            <td class="small text-secondary"><?= esc($row['email']) ?></td>
            <td class="small"><?= esc($row['keahlian']) ?></td>
            <td class="text-end text-nowrap">
              <a href="<?= site_url('dosen/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="<?= site_url('dosen/delete/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus dosen ini?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
