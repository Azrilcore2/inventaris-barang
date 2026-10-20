<?php
require_login();

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
$keyword = isset($_GET['cari']) ? clean($_GET['cari']) : '';

if ($keyword != '') {
    $sql = "SELECT * FROM tbl_barang WHERE nama_barang LIKE '%$keyword%' 
            OR kategori LIKE '%$keyword%' OR lokasi LIKE '%$keyword%' 
            ORDER BY tanggal_masuk DESC";
} else {
    $sql = "SELECT * FROM tbl_barang ORDER BY tanggal_masuk DESC";
}
$data_barang = mysqli_query($koneksi, $sql);

$laporan = mysqli_query($koneksi, "SELECT kategori, COUNT(*) as jenis, SUM(jumlah) as total_stok 
                                    FROM tbl_barang GROUP BY kategori ORDER BY kategori ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $aksi == 'laporan' ? 'Laporan Stok' : 'Data Barang' ?> — Sistem Inventaris Barang</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/style.css?v=4">
</head>
<body>
<div class="wrapper">

    <?php include __DIR__ . '/../../partials/sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div>
                <span class="eyebrow"><?= $aksi == 'laporan' ? 'Rekap Kategori' : 'Manajemen Barang' ?></span>
                <h1><?= $aksi == 'laporan' ? 'Laporan Stok Barang' : 'Data Barang' ?></h1>
            </div>
            <div class="user-info">👤 <?= htmlspecialchars($_SESSION['nama_user']) ?></div>
        </div>

        <?php show_flash(); ?>

        <?php if ($aksi == 'laporan'): ?>

            <div class="panel">
                <div class="panel-header">
                    <h2>Rekap Stok per Kategori</h2>
                    <a href="index.php?module=barang" class="btn btn-secondary btn-sm">← Kembali</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jumlah Jenis</th>
                                <th>Total Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($laporan) > 0): ?>
                                <?php while ($l = mysqli_fetch_assoc($laporan)): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($l['kategori']) ?></strong></td>
                                        <td><?= $l['jenis'] ?> jenis</td>
                                        <td><span class="qty-badge ok"><?= $l['total_stok'] ?> unit</span></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="3"><div class="empty-state"><div class="ico">📊</div><p>Belum ada data untuk direkap</p></div></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php else: ?>

            <div class="panel">
                <div class="panel-header">
                    <h2>Daftar Barang</h2>
                    <div style="display:flex; gap:10px; flex-wrap:wrap;">
                        <form method="GET" action="index.php" class="search-box">
                            <input type="hidden" name="module" value="barang">
                            <input type="text" name="cari" placeholder="Cari nama, kategori, lokasi..." value="<?= htmlspecialchars($keyword) ?>">
                            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
                        </form>
                        <a href="modules/barang/form.php" class="btn btn-primary">+ Tambah Barang</a>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Lokasi</th>
                                <th>Tgl Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($data_barang) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($data_barang)): ?>
                                    <tr>
                                        <td><span class="id-tag">BRG-<?= sprintf('%04d', $row['id_barang']) ?></span></td>
                                        <td><strong><?= htmlspecialchars($row['nama_barang']) ?></strong></td>
                                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                                        <td><span class="qty-badge <?= $row['jumlah'] < 5 ? 'low' : 'ok' ?>"><?= $row['jumlah'] ?></span></td>
                                        <td><?= htmlspecialchars($row['lokasi']) ?></td>
                                        <td><?= format_tanggal($row['tanggal_masuk']) ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="modules/barang/form.php?id=<?= $row['id_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="modules/barang/proses.php?aksi=hapus&id=<?= $row['id_barang'] ?>" class="btn btn-danger btn-sm btn-hapus-barang">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="7"><div class="empty-state"><div class="ico">🔍</div><p>Barang tidak ditemukan</p></div></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<script src="<?= $BASE_URL ?>assets/js/barang.js"></script>
</body>
</html>
