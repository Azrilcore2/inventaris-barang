/**
 * barang.js
 * Konfirmasi hapus data barang - Vanilla JS
 */

document.addEventListener('DOMContentLoaded', function () {
    const tombolHapus = document.querySelectorAll('.btn-hapus-barang');

    tombolHapus.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            const konfirmasi = confirm('Apakah Anda yakin ingin menghapus barang ini?');
            if (!konfirmasi) {
                e.preventDefault();
            }
        });
    });
});
