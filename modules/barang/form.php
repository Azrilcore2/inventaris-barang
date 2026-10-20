<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../helper/fungsi.php';
require_login();

$edit_mode = false;
$barang = [
    'id_barang' => '',
    'nama_barang' => '',
    'kategori' => '',
    'jumlah' => '',
    'lokasi' => '',
    'tanggal_masuk' => date('Y-m-d')
];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id_barang = $id");
    if (mysqli_num_rows($cek) > 0) {
        $barang = mysqli_fetch_assoc($cek);
        $edit_mode = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit_mode ? 'Edit' : 'Tambah' ?> Barang — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css">
</head>
<body>
<div class="wrapper">

    <?php $base = '../../'; include __DIR__ . '/../../partials/sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div>
                <span class="eyebrow"><?= $edit_mode ? 'Ubah Catatan' : 'Catatan Baru' ?></span>
                <h1><?= $edit_mode ? 'Edit Barang' : 'Tambah Barang' ?></h1>
            </div>
        </div>

        <div class="panel" style="max-width:640px;">
            <div class="panel-body">
                <form method="POST" action="proses.php">
                    <input type="hidden" name="aksi" value="<?= $edit_mode ? 'edit' : 'tambah' ?>">
                    <?php if ($edit_mode): ?>
                        <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']) ?>" placeholder="Contoh: Laptop Asus X441" required>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" value="<?= htmlspecialchars($barang['kategori']) ?>" placeholder="Contoh: Elektronik" required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" min="0" value="<?= htmlspecialchars($barang['jumlah']) ?>" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" value="<?= htmlspecialchars($barang['lokasi']) ?>" placeholder="Contoh: Gudang A" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" value="<?= htmlspecialchars($barang['tanggal_masuk']) ?>" required>
                        </div>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary"><?= $edit_mode ? 'Simpan Perubahan' : 'Simpan Barang' ?></button>
                        <a href="../../index.php?module=barang" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
