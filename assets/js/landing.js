/**
 * landing.js
 * Toggle Mode Siang / Malam - Vanilla JS
 */

document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const toggle = document.getElementById('toggleMode');
    const label = document.getElementById('toggleLabel');

    const savedMode = localStorage.getItem('inventaris_mode');
    if (savedMode === 'dark') {
        body.classList.add('dark-mode');
        if (label) label.textContent = 'Mode Malam';
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('inventaris_mode', isDark ? 'dark' : 'light');
            if (label) {
                label.textContent = isDark ? 'Mode Malam' : 'Mode Siang';
            }
        });
    }
});
