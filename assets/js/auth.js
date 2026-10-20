/**
 * auth.js
 * Validasi Form Login / Register / Forgot Password - Vanilla JS
 */

document.addEventListener('DOMContentLoaded', function () {

    function showError(el, msg) {
        clearError(el);
        const span = document.createElement('span');
        span.className = 'error-text';
        span.textContent = msg;
        el.parentNode.appendChild(span);
        el.style.borderColor = '#e74c3c';
    }

    function clearError(el) {
        el.style.borderColor = '#dcdfe6';
        const existing = el.parentNode.querySelector('.error-text');
        if (existing) existing.remove();
    }

    // ===== Validasi Form Login =====
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', function (e) {
            let valid = true;
            const identitas = document.getElementById('identitas');
            const password = document.getElementById('password');

            if (identitas.value.trim() === '') {
                showError(identitas, 'Username/Email wajib diisi');
                valid = false;
            } else {
                clearError(identitas);
            }

            if (password.value.trim() === '') {
                showError(password, 'Password wajib diisi');
                valid = false;
            } else {
                clearError(password);
            }

            if (!valid) e.preventDefault();
        });
    }

    // ===== Validasi Form Register =====
    const formRegister = document.getElementById('formRegister');
    if (formRegister) {
        formRegister.addEventListener('submit', function (e) {
            let valid = true;
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const konfirmasi = document.getElementById('konfirmasi_password');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nama.value.trim().length < 3) {
                showError(nama, 'Nama lengkap minimal 3 karakter');
                valid = false;
            } else {
                clearError(nama);
            }

            if (!emailRegex.test(email.value.trim())) {
                showError(email, 'Format email tidak valid');
                valid = false;
            } else {
                clearError(email);
            }

            if (password.value.trim().length < 6) {
                showError(password, 'Password minimal 6 karakter');
                valid = false;
            } else {
                clearError(password);
            }

            if (konfirmasi.value !== password.value) {
                showError(konfirmasi, 'Konfirmasi password tidak sama');
                valid = false;
            } else {
                clearError(konfirmasi);
            }

            if (!valid) e.preventDefault();
        });
    }

    // ===== Validasi Form Forgot Password =====
    const formForgot = document.getElementById('formForgot');
    if (formForgot) {
        formForgot.addEventListener('submit', function (e) {
            let valid = true;
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email.value.trim())) {
                showError(email, 'Masukkan email yang valid');
                valid = false;
            } else {
                clearError(email);
            }

            if (!valid) e.preventDefault();
        });
    }
});
