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
    <title>Lupa Password — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-grid-lines"></div>
    <div class="auth-box">
        <span class="mark">IP</span>
        <h2>Lupa Password</h2>
        <p class="subtitle">Masukkan email terdaftar Anda. Kami akan membuatkan link reset password (simulasi).</p>

        <?php show_flash(); ?>

        <form id="formForgot" method="POST" action="proses.php">
            <input type="hidden" name="aksi" value="lupa_password">

            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com">
            </div>

            <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
        </form>

        <div class="auth-links">
            <span class="back-link"><a href="login.php">← Kembali ke login</a></span>
        </div>
    </div>
</div>

<script src="<?= $BASE_URL ?>assets/js/auth.js"></script>
</body>
</html>
