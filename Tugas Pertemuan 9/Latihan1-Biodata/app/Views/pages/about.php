<?= $this->extend('layouts/sbadmin') ?>
<?= $this->section('content') ?>

<div class="surface-card p-4">
  <h2 class="h4 fw-bold mb-2">Tentang Arsitektur Latihan 1</h2>
  <p class="text-secondary">
    Halaman ini mempraktikkan pemetaan rute eksplisit di <code>app/Config/Routes.php</code> dengan
    <code>setAutoRoute(false)</code> menuju method <code>HomeController::about()</code> sesuai materi PBKK 2-2.
  </p>
  <div class="row g-3 mt-2">
    <div class="col-md-4">
      <div class="p-3 border rounded bg-light-subtle h-100">
        <h3 class="h6 fw-bold">Model</h3>
        <p class="small text-secondary mb-0"><code>CatatanModel</code>, <code>BerkasModel</code>, dan <code>UserModel</code> mengelola validasi serta query database SQLite/MySQL.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-3 border rounded bg-light-subtle h-100">
        <h3 class="h6 fw-bold">View</h3>
        <p class="small text-secondary mb-0">Layout <code>layouts/sbadmin.php</code> memisahkan <code>partials/sidebar.php</code>, <code>topbar.php</code>, dan <code>footer.php</code>.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="p-3 border rounded bg-light-subtle h-100">
        <h3 class="h6 fw-bold">Controller &amp; Filter</h3>
        <p class="small text-secondary mb-0"><code>AuthFilter</code> memastikan hanya admin terautentikasi yang dapat mengubah data catatan atau mengunggah file.</p>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
