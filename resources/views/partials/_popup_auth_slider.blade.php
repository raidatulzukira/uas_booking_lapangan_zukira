{{-- CSS Kustom dari halaman login lama Anda --}}
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins");
    .slider-popup * { box-sizing: border-box; }
    .slider-popup h1 { font-weight: 700; letter-spacing: -1.5px; margin: 0 0 15px 0; font-size: 36px; }
    .slider-popup h1.title { font-size: 45px; line-height: 45px; margin: 0; text-shadow: 0 0 10px rgba(16, 64, 74, 0.5); }
    .slider-popup p { font-size: 14px; font-weight: 100; line-height: 20px; letter-spacing: 0.5px; margin: 20px 0 30px; text-shadow: 0 0 10px rgba(16, 64, 74, 0.5); }
    .slider-popup a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; transition: 0.3s ease-in-out; }
    .slider-popup a:hover { color: #fed0e7; }
    .slider-popup form { background-color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 0 50px; height: 100%; text-align: center; }
    .slider-popup input { background-color: #eee; border-radius: 10px; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; }
    .slider-popup button { position: relative; border-radius: 20px; border: 1px solid #fed0e7; background-color: #fed0e7; color: #fff; font-size: 15px; font-weight: 700; padding: 12px 80px; margin-top: 20px; letter-spacing: 1px; text-transform: capitalize; transition: 0.3s ease-in-out; cursor: pointer; }
    .slider-popup button:hover { letter-spacing: 3px; background-color: #ee71af;}
    .slider-popup button:active { transform: scale(0.95); color: #000000; }
    .slider-popup button:focus { outline: none; }
    .slider-popup button.ghost { background-color: rgba(225, 225, 225, 0.3); border-color: #fff; color: #fff; }
    .slider-popup .container { background-color: #fff; border-radius: 25px; box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22); position: relative; overflow: hidden; width: 768px; max-width: 100%; min-height: 500px; font-family: "poppins", sans-serif; }
    .slider-popup .form-container { position: absolute; top: 0; height: 100%; transition: all 0.6s ease-in-out; }
    .slider-popup .login-container { left: 0; width: 50%; z-index: 2; }
    .slider-popup .register-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
    .slider-popup .container.right-panel-active .login-container { transform: translateX(100%); }
    .slider-popup .container.right-panel-active .register-container { transform: translateX(100%); opacity: 1; z-index: 5; animation: show 0.6s; }
    @keyframes show { 0%, 49.99% { opacity: 0; z-index: 1; } 50%, 100% { opacity: 1; z-index: 5; } }
    .slider-popup .overlay-container { position: absolute; top: 0; left: 50%; height: 100%; width: 50%; overflow: hidden; transition: transform 0.6s ease-in-out; z-index: 100; }
    .slider-popup .container.right-panel-active .overlay-container { transform: translateX(-100%); }
    .slider-popup .overlay { background-image: url("{{ asset('images/download.gif') }}"); background-repeat: no-repeat; background-size: cover; background-position: 0 0; color: #fff; position: relative; left: -100%; height: 100%; width: 200%; transform: translateX(0); transition: transform 0.6s ease-in-out; }
    .slider-popup .container.right-panel-active .overlay { transform: translateX(50%); }
    .slider-popup .overlay-panel { position: absolute; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; width: 50%; text-align: center; padding: 0 40px; top: 0; transform: translateX(0); transition: transform 0.6s ease-in-out; }
    .slider-popup .overlay-left { transform: translateX(-20%); }
    .slider-popup .container.right-panel-active .overlay-left { transform: translateX(0); }
    .slider-popup .overlay-right { right: 0; transform: translateX(0); }
    .slider-popup .container.right-panel-active .overlay-right { transform: translateX(20%); }
    .slider-popup .error-messages { width: 100%; text-align: left; margin-bottom: 10px; }
</style>

{{-- Wrapper Popup --}}
<div x-show="authModalOpen" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" style="display: none;">
    <div x-data="{ panelActive: false }" @click.away="authModalOpen = false" class="slider-popup">
        <div class="container" :class="{ 'right-panel-active': panelActive }">

            <div class="form-container register-container">
                {{-- PENTING: action="#" ditambahkan untuk mencegah submit default --}}
                <form id="registerForm" action="#" method="POST">
                    <h1>Register Disini</h1>
                    <div id="register-errors" class="error-messages"></div>
                    <input type="text" name="name" placeholder="Name" required/>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required/>
                    <button type="submit">Register</button>
                </form>
            </div>

            <div class="form-container login-container">
                 {{-- PENTING: action="#" ditambahkan untuk mencegah submit default --}}
                <form id="loginForm" action="#" method="POST">
                    <h1>Login Disini</h1>
                    <div id="login-errors" class="error-messages"></div>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <button type="submit">Login</button>
                </form>
            </div>

            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1 class="title">Selamat<br>Datang!</h1>
                        <p>Jika kamu sudah memiliki akun, silahkan login.</p>
                        <button type="button" class="ghost" @click="panelActive = false">Login</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1 class="title">Buat Akun<br>Mu Sekarang</h1>
                        <p>Jika kamu belum memiliki akun, silahkan daftar!</p>
                        <button type="button" class="ghost" @click="panelActive = true">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SEMUA JAVASCRIPT DIGABUNG DI SINI --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const displayErrors = (errorContainerId, errors) => {
            const errorContainer = document.getElementById(errorContainerId);
            if (!errorContainer) return;
            errorContainer.innerHTML = '';
            if (errors) {
                let errorHtml = '<ul style="list-style-type: none; padding: 0; margin: 0; color: red; font-size: 12px;">';
                for (const key in errors) {
                    errors[key].forEach(message => {
                        errorHtml += `<li>${message}</li>`;
                    });
                }
                errorHtml += '</ul>';
                errorContainer.innerHTML = errorHtml;
            }
        };

        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah form submit cara biasa
                const formData = new FormData(this);

                // Menambahkan CSRF token secara manual
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                axios.post('{{ route("login") }}', formData)
                    .then(response => {
                        if (response.data.redirect_url) {
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

        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah form submit cara biasa
                const formData = new FormData(this);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                axios.post('{{ route("register") }}', formData)
                    .then(response => {
                        window.location.href = '/dashboard';
                    })
                    .catch(error => {
                        if (error.response && error.response.status === 422) {
                            displayErrors('register-errors', error.response.data.errors);
                        }
                    });
            });
        }
    });
</script>