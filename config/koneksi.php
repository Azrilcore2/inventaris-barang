<?php
/**
 * Konfigurasi & Koneksi Database
 * Sistem Inventaris Barang
 *
 * Database 1 (default) : db_inventaris
 * Database 2           : databaru
 * SQL File             : databaru.sql
 */

$host   = "localhost";
$user   = "root";
$pass   = "";

// Database default (koneksi utama)
$koneksi = mysqli_connect($host, $user, $pass, "db_inventaris");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");

// Alias nama database agar mudah dipanggil di query
$db1 = "db_inventaris";   // pakai: $db1.nama_tabel
$db2 = "db_menubaru";        // pakai: $db2.nama_tabel

// Base URL otomatis mengarah ke folder inventaris
// Bekerja baik diakses via router (index.php) maupun langsung
$protocol  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host_name = $_SERVER['HTTP_HOST'];
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Cari posisi folder "inventaris" di path
$parts = explode('/', trim($script_dir, '/'));
$base_parts = [];
foreach ($parts as $part) {
    $base_parts[] = $part;
    if ($part === 'inventaris') break;
}
$BASE_URL = $protocol . '://' . $host_name . '/' . implode('/', $base_parts) . '/';

/*
 * ============================================================
 *  CARA PAKAI DI FILE LAIN:
 * ============================================================
 *
 *  include "koneksi.php";
 *
 *  // Query ke db_inventaris (database default)
 *  $hasil = mysqli_query($koneksi, "SELECT * FROM nama_tabel");
 *
 *  // Query ke databaru
 *  $hasil = mysqli_query($koneksi, "SELECT * FROM $db2.databaru");
 *
 *  // JOIN kedua database sekaligus
 *  $hasil = mysqli_query($koneksi, "
 *      SELECT a.*, b.nama_barang
 *      FROM $db1.nama_tabel a
 *      JOIN $db2.databaru b ON a.id = b.id_barang
 *  ");
 * ============================================================
 */