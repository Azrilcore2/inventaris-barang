<?php
/**
 * Helper / Fungsi Umum
 * Sistem Inventaris Barang
 */

// Mulai session jika belum ada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Bersihkan input dari karakter berbahaya sebelum dipakai di query SQL.
// Catatan: TIDAK memakai htmlspecialchars() di sini — itu tugas saat MENAMPILKAN
// data (lihat pemakaian htmlspecialchars() di setiap view), bukan saat menyimpan.
// Jika di-escape ganda di sini, data di database akan rusak (contoh: "&" jadi "&amp;").
function clean($data)
{
    global $koneksi;
    return mysqli_real_escape_string($koneksi, trim($data));
}

// Base URL absolut dari root aplikasi (menghindari 404 saat redirect dari subfolder modules/)
function base_url($path = '')
{
    $script = $_SERVER['SCRIPT_NAME']; // contoh: /inventaris/modules/auth/proses.php atau /inventaris/index.php
    $dir    = str_replace('\\', '/', dirname($script)); // contoh: /inventaris/modules/auth

    // Naik satu level untuk setiap subfolder dikenal (modules/<nama>, config, helper, partials)
    $dir = preg_replace('#/(modules/[^/]+|config|helper|partials)$#', '', $dir);

    $root = rtrim($dir, '/') . '/';
    return $root . $path;
}

// Redirect ke halaman/module lain (selalu absolut, aman dipanggil dari subfolder manapun)
function redirect($module, $params = '')
{
    $url = base_url("index.php?module=" . $module);
    if ($params != '') {
        $url .= "&" . $params;
    }
    header("Location: " . $url);
    exit;
}

// Format tanggal Indonesia
function format_tanggal($tanggal)
{
    $bulan = [
        1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
        5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
        9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
    ];
    $pecah = explode("-", $tanggal);
    if (count($pecah) !== 3) return $tanggal;
    return $pecah[2] . " " . $bulan[(int)$pecah[1]] . " " . $pecah[0];
}

// Cek apakah user sudah login
function is_login()
{
    return isset($_SESSION['id_user']);
}

// Wajib login, jika belum maka redirect ke auth
function require_login()
{
    if (!is_login()) {
        redirect('auth');
    }
}

// Tampilkan pesan alert sederhana (flash message)
function set_flash($tipe, $pesan)
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function show_flash()
{
    if (isset($_SESSION['flash'])) {
        $tipe  = $_SESSION['flash']['tipe'];
        $pesan = $_SESSION['flash']['pesan'];
        $kelas = $tipe == 'success' ? 'success' : 'error';
        $ikon  = $tipe == 'success' ? '✓' : '⚠';
        echo "<div class='flash {$kelas}'><span>{$ikon}</span> {$pesan}</div>";
        unset($_SESSION['flash']);
    }
}

// Generate ID otomatis berformat (contoh: BRG-0001)
function generate_id($koneksi, $tabel, $kolom, $prefix)
{
    $query = mysqli_query($koneksi, "SELECT {$kolom} FROM {$tabel} ORDER BY {$kolom} DESC LIMIT 1");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $angka = (int) substr($row[$kolom], strlen($prefix));
        $angka++;
    } else {
        $angka = 1;
    }
    return $prefix . sprintf("%04d", $angka);
}
?>
