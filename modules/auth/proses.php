<?php
require_once __DIR__ . '/../../config/koneksi.php';
require_once __DIR__ . '/../../helper/fungsi.php';

$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : (isset($_GET['aksi']) ? $_GET['aksi'] : '');

switch ($aksi) {

    // ===================== LOGIN =====================
    case 'login':
        $identitas = clean($_POST['identitas'] ?? '');
        $password  = $_POST['password'] ?? '';

        if ($identitas == '' || $password == '') {
            set_flash('error', 'Email dan password wajib diisi.');
            redirect('auth');
        }

        $sql   = "SELECT * FROM tbl_user WHERE email = '$identitas' LIMIT 1";
        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil && mysqli_num_rows($hasil) > 0) {
            $user = mysqli_fetch_assoc($hasil);

            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['id_user']   = $user['id_user'];
                $_SESSION['nama_user'] = $user['nama'];
                $_SESSION['email']     = $user['email'];

                redirect('dashboard');
            }

            set_flash('error', 'Password salah.');
            redirect('auth');
        }

        set_flash('error', 'Email tidak ditemukan.');
        redirect('auth');
        break;

    // ===================== REGISTER =====================
    case 'register':
        $nama       = clean($_POST['nama'] ?? '');
        $email      = clean($_POST['email'] ?? '');
        $password   = $_POST['password'] ?? '';
        $konfirmasi = $_POST['konfirmasi_password'] ?? '';

        if ($nama == '' || $email == '' || $password == '' || $konfirmasi == '') {
            set_flash('error', 'Semua field wajib diisi.');
            header('Location: register.php');
            exit;
        }

        if (strlen($password) < 6) {
            set_flash('error', 'Password minimal 6 karakter.');
            header('Location: register.php');
            exit;
        }

        if ($password !== $konfirmasi) {
            set_flash('error', 'Konfirmasi password tidak sama.');
            header('Location: register.php');
            exit;
        }

        $cek_email = mysqli_query($koneksi, "SELECT id_user FROM tbl_user WHERE email = '$email'");
        if ($cek_email && mysqli_num_rows($cek_email) > 0) {
            set_flash('error', 'Email sudah terdaftar, silakan gunakan email lain.');
            header('Location: register.php');
            exit;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tbl_user (nama, email, password_hash) VALUES ('$nama', '$email', '$password_hash')";

        if (mysqli_query($koneksi, $sql)) {
            set_flash('success', 'Pendaftaran berhasil! Silakan masuk dengan akun Anda.');
            header('Location: login.php');
        } else {
            set_flash('error', 'Gagal mendaftar. Silakan coba lagi.');
            header('Location: register.php');
        }
        exit;
        break;

    // ===================== LUPA PASSWORD (SIMULASI) =====================
    case 'lupa_password':
        $email = clean($_POST['email'] ?? '');

        $cek = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email = '$email'");
        if ($cek && mysqli_num_rows($cek) > 0) {
            // Simulasi: token dibuat untuk demonstrasi, tidak benar-benar mengirim email.
            // Pada implementasi nyata, simpan token ini ke DB dengan masa berlaku,
            // lalu kirim link melalui layanan email (PHPMailer/SMTP).
            $token = bin2hex(random_bytes(16));
            set_flash('success', "Link reset password (simulasi) telah dibuat. Token: {$token}");
        } else {
            set_flash('error', 'Email tidak ditemukan dalam sistem.');
        }
        header('Location: forgot_password.php');
        exit;
        break;

    // ===================== LOGOUT =====================
    case 'logout':
        session_unset();
        session_destroy();
        session_start();
        redirect('auth');
        break;

    default:
        redirect('auth');
        break;
}
