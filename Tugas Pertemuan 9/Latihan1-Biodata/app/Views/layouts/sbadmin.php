<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'PBKK Biodata') ?> — PBKK C</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/sbadmin-custom.css') ?>">
</head>
<body>
  <div class="app-shell">
    <?= $this->include('partials/sidebar') ?>
    <div class="app-main">
      <?= $this->include('partials/topbar') ?>
      <main class="app-content">
        <?php if (session()->getFlashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
          </div>
        <?php endif; ?>
        <?php if ($errors = session()->getFlashdata('errors')): ?>
          <div class="alert alert-danger" role="alert">
            <ul class="mb-0 ps-3">
              <?php foreach ((array) $errors as $err): ?>
                <li><?= esc($err) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
      </main>
      <?= $this->include('partials/footer') ?>
    </div>
  </div>
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
