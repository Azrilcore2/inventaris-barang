<?php
/**
 * index.php
 * Router utama Sistem Inventaris Barang
 */

require_once 'config/koneksi.php';
require_once 'helper/fungsi.php';

$page = isset($_GET['module']) ? $_GET['module'] : 'landing';

switch ($page) {
    case 'landing':
        include 'modules/landing/view.php';
        break;

    case 'barang':
        include 'modules/barang/view.php';
        break;

    case 'dashboard':
        include 'modules/dashboard/view.php';
        break;

    case 'auth':
        include 'modules/auth/login.php';
        break;

    case 'databaru':
        include 'modules/databaru/view.php';
        break;

    default:
        include 'modules/landing/view.php';
        break;
}
