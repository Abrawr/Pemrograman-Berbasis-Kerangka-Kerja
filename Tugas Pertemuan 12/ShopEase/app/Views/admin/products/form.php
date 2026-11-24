<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="surface-card p-4">
      <h2 class="h5 fw-bold mb-3"><?= esc($title) ?></h2>
      <form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row g-3">
          <div class="col-md-4">
            <label for="sku" class="form-label fw-medium">SKU</label>
            <input type="text" id="sku" name="sku" class="form-control se-mono" value="<?= old('sku', $product['sku'] ?? '') ?>" placeholder="SE-EL-999" required>
          </div>
          <div class="col-md-8">
            <label for="name" class="form-label fw-medium">Nama Produk</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $product['name'] ?? '') ?>" required>
          </div>
          <div class="col-md-6">
            <label for="category_id" class="form-label fw-medium">Kategori</label>
            <?php $cid = (int) old('category_id', $product['category_id'] ?? ($categories[0]['id'] ?? 1)); ?>
            <select id="category_id" name="category_id" class="form-select" required>
              <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $cid === (int) $c['id'] ? 'selected' : '' ?>><?= esc($c['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="price" class="form-label fw-medium">Harga (Rp)</label>
            <input type="number" id="price" name="price" min="1000" class="form-control tabular-nums" value="<?= old('price', $product['price'] ?? 150000) ?>" required>
          </div>
          <div class="col-md-3">
            <label for="original_price" class="form-label fw-medium">Harga Coret</label>
            <input type="number" id="original_price" name="original_price" min="0" class="form-control tabular-nums" value="<?= old('original_price', $product['original_price'] ?? '') ?>">
          </div>
          <div class="col-md-4">
            <label for="stock" class="form-label fw-medium">Stok</label>
            <input type="number" id="stock" name="stock" min="0" class="form-control tabular-nums" value="<?= old('stock', $product['stock'] ?? 10) ?>" required>
          </div>
          <div class="col-md-4">
            <label for="status" class="form-label fw-medium">Status</label>
            <?php $st = old('status', $product['status'] ?? 'tersedia'); ?>
            <select id="status" name="status" class="form-select">
              <option value="tersedia" <?= $st === 'tersedia' ? 'selected' : '' ?>>tersedia</option>
              <option value="tidak_tersedia" <?= $st === 'tidak_tersedia' ? 'selected' : '' ?>>tidak_tersedia</option>
            </select>
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" <?= old('featured', $product['featured'] ?? 0) ? 'checked' : '' ?>>
              <label class="form-check-label" for="featured">Produk Unggulan</label>
            </div>
          </div>
          <div class="col-12">
            <label for="short_desc" class="form-label fw-medium">Ringkasan Singkat</label>
            <input type="text" id="short_desc" name="short_desc" class="form-control" value="<?= old('short_desc', $product['short_desc'] ?? '') ?>" placeholder="Ringkasan 1 kalimat pada kartu produk">
          </div>
          <div class="col-12">
            <label for="description" class="form-label fw-medium">Deskripsi Lengkap</label>
            <textarea id="description" name="description" rows="3" class="form-control"><?= old('description', $product['description'] ?? '') ?></textarea>
          </div>
          <div class="col-12">
            <label for="images" class="form-label fw-medium">Unggah Gambar Produk (PNG/JPG/WEBP, maks. 2 MB, hingga 6 gambar)</label>
            <input type="file" id="images" name="images[]" class="form-control" accept="image/png,image/jpeg,image/webp" multiple onchange="previewSelectedImages(this)">
            <div id="uploadPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
          </div>
        </div>
        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn btn-cta">Simpan Produk</button>
          <a href="<?= site_url('admin/products') ?>" class="btn btn-outline-dark">Kembali</a>
        </div>
      </form>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="surface-card p-4">
      <h3 class="h6 fw-bold mb-3">Galeri Gambar Tersimpan</h3>
      <?php if (empty($images)): ?>
        <div class="text-secondary small py-4 text-center border rounded bg-light">
          Belum ada gambar tersimpan. Unggah gambar melalui form di sebelah kiri.
        </div>
      <?php else: ?>
        <div class="row g-3">
          <?php foreach ($images as $img): ?>
            <div class="col-6">
              <div class="border rounded p-2 h-100 d-flex flex-column justify-content-between bg-light-subtle">
                <div class="text-center mb-2">
                  <img src="<?= base_url($img['image_path']) ?>" alt="Gambar produk" class="img-fluid rounded" style="max-height: 110px; object-fit: contain;">
                </div>
                <div>
                  <?php if ((int) $img['is_primary'] === 1): ?>
                    <span class="badge text-bg-success w-100 mb-1">Gambar Utama</span>
                  <?php else: ?>
                    <form action="<?= site_url('admin/products/' . $product['id'] . '/images/' . $img['id'] . '/primary') ?>" method="post" class="d-grid mb-1">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-outline-dark">Jadikan Utama</button>
                    </form>
                  <?php endif; ?>

                  <?php if (session()->get('user_role') === 'admin'): ?>
                    <form action="<?= site_url('admin/products/' . $product['id'] . '/images/' . $img['id'] . '/delete') ?>" method="post" class="d-grid" onsubmit="return confirm('Hapus gambar ini?')">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
function previewSelectedImages(input) {
  const container = document.getElementById('uploadPreview');
  container.innerHTML = '';
  Array.from(input.files || []).forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      const img = document.createElement('img');
      img.src = e.target.result;
      img.alt = file.name;
      img.style.cssText = 'width:76px;height:60px;object-fit:contain;border:1px solid #DFE4DE;border-radius:6px;padding:3px;background:#fff;';
      container.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
}
</script>

<?= $this->endSection() ?>
