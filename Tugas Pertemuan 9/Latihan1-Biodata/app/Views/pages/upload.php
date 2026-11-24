<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="surface-card p-4">
      <h2 class="h5 fw-bold mb-2">Unggah Berkas (PBKK 2-6)</h2>
      <p class="small text-secondary mb-3">Format diizinkan: PNG, JPG, WEBP, PDF, TXT (maks. 2 MB).</p>

      <?php if (session()->get('is_logged_in')): ?>
        <form action="<?= site_url('upload') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="judul" class="form-label fw-medium">Judul Berkas</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul') ?>" placeholder="Misal: Diagram Alur CI4" required>
          </div>
          <div class="mb-3">
            <label for="berkas" class="form-label fw-medium">Pilih File</label>
            <input type="file" id="berkas" name="berkas" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Unggah Sekarang</button>
        </form>
      <?php else: ?>
        <div class="alert alert-warning mb-0">
          Login sebagai admin terlebih dahulu untuk mengunggah atau menghapus berkas.
          <a href="<?= site_url('login') ?>" class="alert-link">Ke halaman Login</a>.
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="surface-card p-4">
      <h2 class="h5 fw-bold mb-3">Daftar Berkas Terunggah</h2>
      <?php if (empty($files)): ?>
        <div class="text-secondary py-4 text-center">Belum ada berkas yang diunggah.</div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Nama Asli</th>
                <th>Tipe / Ukuran</th>
                <th class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($files as $f): ?>
                <tr>
                  <td class="fw-medium"><?= esc($f['judul']) ?></td>
                  <td class="small text-secondary"><?= esc($f['nama_asli']) ?></td>
                  <td class="small tabular-nums"><?= esc($f['mime_type']) ?> · <?= esc($f['ukuran_kb']) ?> KB</td>
                  <td class="text-end text-nowrap">
                    <a href="<?= base_url('uploads/' . $f['nama_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                    <?php if (session()->get('is_logged_in')): ?>
                      <form action="<?= site_url('upload/delete/' . $f['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus berkas ini?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
