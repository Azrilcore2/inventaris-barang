<?php
$current_module = isset($_GET['module']) ? $_GET['module'] : 'dashboard';
$current_aksi   = $_GET['aksi'] ?? '';
// $base bisa di-set oleh file pemanggil jika diakses dari dalam folder modules/*
$base = isset($base) ? $base : '';
?>
<div class="sidebar">
    <div class="brand">
        <span class="mark">IP</span>
        <span class="title">InventarisPro</span>
        <span class="subtitle">Sistem Inventaris Barang</span>
    </div>
    <nav>
        <span class="nav-label">Menu Utama</span>
        <a href="<?= $base ?>index.php?module=dashboard" class="<?= $current_module == 'dashboard' ? 'active' : '' ?>">
            <span class="ico">▦</span> Dashboard
        </a>
        <a href="<?= $base ?>index.php?module=barang" class="<?= ($current_module == 'barang' && $current_aksi != 'laporan') ? 'active' : '' ?>">
            <span class="ico">▤</span> Data Barang
        </a>
        <a href="<?= $base ?>index.php?module=barang&aksi=laporan" class="<?= ($current_module == 'barang' && $current_aksi == 'laporan') ? 'active' : '' ?>">
            <span class="ico">▥</span> Laporan
        </a>
        <a href="<?= $base ?>index.php?module=databaru" class="<?= $current_module == 'databaru' ? 'active' : '' ?>">
            <span class="ico">▥</span> Menu Baru
        </a>
        <div class="logout">
            <a href="<?= $base ?>modules/auth/proses.php?aksi=logout">
                <span class="ico">⏻</span> Keluar
            </a>
        </div>
    </nav>
</div>
