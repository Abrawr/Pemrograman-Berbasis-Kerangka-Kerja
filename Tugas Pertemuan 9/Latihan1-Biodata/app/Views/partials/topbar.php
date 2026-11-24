<header class="app-topbar">
  <div>
    <h1 class="h5 mb-0 fw-semibold"><?= esc($title ?? 'Dashboard') ?></h1>
  </div>
  <div class="d-flex align-items-center gap-2">
    <?php if (session()->get('is_logged_in')): ?>
      <span class="badge text-bg-light border text-dark">
        Masuk: <?= esc(session()->get('username')) ?>
      </span>
      <form action="<?= site_url('logout') ?>" method="post" class="d-inline">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
      </form>
    <?php else: ?>
      <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary">Login Admin</a>
    <?php endif; ?>
  </div>
</header>
