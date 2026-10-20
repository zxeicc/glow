<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=yes"
    >

    <title>AdminLTE 4 | Login Page</title>


    {{-- AdminLTE Theme Init --}}

    <script>

        (() => {

            'use strict';

            const root = document.documentElement;

            if (root.getAttribute('data-lte-color-mode') === 'off') {
                return;
            }

            const STORAGE_KEY = 'lte-theme';

            let stored = null;

            try {
                stored = localStorage.getItem(STORAGE_KEY);
            } catch {}

            const authored = root.getAttribute('data-bs-theme');

            let resolved = 'light';

            if (stored === 'dark' || stored === 'light') {

                resolved = stored;

            } else if (authored === 'dark' || authored === 'light') {

                resolved = authored;

            } else if (
                globalThis.matchMedia('(prefers-color-scheme: dark)').matches
            ) {

                resolved = 'dark';

            }

            root.setAttribute('data-bs-theme', resolved);

            root.style.colorScheme = resolved;

            if (resolved !== authored) {

                root.setAttribute(
                    'data-lte-theme-resolved',
                    ''
                );

            }

        })();

    </script>


    <script>

        const loginForm = document.getElementById('loginForm');

        const loginError = document.getElementById('loginError');

        loginForm.addEventListener('submit', async function (event) {

            event.preventDefault();

            loginError.classList.add('d-none');

            loginError.textContent = '';

            const email = document.getElementById('email').value;

            const password = document.getElementById('password').value;

            try {

                const response = await fetch('/api/login', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json'

                    },

                    body: JSON.stringify({

                        email: email,

                        password: password

                    })

                });

                const data = await response.json();

                if (!response.ok) {

                    loginError.textContent =
                        data.message ?? 'Login failed';

                    loginError.classList.remove('d-none');

                    return;

                }

                localStorage.setItem('token', data.token);

                window.location.href = '/admin/dashboard';

            } catch (error) {

                loginError.textContent =
                    'Something went wrong.';

                loginError.classList.remove('d-none');

                console.error(error);

            }

        });

    </script>


    {{-- Fonts --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous"
    >


    {{-- OverlayScrollbars --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    >


    {{-- Bootstrap Icons --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    >


    {{-- AdminLTE --}}

    <link
        rel="preload"
        href="{{ asset('assets/css/adminlte.css') }}"
        as="style"
    >

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/adminlte.css') }}"
    >


    <style>

        /* =====================================================
           LOGIN PAGE
        ===================================================== */

        :root {

            --login-primary: #2563eb;

            --login-primary-dark: #1d4ed8;

            --login-bg:
                #f5f7fb;

            --login-card:
                rgba(255, 255, 255, .78);

            --login-border:
                rgba(15, 23, 42, .08);

        }


        body.login-page {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 1.5rem;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(37, 99, 235, .10),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(59, 130, 246, .08),
                    transparent 30%
                ),
                var(--login-bg);

            font-family:
                "Source Sans 3",
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            -webkit-font-smoothing:
                antialiased;

        }


        /* =====================================================
           LOGIN BOX
        ===================================================== */

        .login-box {

            width:
                100%;

            max-width:
                400px;

            margin:
                0 auto;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .login-logo {

            margin-bottom:
                1.5rem;

        }


        .login-logo a {

            color:
                var(--app-text, #111827);

            font-size:
                1.75rem;

            font-weight:
                700;

            letter-spacing:
                -.025em;

            text-decoration:
                none;

        }


        .login-logo a b {

            color:
                var(--login-primary);

            font-weight:
                800;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .login-box .card {

            overflow:
                hidden;

            margin-bottom:
                0;

            border:
                1px solid var(--login-border);

            border-radius:
                18px;

            background:
                var(--login-card);

            box-shadow:
                0 20px 55px rgba(15, 23, 42, .09);

            backdrop-filter:
                blur(20px);

            -webkit-backdrop-filter:
                blur(20px);

        }


        .login-card-body {

            padding:
                2rem;

            background:
                transparent;

        }


        /* =====================================================
           LOGIN MESSAGE
        ===================================================== */

        .login-box-msg {

            margin-bottom:
                1.5rem;

            color:
                #64748b;

            font-size:
                .92rem;

            font-weight:
                500;

        }


        /* =====================================================
           INPUTS
        ===================================================== */

        .login-box .input-group {

            margin-bottom:
                1rem !important;

        }


        .login-box .form-control {

            min-height:
                46px;

            padding:
                .65rem .85rem;

            border:
                1px solid rgba(15, 23, 42, .10);

            border-right:
                0;

            border-radius:
                10px 0 0 10px;

            background:
                rgba(255, 255, 255, .72);

            color:
                #111827;

            box-shadow:
                none;

            transition:
                border-color .2s ease,
                background .2s ease,
                box-shadow .2s ease;

        }


        .login-box .input-group-text {

            min-width:
                46px;

            justify-content:
                center;

            border:
                1px solid rgba(15, 23, 42, .10);

            border-left:
                0;

            border-radius:
                0 10px 10px 0;

            background:
                rgba(255, 255, 255, .72);

            color:
                #94a3b8;

            transition:
                border-color .2s ease,
                color .2s ease,
                background .2s ease;

        }


        .login-box .input-group:focus-within .form-control,
        .login-box .input-group:focus-within .input-group-text {

            border-color:
                rgba(37, 99, 235, .45);

            background:
                rgba(255, 255, 255, .95);

        }


        .login-box .input-group:focus-within .form-control {

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .08);

        }


        .login-box .input-group:focus-within .input-group-text {

            color:
                var(--login-primary);

        }


        .login-box .form-control::placeholder {

            color:
                #94a3b8;

        }


        /* =====================================================
           REMEMBER ME
        ===================================================== */

        .login-box .form-check {

            display:
                flex;

            align-items:
                center;

            min-height:
                40px;

        }


        .login-box .form-check-input {

            cursor:
                pointer;

        }


        .login-box .form-check-input:checked {

            background-color:
                var(--login-primary);

            border-color:
                var(--login-primary);

        }


        .login-box .form-check-label {

            color:
                #64748b;

            font-size:
                .86rem;

            cursor:
                pointer;

        }


        /* =====================================================
           SIGN IN BUTTON
        ===================================================== */

        .login-box .btn-primary {

            min-height:
                40px;

            border:
                0;

            border-radius:
                9px;

            background:
                linear-gradient(
                    135deg,
                    var(--login-primary),
                    var(--login-primary-dark)
                );

            font-weight:
                600;

            box-shadow:
                0 7px 18px rgba(37, 99, 235, .18);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

        }


        .login-box .btn-primary:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 10px 22px rgba(37, 99, 235, .24);

        }


        .login-box .btn-primary:active {

            transform:
                translateY(0);

        }


        /* =====================================================
           LINKS
        ===================================================== */

        .login-card-body p:not(.login-box-msg) {

            font-size:
                .86rem;

        }


        .login-card-body p.mb-1 {

            margin-top:
                1.35rem;

        }


        .login-card-body a {

            color:
                var(--login-primary);

            font-weight:
                600;

            text-decoration:
                none;

            transition:
                color .2s ease;

        }


        .login-card-body a:hover {

            color:
                var(--login-primary-dark);

        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        [data-bs-theme="dark"] body.login-page {

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(37, 99, 235, .14),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(59, 130, 246, .10),
                    transparent 30%
                ),
                #0f172a;

        }


        [data-bs-theme="dark"] .login-box .card {

            background:
                rgba(17, 24, 39, .78);

            border-color:
                rgba(255, 255, 255, .07);

            box-shadow:
                0 20px 55px rgba(0, 0, 0, .25);

        }


        [data-bs-theme="dark"] .login-logo a {

            color:
                #f8fafc;

        }


        [data-bs-theme="dark"] .login-box-msg {

            color:
                #94a3b8;

        }


        [data-bs-theme="dark"] .login-box .form-control {

            background:
                rgba(15, 23, 42, .62);

            border-color:
                rgba(255, 255, 255, .08);

            color:
                #f8fafc;

        }


        [data-bs-theme="dark"] .login-box .input-group-text {

            background:
                rgba(15, 23, 42, .62);

            border-color:
                rgba(255, 255, 255, .08);

            color:
                #64748b;

        }


        [data-bs-theme="dark"] .login-box .input-group:focus-within .form-control,
        [data-bs-theme="dark"] .login-box .input-group:focus-within .input-group-text {

            background:
                rgba(15, 23, 42, .88);

            border-color:
                rgba(96, 165, 250, .45);

        }


        [data-bs-theme="dark"] .login-box .form-check-label {

            color:
                #94a3b8;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 575.98px) {

            body.login-page {

                padding:
                    1rem;

            }


            .login-card-body {

                padding:
                    1.4rem;

            }


            .login-logo {

                margin-bottom:
                    1.15rem;

            }


            .login-logo a {

                font-size:
                    1.5rem;

            }

        }

    </style>

</head>


<body class="login-page bg-body-secondary">

    <main class="login-box">

        <div class="login-logo">

            <a href="{{ url('/admin/auth/login') }}">

                <b>Admin</b>LTE

            </a>

        </div>


        <div class="card">

            <div class="card-body login-card-body">

                <p class="login-box-msg">
                    Sign in to start your session
                </p>


                @include('admin.layouts._message')


                <form
                    action="{{ route('admin.login.submit') }}"
                    method="POST"
                    id="loginForm"
                >

                    {{ csrf_field() }}

                    @csrf


                    <label
                        class="visually-hidden"
                        for="loginEmail"
                    >
                        Email
                    </label>


                    <div class="input-group mb-3">

                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Email"
                            required
                        >


                        <div class="input-group-text">

                            <span class="bi bi-envelope"></span>

                        </div>

                    </div>


                    <label
                        class="visually-hidden"
                        for="loginPassword"
                    >
                        Password
                    </label>


                    <div class="input-group mb-3">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            required
                        >


                        <div class="input-group-text">

                            <span class="bi bi-lock-fill"></span>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-8">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    id="remember"
                                >


                                <label
                                    class="form-check-label"
                                    for="remember"
                                >
                                    Remember Me
                                </label>

                            </div>

                        </div>


                        <div class="col-4">

                            <div class="d-grid gap-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Sign In
                                </button>

                            </div>

                        </div>

                    </div>

                </form>


                <p class="mb-1">

                    <a href="#">
                        I forgot my password
                    </a>

                </p>


                <p class="mb-0">

                    <a
                        href="#"
                        class="text-center"
                    >
                        Register a new membership
                    </a>

                </p>

            </div>

        </div>

    </main>


    {{-- OverlayScrollbars --}}

    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"
    ></script>


    {{-- Popper --}}

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"
    ></script>


    {{-- Bootstrap --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        crossorigin="anonymous"
    ></script>


    {{-- AdminLTE --}}

    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

</body>

</html>