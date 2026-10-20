<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventarisPro — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/landing.css">
</head>
<body>

    <div class="bg-grid"></div>

    <nav class="landing-nav">
        <div class="logo"><span class="mark">IP</span> InventarisPro</div>
        <div class="toggle-mode" id="toggleMode">
            <span class="toggle-label" id="toggleLabel">Mode Siang</span>
            <div class="switch"><div class="knob"></div></div>
        </div>
    </nav>

    <section class="hero">
        <span class="eyebrow">Status Gudang — Online</span>
        <h1>Setiap barang punya<br>tempat dan <span class="accent">catatannya sendiri.</span></h1>
        <p class="lead">InventarisPro mencatat keluar masuk barang, lokasi rak, dan jumlah stok secara langsung — supaya tidak ada lagi barang yang hilang dari pencatatan.</p>

        <div class="hero-actions">
            <a href="index.php?module=dashboard">
                <button class="btn-enter">Masuk Aplikasi <span class="arrow">→</span></button>
            </a>
            <a href="modules/auth/register.php" class="link-ghost">Daftar akun baru</a>
        </div>

        <div class="manifest-strip">
            <div class="manifest-track">
                <span>NAMA BARANG</span>
                <span>KATEGORI</span>
                <span>JUMLAH STOK</span>
                <span>LOKASI RAK</span>
                <span>TANGGAL MASUK</span>
                <span>NAMA BARANG</span>
                <span>KATEGORI</span>
                <span>JUMLAH STOK</span>
                <span>LOKASI RAK</span>
                <span>TANGGAL MASUK</span>
            </div>
        </div>
    </section>

    <section class="fitur-section">
        <div class="section-head">
            <span class="num">FITUR / 01–04</span>
            <h2>Apa yang bisa dilakukan</h2>
        </div>
        <div class="fitur-grid">
            <div class="fitur-card">
                <span class="tag">01 — DATA</span>
                <h3>Tambah & Edit Barang</h3>
                <p>Catat nama, kategori, jumlah, dan lokasi barang dalam satu form sederhana.</p>
            </div>
            <div class="fitur-card">
                <span class="tag">02 — CARI</span>
                <h3>Pencarian Cepat</h3>
                <p>Temukan barang berdasarkan nama, kategori, atau lokasi gudang dalam hitungan detik.</p>
            </div>
            <div class="fitur-card">
                <span class="tag">03 — LAPORAN</span>
                <h3>Laporan Stok</h3>
                <p>Lihat rekap total stok per kategori untuk memantau ketersediaan barang.</p>
            </div>
            <div class="fitur-card">
                <span class="tag">04 — AKSES</span>
                <h3>Login Aman</h3>
                <p>Setiap petugas masuk dengan akun sendiri, password tersimpan terenkripsi.</p>
            </div>
        </div>
    </section>

    <footer class="landing-footer">
        <span>© 2026 InventarisPro</span>
        <span>Sistem Manajemen Inventaris Barang</span>
    </footer>

    <script src="<?= $BASE_URL ?>assets/js/landing.js"></script>
</body>
</html>
