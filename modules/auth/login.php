<?php
// Saat diakses via router (index.php?module=auth), variabel $koneksi sudah tersedia.
// Saat diakses langsung, pastikan dependency tetap dimuat.
if (!isset($koneksi)) {
    require_once __DIR__ . '/../../config/koneksi.php';
    require_once __DIR__ . '/../../helper/fungsi.php';
}

if (is_login()) {
    redirect('dashboard');
}

// Tentukan base path: kosong jika via router, '../../' jika diakses langsung
$diakses_langsung = basename($_SERVER['SCRIPT_NAME']) == 'login.php';
$base = $diakses_langsung ? '../../' : '';
$base_auth = $diakses_langsung ? '' : 'modules/auth/';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-grid-lines"></div>
    <div class="auth-box">
        <span class="mark">IP</span>
        <h2>Masuk ke InventarisPro</h2>
        <p class="subtitle">Kelola data barang, stok, dan lokasi gudang Anda.</p>

        <?php show_flash(); ?>

        <form id="formLogin" method="POST" action="<?= $base_auth ?>proses.php">
            <input type="hidden" name="aksi" value="login">

            <div class="form-group">
                <label>Email</label>
                <input type="text" id="identitas" name="identitas" placeholder="nama@email.com">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>

        <div class="auth-links">
            <a href="<?= $base_auth ?>forgot_password.php">Lupa password?</a>
            &nbsp;·&nbsp;
            <a href="<?= $base_auth ?>register.php">Daftar akun baru</a>
            <span class="back-link"><a href="<?= $base ?>index.php">← Kembali ke beranda</a></span>
        </div>
    </div>
</div>

<script src="<?= $BASE_URL ?>assets/js/auth.js"></script>
</body>
</html>
