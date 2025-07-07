import axios from 'axios';
import { Modal } from 'bootstrap';

// MATA-MATA #1: Pastikan script ini berjalan.
console.log('✅ Popup script loaded!');

document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi Modal
    const authModalElement = document.getElementById('authModal');
    // MATA-MATA #2: Cek apakah elemen modal ditemukan.
    console.log('Modal element:', authModalElement);
    
    if (!authModalElement) return;
    const authModal = new Modal(authModalElement);

    // Ambil link Login dan Register dari Navbar
    const loginLink = document.querySelector('a.nav-link[href*="/login"]');
    const registerLink = document.querySelector('a.nav-link[href*="/register"]');
    
    // MATA-MATA #3: Cek apakah link login ditemukan.
    console.log('Login link element:', loginLink);
    
    // Fungsi untuk menampilkan pesan error
    const displayErrors = (errorContainerId, errors) => {
        // ... (kode ini tidak berubah)
        const errorContainer = document.getElementById(errorContainerId);
        errorContainer.innerHTML = '';
        if (errors) {
            let errorHtml = '<ul class="alert alert-danger p-2 ps-4">';
            for (const key in errors) {
                errors[key].forEach(message => {
                    errorHtml += `<li>${message}</li>`;
                });
            }
            errorHtml += '</ul>';
            errorContainer.innerHTML = errorHtml;
        }
    };

    // Tambahkan event listener untuk link Login
    if (loginLink) {
        loginLink.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('🖱️ Login link clicked! Showing modal.'); // MATA-MATA #4
            authModal.show();
        });
    }

    // ... (sisa kode tidak berubah)
    if (registerLink) {
        registerLink.addEventListener('click', function(e) {
            e.preventDefault();
            const registerTab = new bootstrap.Tab(document.getElementById('pills-register-tab'));
            registerTab.show();
            authModal.show();
        });
    }

    // ... (kode bagian atas biarkan saja)

// Handle submit form login
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        axios.post('/login', formData)
            .then(response => {
                // PERUBAHAN DI SINI: Arahkan ke URL dari server
                if(response.data.redirect_url) {
                    window.location.href = response.data.redirect_url;
                } else {
                    window.location.reload();
                }
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    displayErrors('login-errors', error.response.data.errors);
                }
            });
    });
}

// Handle submit form register
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        axios.post('/register', formData)
            .then(response => {
                // PERUBAHAN DI SINI JUGA: Langsung arahkan ke dashboard
                window.location.href = '/dashboard'; 
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    displayErrors('register-errors', error.response.data.errors);
                }
            });
    });
}

// ... (sisa kode biarkan saja)
});