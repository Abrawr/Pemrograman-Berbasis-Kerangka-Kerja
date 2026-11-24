<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="surface-card p-4">
      <h2 class="h4 fw-bold mb-1">Login Pengaturan Akses (PBKK 2-7)</h2>
      <p class="text-secondary small mb-3">Masuk untuk membuka akses tambah/edit/hapus catatan serta unggah berkas.</p>

      <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="username" class="form-label fw-medium">Username</label>
          <input type="text" id="username" name="username" class="form-control" value="<?= old('username', 'admin') ?>" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-medium">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>

      <div class="mt-3 p-3 bg-light rounded border small">
        <div class="fw-semibold mb-1">Akun Demo</div>
        <div>Username: <code>admin</code> · Password: <code>admin123</code></div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
