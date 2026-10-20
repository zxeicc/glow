<!doctype html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Admin | 404 Error Page</title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=yes"
    />

    <meta name="color-scheme" content="light dark" />

    <meta
        name="theme-color"
        content="#007bff"
        media="(prefers-color-scheme: light)"
    />

    <meta
        name="theme-color"
        content="#1a1a1a"
        media="(prefers-color-scheme: dark)"
    />

    <meta
        name="title"
        content="AdminLTE 4 | 404 Error Page"
    />

    <meta
        name="author"
        content="ColorlibHQ"
    />

    <meta
        name="description"
        content="AdminLTE 4 Error Page"
    />

    <meta
        name="keywords"
        content="bootstrap 5, adminlte, admin dashboard, 404"
    />


    {{-- Theme Init --}}

    <script>

        (() => {

            'use strict';

            const root = document.documentElement;

            if (
                root.getAttribute('data-lte-color-mode') === 'off'
            ) {
                return;
            }

            const STORAGE_KEY = 'lte-theme';

            let stored = null;

            try {

                stored = localStorage.getItem(STORAGE_KEY);

            } catch {

                // localStorage unavailable

            }

            const authored =
                root.getAttribute('data-bs-theme');

            let resolved = 'light';

            if (
                stored === 'dark' ||
                stored === 'light'
            ) {

                resolved = stored;

            } else if (
                authored === 'dark' ||
                authored === 'light'
            ) {

                resolved = authored;

            } else if (
                globalThis.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches
            ) {

                resolved = 'dark';

            }

            root.setAttribute(
                'data-bs-theme',
                resolved
            );

            root.style.colorScheme = resolved;

            if (resolved !== authored) {

                root.setAttribute(
                    'data-lte-theme-resolved',
                    ''
                );

            }

        })();

    </script>


    {{-- Fonts --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous"
    />


    {{-- OverlayScrollbars --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />


    {{-- Bootstrap Icons --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />


    {{-- AdminLTE --}}

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/adminlte.css') }}"
    />


    @yield('style')


    <style>

        /* =====================================================
           404 PAGE DESIGN
        ===================================================== */

        :root {

            --error-primary: #2563eb;

            --error-primary-dark: #1d4ed8;

            --error-bg: #f5f7fb;

            --error-card: rgba(255, 255, 255, .72);

            --error-border: rgba(15, 23, 42, .08);

            --error-text: #111827;

            --error-muted: #64748b;

        }


        /* =====================================================
           PAGE
        ===================================================== */

        body.error-page {

            min-height: 100vh;

            margin: 0;

            display: flex;

            align-items: center;

            justify-content: center;

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
                var(--error-bg);

            color:
                var(--error-text);

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
           ERROR CONTAINER
        ===================================================== */

        .error-container {

            width: 100%;

            max-width: 620px;

            padding: 1rem;

        }


        /* =====================================================
           ERROR CARD
        ===================================================== */

        .error-card {

            position: relative;

            overflow: hidden;

            padding: 3.25rem 2.5rem;

            border:
                1px solid var(--error-border);

            border-radius:
                20px;

            background:
                var(--error-card);

            box-shadow:
                0 20px 55px rgba(15, 23, 42, .08);

            backdrop-filter:
                blur(20px);

            -webkit-backdrop-filter:
                blur(20px);

        }


        .error-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 3px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--error-primary),
                    transparent
                );

        }


        /* =====================================================
           404 NUMBER
        ===================================================== */

        .error-code {

            margin-bottom:
                1rem;

            color:
                var(--error-primary);

            font-size:
                clamp(5rem, 14vw, 8rem);

            font-weight:
                800;

            line-height:
                .85;

            letter-spacing:
                -.06em;

            text-shadow:
                0 10px 30px rgba(37, 99, 235, .12);

        }


        /* =====================================================
           TITLE
        ===================================================== */

        .error-title {

            margin-bottom:
                .75rem;

            color:
                var(--error-text);

            font-size:
                1.65rem;

            font-weight:
                700;

            letter-spacing:
                -.02em;

        }


        /* =====================================================
           DESCRIPTION
        ===================================================== */

        .error-description {

            max-width:
                480px;

            margin:
                0 auto 1.75rem;

            color:
                var(--error-muted);

            font-size:
                .98rem;

            line-height:
                1.7;

        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .error-card .btn {

            min-height:
                44px;

            padding:
                .65rem 1rem;

            border-radius:
                10px;

            font-weight:
                600;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;

        }


        .error-card .btn-outline-secondary {

            border-color:
                rgba(100, 116, 139, .25);

            background:
                rgba(255, 255, 255, .55);

            color:
                #475569;

        }


        .error-card .btn-outline-secondary:hover {

            border-color:
                rgba(37, 99, 235, .35);

            background:
                rgba(37, 99, 235, .07);

            color:
                var(--error-primary);

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 20px rgba(15, 23, 42, .07);

        }


        .error-card .btn i {

            transition:
                transform .2s ease;

        }


        .error-card .btn:hover i {

            transform:
                translateX(-2px);

        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        [data-bs-theme="dark"] body.error-page {

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


        [data-bs-theme="dark"] .error-card {

            background:
                rgba(17, 24, 39, .76);

            border-color:
                rgba(255, 255, 255, .07);

            box-shadow:
                0 20px 55px rgba(0, 0, 0, .25);

        }


        [data-bs-theme="dark"] .error-code {

            color:
                #60a5fa;

            text-shadow:
                0 10px 30px rgba(96, 165, 250, .12);

        }


        [data-bs-theme="dark"] .error-title {

            color:
                #f8fafc;

        }


        [data-bs-theme="dark"] .error-description {

            color:
                #94a3b8;

        }


        [data-bs-theme="dark"] .error-card .btn-outline-secondary {

            border-color:
                rgba(148, 163, 184, .20);

            background:
                rgba(15, 23, 42, .55);

            color:
                #cbd5e1;

        }


        [data-bs-theme="dark"] .error-card .btn-outline-secondary:hover {

            border-color:
                rgba(96, 165, 250, .35);

            background:
                rgba(96, 165, 250, .08);

            color:
                #93c5fd;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 575.98px) {

            .error-container {

                padding:
                    .75rem;

            }


            .error-card {

                padding:
                    2.5rem 1.5rem;

                border-radius:
                    16px;

            }


            .error-code {

                font-size:
                    5.5rem;

            }


            .error-title {

                font-size:
                    1.4rem;

            }


            .error-description {

                font-size:
                    .92rem;

            }

        }

    </style>

</head>


<body class="bg-body-tertiary error-page">

    <main class="error-container">

        <div class="error-card text-center">

            {{-- 404 --}}

            <div class="error-code">

                404

            </div>


            {{-- Title --}}

            <h1 class="error-title">

                Oops! Page not found.

            </h1>


            {{-- Description --}}

            <p class="error-description">

                We could not find the page you were looking for.

                Meanwhile, you may return to the dashboard.

            </p>


            {{-- Back button --}}

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-outline-secondary"
            >

                <i
                    class="bi bi-arrow-left me-1"
                    aria-hidden="true"
                ></i>

                Back to dashboard

            </a>

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


    {{-- OverlayScrollbars Configuration --}}

    <script>

        const SELECTOR_SIDEBAR_WRAPPER =
            '.sidebar-wrapper';

        const Default = {

            scrollbarTheme:
                'os-theme-light',

            scrollbarAutoHide:
                'leave',

            scrollbarClickScroll:
                true,

        };


        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const sidebarWrapper =
                    document.querySelector(
                        SELECTOR_SIDEBAR_WRAPPER
                    );

                const isMobile =
                    window.innerWidth <= 992;


                if (
                    sidebarWrapper &&
                    OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                    !isMobile
                ) {

                    OverlayScrollbarsGlobal.OverlayScrollbars(
                        sidebarWrapper,
                        {
                            scrollbars: {

                                theme:
                                    Default.scrollbarTheme,

                                autoHide:
                                    Default.scrollbarAutoHide,

                                clickScroll:
                                    Default.scrollbarClickScroll,

                            },
                        }
                    );

                }

            }
        );

    </script>


    @yield('script')

</body>

</html>