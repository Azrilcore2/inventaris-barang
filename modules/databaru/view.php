<?php
require_login();

$total_barang   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM $db2.databaru"))['total'];
$total_stok     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(stok) as total FROM $db2.databaru"))['total'];
$total_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT kategori) as total FROM $db2.databaru"))['total'];
$total_habis    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM $db2.databaru WHERE status = 'Habis'"))['total'];

$barang_terbaru = mysqli_query($koneksi, "SELECT * FROM $db2.databaru ORDER BY tanggal_masuk DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Data Barang Baru</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css?v=3">
</head>
<body>
<div class="wrapper">

    <?php include __DIR__ . '/../../partials/sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div>
                <span class="eyebrow">Ringkasan Data Barang</span>
                <h1> DATA BARU</h1>
            </div>
            <div class="user-info">👤 <?= htmlspecialchars($_SESSION['nama_user']) ?></div>
        </div>

        <?php show_flash(); ?>

        <div class="panel">
            <div class="panel-header">
                <h2>Menu Barang Terbaru</h2>
                <a href="index.php?module=databaru" class="btn btn-secondary btn-sm">Lihat Semua →</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($barang_terbaru) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($barang_terbaru)): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['nama_barang']) ?></strong></td>
                                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                                    <td>
                                        <span class="qty-badge <?= $row['stok'] < 5 ? 'low' : 'ok' ?>">
                                            <?= $row['stok'] ?> <?= htmlspecialchars($row['satuan']) ?>
                                        </span>
                                    </td>
                                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php
                                            $status_class = match($row['status']) {
                                                'Tersedia' => 'ok',
                                                'Terbatas' => 'low',
                                                'Habis'    => 'empty',
                                                default    => ''
                                            };
                                        ?>
                                        <span class="qty-badge <?= $status_class ?>">
                                            <?= $row['status'] ?>
                                        </span>
                                    </td>
                                    <td><?= format_tanggal($row['tanggal_masuk']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6"><div class="empty-state"><div class="ico">📦</div><p>Belum ada data barang</p></div></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>