<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../helper/fungsi.php';

if (is_login()) {
    redirect('dashboard');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-grid-lines"></div>
    <div class="auth-box">
        <span class="mark">IP</span>
        <h2>Buat Akun Baru</h2>
        <p class="subtitle">Daftar untuk mulai mencatat dan mengelola inventaris barang.</p>

        <?php show_flash(); ?>

        <form id="formRegister" method="POST" action="proses.php">
            <input type="hidden" name="aksi" value="register">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Nama lengkap Anda">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Minimal 6 karakter">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
        </form>

        <div class="auth-links">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
            <span class="back-link"><a href="../../index.php">← Kembali ke beranda</a></span>
        </div>
    </div>
</div>

<script src="<?= $BASE_URL ?>assets/js/auth.js"></script>
</body>
</html>
