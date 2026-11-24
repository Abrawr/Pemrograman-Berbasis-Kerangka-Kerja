<?= $this->extend('layouts/store') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="surface-card p-4">
      <h1 class="h3 fw-bold mb-1">Hubungi Tim ShopEase</h1>
      <p class="text-secondary small mb-4">Kirim pertanyaan produk atau konfirmasi ketersediaan stok melalui formulir di bawah ini.</p>

      <form action="<?= site_url('contact') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama', 'Abrar Maulana') ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-medium">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= old('email', '5025241125@student.its.ac.id') ?>" required>
        </div>
        <div class="mb-3">
          <label for="topik" class="form-label fw-medium">Topik Pertanyaan</label>
          <input type="text" id="topik" name="topik" class="form-control" value="<?= old('topik') ?>" placeholder="Misal: Ketersediaan ukuran Sepatu Sneakers Urban" required>
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label fw-medium">Pesan</label>
          <textarea id="pesan" name="pesan" rows="4" class="form-control" placeholder="Tuliskan pertanyaan Anda..." required><?= old('pesan') ?></textarea>
        </div>
        <button type="submit" class="btn btn-cta px-4">Kirim Pesan</button>
      </form>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="surface-card p-4">
      <h2 class="h5 fw-bold mb-3">Informasi Layanan Pelanggan</h2>
      <p class="mb-2"><strong>Jam Operasional:</strong> Senin–Sabtu, 08.00–17.00 WIB</p>
      <p class="mb-2"><strong>Email Dukungan:</strong> support@shopease.test</p>
      <p class="mb-0"><strong>Lokasi Gudang:</strong> Sukolilo, Surabaya</p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
