<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center py-3">
  <div class="col-md-8 col-lg-6">
    <div class="surface-card p-4 p-lg-5">
      <h1 class="h3 fw-bold mb-1">Daftar Akun Pelanggan</h1>
      <p class="text-secondary small mb-4">Akun baru otomatis terdaftar sebagai peran <code>customer</code> dengan password ter-hash Bcrypt.</p>

      <form action="<?= site_url('register') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="name" class="form-label fw-medium">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="form-control" value="<?= old('name') ?>" placeholder="Misal: Siti Rahmawati" required>
        </div>
        <div class="row g-3 mb-3">
          <div class="col-md-7">
            <label for="email" class="form-label fw-medium">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="email@contoh.com" required>
          </div>
          <div class="col-md-5">
            <label for="phone" class="form-label fw-medium">No. Telepon (Opsional)</label>
            <input type="text" id="phone" name="phone" class="form-control tabular-nums" value="<?= old('phone') ?>" placeholder="08123456789">
          </div>
        </div>
        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label for="password" class="form-label fw-medium">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
          </div>
          <div class="col-md-6">
            <label for="password_confirm" class="form-label fw-medium">Konfirmasi Password</label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Ulangi password" required>
          </div>
        </div>
        <button type="submit" class="btn btn-cta w-100 py-2">Buat Akun Pelanggan</button>
      </form>

      <div class="mt-3 text-center small">
        Sudah punya akun? <a href="<?= site_url('login') ?>" class="fw-semibold text-decoration-none">Masuk di sini</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
