<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="surface-card p-4">
      <h2 class="h4 fw-bold mb-1">Formulir Kontak (GET + POST Validation)</h2>
      <p class="text-secondary mb-3">Menguji rute <code>POST /contact</code> dengan proteksi CSRF dan validasi input CodeIgniter 4.</p>

      <form action="<?= site_url('contact') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', 'Abrar Maulana') ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-medium">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= old('email', '5025241125@student.its.ac.id') ?>" required>
        </div>
        <div class="mb-3">
          <label for="subjek" class="form-label fw-medium">Subjek</label>
          <input type="text" id="subjek" name="subjek" class="form-control" value="<?= old('subjek') ?>" placeholder="Misal: Pertanyaan Modul PBKK 2-2" required>
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label fw-medium">Pesan</label>
          <textarea id="pesan" name="pesan" rows="4" class="form-control" placeholder="Tuliskan pesan minimal 8 karakter..." required><?= old('pesan') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
      </form>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="surface-card p-4">
      <h3 class="h6 fw-bold mb-3">Informasi Kontak Mahasiswa</h3>
      <p class="mb-2"><strong>Nama:</strong> Abrar Maulana</p>
      <p class="mb-2"><strong>NRP:</strong> <span class="tabular-nums">5025241125</span></p>
      <p class="mb-0"><strong>Departemen:</strong> Teknik Informatika — ITS Surabaya</p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
