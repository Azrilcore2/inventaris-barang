<?php
require_login();

$total_barang   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_barang"))['total'];
$total_stok     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM tbl_barang"))['total'];
$total_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT kategori) as total FROM tbl_barang"))['total'];
$total_lokasi   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT lokasi) as total FROM tbl_barang"))['total'];

$barang_terbaru = mysqli_query($koneksi, "SELECT * FROM tbl_barang ORDER BY tanggal_masuk DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css?v=5">
</head>
<body>
<div class="wrapper">

    <?php include __DIR__ . '/../../partials/sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div>
                <span class="eyebrow">Ringkasan Gudang</span>
                <h1>Dashboard</h1>
            </div>
            <div class="user-info">👤 <?= htmlspecialchars($_SESSION['nama_user']) ?></div>
        </div>

        <?php show_flash(); ?>

        <div class="card-grid">
            <div class="card" style="--accent:#FF6A39">
                <span class="card-label">Total Jenis Barang</span>
                <span class="card-value"><?= $total_barang ?></span>
            </div>
            <div class="card" style="--accent:#2D8C6F">
                <span class="card-label">Total Stok Barang</span>
                <span class="card-value"><?= $total_stok ?: 0 ?><span class="card-unit">unit</span></span>
            </div>
            <div class="card" style="--accent:#14171C">
                <span class="card-label">Jumlah Kategori</span>
                <span class="card-value"><?= $total_kategori ?></span>
            </div>
            <div class="card" style="--accent:#8A8F98">
                <span class="card-label">Lokasi Gudang</span>
                <span class="card-value"><?= $total_lokasi ?></span>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h2>Barang Masuk Terbaru</h2>
                <a href="index.php?module=barang" class="btn btn-secondary btn-sm">Lihat Semua →</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Lokasi</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($barang_terbaru) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($barang_terbaru)): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_barang']) ?></strong></td>
                                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                                    <td><span class="qty-badge <?= $row['jumlah'] < 5 ? 'low' : 'ok' ?>"><?= $row['jumlah'] ?></span></td>
                                    <td><?= htmlspecialchars($row['lokasi']) ?></td>
                                    <td><?= format_tanggal($row['tanggal_masuk']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5"><div class="empty-state"><div class="ico">📦</div><p>Belum ada data barang</p></div></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
