<?= $this->extend('layouts/siakad') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 fw-bold mb-1">Data Mata Kuliah</h1>
      <p class="text-secondary small mb-0">Kurikulum aktif, bobot SKS, semester, dan dosen pengampu.</p>
    </div>
    <a href="<?= site_url('matakuliah/create') ?>" class="btn btn-sm btn-teal">+ Tambah Mata Kuliah</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Mata Kuliah</th>
          <th class="text-center">SKS</th>
          <th class="text-center">Semester</th>
          <th>Dosen Pengampu</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $row): ?>
          <tr>
            <td class="tabular-nums fw-semibold"><?= esc($row['kode']) ?></td>
            <td class="fw-medium"><?= esc($row['nama']) ?></td>
            <td class="text-center tabular-nums"><?= esc($row['sks']) ?></td>
            <td class="text-center tabular-nums"><?= esc($row['semester']) ?></td>
            <td class="small"><?= esc($row['nama_dosen'] ?? '-') ?></td>
            <td class="text-end text-nowrap">
              <a href="<?= site_url('matakuliah/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="<?= site_url('matakuliah/delete/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus mata kuliah ini?')">
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
