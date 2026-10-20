<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../helper/fungsi.php';
require_login();

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : (isset($_POST['aksi']) ? $_POST['aksi'] : '');

switch ($aksi) {

    case 'tambah':
        $nama_barang   = clean($_POST['nama_barang']);
        $kategori      = clean($_POST['kategori']);
        $jumlah        = (int) $_POST['jumlah'];
        $lokasi        = clean($_POST['lokasi']);
        $tanggal_masuk = clean($_POST['tanggal_masuk']);

        $sql = "INSERT INTO tbl_barang (nama_barang, kategori, jumlah, lokasi, tanggal_masuk)
                VALUES ('$nama_barang', '$kategori', $jumlah, '$lokasi', '$tanggal_masuk')";

        if (mysqli_query($koneksi, $sql)) {
            set_flash('success', 'Barang berhasil ditambahkan.');
        } else {
            set_flash('error', 'Gagal menambahkan barang: ' . mysqli_error($koneksi));
        }
        redirect('barang');
        break;

    case 'edit':
        $id_barang     = (int) $_POST['id_barang'];
        $nama_barang   = clean($_POST['nama_barang']);
        $kategori      = clean($_POST['kategori']);
        $jumlah        = (int) $_POST['jumlah'];
        $lokasi        = clean($_POST['lokasi']);
        $tanggal_masuk = clean($_POST['tanggal_masuk']);

        $sql = "UPDATE tbl_barang SET 
                    nama_barang = '$nama_barang',
                    kategori = '$kategori',
                    jumlah = $jumlah,
                    lokasi = '$lokasi',
                    tanggal_masuk = '$tanggal_masuk'
                WHERE id_barang = $id_barang";

        if (mysqli_query($koneksi, $sql)) {
            set_flash('success', 'Data barang berhasil diperbarui.');
        } else {
            set_flash('error', 'Gagal memperbarui barang: ' . mysqli_error($koneksi));
        }
        redirect('barang');
        break;

    case 'hapus':
        $id_barang = (int) $_GET['id'];
        $sql = "DELETE FROM tbl_barang WHERE id_barang = $id_barang";

        if (mysqli_query($koneksi, $sql)) {
            set_flash('success', 'Barang berhasil dihapus.');
        } else {
            set_flash('error', 'Gagal menghapus barang: ' . mysqli_error($koneksi));
        }
        redirect('barang');
        break;

    default:
        redirect('barang');
        break;
}
?>
