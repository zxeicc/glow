<!doctype html>

<html lang="en">

<!--begin::Head-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ !empty($header_title) ? $header_title : '' }} - Ecommerce</title>

    <!--begin::Theme Init-->
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
            } catch {
                // localStorage may be unavailable
            }

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
                root.setAttribute('data-lte-theme-resolved', '');
            }

        })();
    </script>
    <!--end::Theme Init-->


    <!--begin::Accessibility Meta Tags-->

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=yes"
    />

    <meta
        name="color-scheme"
        content="light dark"
    />

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

    <!--end::Accessibility Meta Tags-->


    <!--begin::Primary Meta Tags-->

    <meta
        name="title"
        content="AdminLTE | Dashboard v3"
    />

    <meta
        name="author"
        content="ColorlibHQ"
    />

    <meta
        name="description"
        content="Ecommerce Admin Dashboard"
    />

    <meta
        name="keywords"
        content="ecommerce, admin dashboard, bootstrap, laravel"
    />

    <!--end::Primary Meta Tags-->


    <!--begin::Accessibility Features-->

    <meta
        name="supported-color-schemes"
        content="light dark"
    />

    <link
        rel="preload"
        href="{{ asset('assets/css/adminlte.css') }}"
        as="style"
    />

    <!--end::Accessibility Features-->


    <!--begin::Fonts-->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media = 'all'"
    />

    <!--end::Fonts-->


    <!--begin::OverlayScrollbars-->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />

    <!--end::OverlayScrollbars-->


    <!--begin::Bootstrap Icons-->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />

    <!--end::Bootstrap Icons-->


    <!--begin::AdminLTE-->

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/adminlte.css') }}"
    />

    <!--end::AdminLTE-->


    <!--begin::ApexCharts-->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
        crossorigin="anonymous"
    />

    <!--end::ApexCharts-->


    <!--begin::Global Custom Design-->

    <style>
        /* =========================================================
   MODERN ALERTS
========================================================= */

.modern-alert {

    position: relative;

    margin-bottom: 1rem;

    padding: .9rem 1rem;

    border: 1px solid transparent;

    border-radius: 12px;

    box-shadow:
        0 6px 18px rgba(15, 23, 42, .05);

    backdrop-filter:
        blur(12px);

    -webkit-backdrop-filter:
        blur(12px);

    font-size: .9rem;

    font-weight: 500;

}


/* =========================================================
   ERROR LIST
========================================================= */

.modern-alert ul {

    padding-left: 1.25rem;

}


.modern-alert li {

    margin-bottom: .25rem;

}


.modern-alert li:last-child {

    margin-bottom: 0;

}


/* =========================================================
   SUCCESS
========================================================= */

.modern-alert.alert-success {

    background:
        rgba(25, 135, 84, .09);

    border-color:
        rgba(25, 135, 84, .18);

    color:
        #146c43;

}


/* =========================================================
   DANGER
========================================================= */

.modern-alert.alert-danger {

    background:
        rgba(220, 53, 69, .09);

    border-color:
        rgba(220, 53, 69, .18);

    color:
        #b02a37;

}


/* =========================================================
   WARNING
========================================================= */

.modern-alert.alert-warning {

    background:
        rgba(255, 193, 7, .11);

    border-color:
        rgba(255, 193, 7, .22);

    color:
        #997404;

}


/* =========================================================
   INFO
========================================================= */

.modern-alert.alert-info {

    background:
        rgba(13, 202, 240, .09);

    border-color:
        rgba(13, 202, 240, .18);

    color:
        #087990;

}


/* =========================================================
   PRIMARY
========================================================= */

.modern-alert.alert-primary {

    background:
        rgba(37, 99, 235, .09);

    border-color:
        rgba(37, 99, 235, .18);

    color:
        #1d4ed8;

}


/* =========================================================
   SECONDARY
========================================================= */

.modern-alert.alert-secondary {

    background:
        rgba(108, 117, 125, .09);

    border-color:
        rgba(108, 117, 125, .18);

    color:
        #5c636a;

}


/* =========================================================
   LIGHT
========================================================= */

.modern-alert.alert-light {

    background:
        rgba(248, 249, 250, .75);

    border-color:
        rgba(15, 23, 42, .08);

    color:
        #495057;

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .modern-alert {

    box-shadow:
        0 8px 22px rgba(0, 0, 0, .16);

}


[data-bs-theme="dark"] .modern-alert.alert-success {

    background:
        rgba(25, 135, 84, .13);

    border-color:
        rgba(25, 135, 84, .25);

    color:
        #75b798;

}


[data-bs-theme="dark"] .modern-alert.alert-danger {

    background:
        rgba(220, 53, 69, .13);

    border-color:
        rgba(220, 53, 69, .25);

    color:
        #ea868f;

}


[data-bs-theme="dark"] .modern-alert.alert-warning {

    background:
        rgba(255, 193, 7, .13);

    border-color:
        rgba(255, 193, 7, .25);

    color:
        #ffda6a;

}


[data-bs-theme="dark"] .modern-alert.alert-info {

    background:
        rgba(13, 202, 240, .13);

    border-color:
        rgba(13, 202, 240, .25);

    color:
        #6edff6;

}


[data-bs-theme="dark"] .modern-alert.alert-primary {

    background:
        rgba(37, 99, 235, .14);

    border-color:
        rgba(96, 165, 250, .24);

    color:
        #93c5fd;

}


[data-bs-theme="dark"] .modern-alert.alert-secondary {

    background:
        rgba(108, 117, 125, .13);

    border-color:
        rgba(108, 117, 125, .24);

    color:
        #adb5bd;

}


[data-bs-theme="dark"] .modern-alert.alert-light {

    background:
        rgba(255, 255, 255, .05);

    border-color:
        rgba(255, 255, 255, .08);

    color:
        #cbd5e1;

}
        /* =========================================================
   MODERN GLASS FOOTER
========================================================= */

.modern-footer {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 1rem;

    min-height: 58px;

    padding:
        .85rem 1.25rem;

    background:
        rgba(255, 255, 255, .58) !important;

    border-top:
        1px solid rgba(15, 23, 42, .07);

    color:
        #64748b;

    font-size:
        .86rem;

    backdrop-filter:
        blur(16px);

    -webkit-backdrop-filter:
        blur(16px);

}


.modern-footer::before {

    content: "";

    position: absolute;

    top: -1px;

    left: 0;

    width: 100%;

    height: 1px;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(37, 99, 235, .22),
            transparent
        );

}


/* =========================================================
   COPYRIGHT
========================================================= */

.modern-footer .footer-copyright {

    color:
        #475569;

    font-weight:
        600;

}


.modern-footer .footer-copyright a {

    color:
        var(--app-primary);

    font-weight:
        700;

    transition:
        color .2s ease;

}


.modern-footer .footer-copyright a:hover {

    color:
        var(--app-primary-dark);

}


/* =========================================================
   VERSION
========================================================= */

.modern-footer .footer-version {

    color:
        #94a3b8;

    font-size:
        .8rem;

}


.modern-footer .footer-developer {

    color:
        #64748b;

    font-size:
        .82rem;

    font-weight:
        600;

    letter-spacing:
        .01em;

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .modern-footer {

    background:
        rgba(15, 23, 42, .68) !important;

    border-top:
        1px solid rgba(255, 255, 255, .07);

    color:
        #94a3b8;

}


[data-bs-theme="dark"] .modern-footer .footer-copyright {

    color:
        #cbd5e1;

}


[data-bs-theme="dark"] .modern-footer .footer-developer {

    color:
        #94a3b8;

}


[data-bs-theme="dark"] .modern-footer .footer-version {

    color:
        #64748b;

}


[data-bs-theme="dark"] .modern-footer .footer-copyright a {

    color:
        #60a5fa;

}


[data-bs-theme="dark"] .modern-footer .footer-copyright a:hover {

    color:
        #93c5fd;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575.98px) {

    .modern-footer {

        flex-direction:
            column;

        align-items:
            flex-start;

        justify-content:
            center;

        gap:
            .25rem;

        padding:
            .8rem 1rem;

    }


    .modern-footer .footer-developer {

        order:
            -1;

    }

}
        /* =========================================================
   MODERN GLASS HEADER
========================================================= */

.modern-header {

    position: sticky;

    top: 0;

    z-index: 1030;

    min-height: 64px;

    background:
        rgba(255, 255, 255, 0.72) !important;

    border-bottom:
        1px solid rgba(15, 23, 42, 0.07);

    box-shadow:
        0 6px 24px rgba(15, 23, 42, 0.045) !important;

    backdrop-filter:
        blur(18px);

    -webkit-backdrop-filter:
        blur(18px);

}


/* =========================================================
   NAV LINKS
========================================================= */

.modern-header .nav-link {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;

    width: 42px;

    height: 42px;

    margin: 0 .15rem;

    border-radius: 11px;

    color:
        #64748b;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease;

}


.modern-header .nav-link:hover {

    color:
        var(--app-primary);

    background:
        rgba(37, 99, 235, .08);

    transform:
        translateY(-1px);

}


.modern-header .nav-link i {

    font-size:
        1.08rem;

}


/* =========================================================
   SIDEBAR TOGGLE
========================================================= */

.modern-header .nav-item:first-child .nav-link {

    margin-left: .25rem;

}


.modern-header .nav-item:first-child .nav-link i {

    font-size:
        1.35rem;

}


/* =========================================================
   BADGES
========================================================= */

.modern-header .navbar-badge {

    position: absolute;

    top: 1px;

    right: 0;

    min-width: 18px;

    height: 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0 .3rem;

    border:
        2px solid rgba(255, 255, 255, .9);

    border-radius: 999px;

    font-size:
        .62rem;

    line-height: 1;

    box-shadow:
        0 3px 8px rgba(15, 23, 42, .12);

}


/* =========================================================
   DROPDOWN
========================================================= */

.modern-header .dropdown-menu {

    margin-top: .45rem;

    overflow: hidden;

    background:
        rgba(255, 255, 255, .92);

    border:
        1px solid rgba(15, 23, 42, .08);

    border-radius:
        14px;

    box-shadow:
        0 18px 45px rgba(15, 23, 42, .12);

    backdrop-filter:
        blur(20px);

    -webkit-backdrop-filter:
        blur(20px);

}


/* =========================================================
   DROPDOWN ITEMS
========================================================= */

.modern-header .dropdown-item {

    transition:
        background .2s ease,
        color .2s ease;

}


.modern-header .dropdown-item:hover {

    background:
        rgba(37, 99, 235, .07);

}


.modern-header .dropdown-footer {

    color:
        var(--app-primary);

    font-weight:
        600;

}


/* =========================================================
   MESSAGE DROPDOWN
========================================================= */

.modern-header .dropdown-menu-lg {

    min-width:
        340px;

}


.modern-header .img-size-50 {

    width: 46px;

    height: 46px;

    object-fit: cover;

    border:
        2px solid rgba(255, 255, 255, .8);

    box-shadow:
        0 4px 12px rgba(15, 23, 42, .08);

}


.modern-header .dropdown-item-title {

    margin-bottom: .2rem;

    font-weight:
        600;

}


.modern-header .dropdown-divider {

    margin:
        .35rem 0;

    border-color:
        rgba(15, 23, 42, .07);

}


/* =========================================================
   USER MENU
========================================================= */

.modern-header .user-menu > .nav-link {

    width:
        auto;

    min-width:
        42px;

    padding:
        .25rem .55rem .25rem .35rem;

    gap:
        .45rem;

}


.modern-header .user-menu > .nav-link:hover {

    transform:
        none;

}


.modern-header .user-image {

    width:
        34px;

    height:
        34px;

    object-fit:
        cover;

    border:
        2px solid rgba(255, 255, 255, .9);

    box-shadow:
        0 3px 10px rgba(15, 23, 42, .14) !important;

}


.modern-header .user-menu > .nav-link span {

    color:
        var(--app-text);

    font-size:
        .9rem;

    font-weight:
        600;

}


/* =========================================================
   USER DROPDOWN
========================================================= */

.modern-header .user-menu .dropdown-menu {

    overflow:
        hidden;

}


.modern-header .user-header {

    padding:
        1.5rem 1rem;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #1d4ed8
        ) !important;

}


.modern-header .user-header img {

    width:
        76px;

    height:
        76px;

    object-fit:
        cover;

    border:
        3px solid rgba(255, 255, 255, .35);

    box-shadow:
        0 8px 25px rgba(15, 23, 42, .20) !important;

}


.modern-header .user-header p {

    margin-top:
        .75rem;

    margin-bottom:
        0;

}


.modern-header .user-header small {

    display:
        block;

    margin-top:
        .25rem;

    opacity:
        .75;

}


/* =========================================================
   USER BODY
========================================================= */

.modern-header .user-body {

    padding:
        1rem;

    border-bottom:
        1px solid rgba(15, 23, 42, .07);

}


.modern-header .user-body a {

    color:
        var(--app-text);

    text-decoration:
        none;

    font-size:
        .82rem;

    font-weight:
        600;

}


.modern-header .user-body a:hover {

    color:
        var(--app-primary);

}


/* =========================================================
   USER FOOTER
========================================================= */

.modern-header .user-footer {

    padding:
        .85rem 1rem;

    background:
        transparent;

}


.modern-header .user-footer .btn {

    min-height:
        38px;

    padding:
        .4rem .75rem;

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .modern-header {

    background:
        rgba(15, 23, 42, .78) !important;

    border-bottom:
        1px solid rgba(255, 255, 255, .07);

    box-shadow:
        0 6px 24px rgba(0, 0, 0, .18) !important;

}


[data-bs-theme="dark"] .modern-header .nav-link {

    color:
        #94a3b8;

}


[data-bs-theme="dark"] .modern-header .nav-link:hover {

    color:
        #93c5fd;

    background:
        rgba(96, 165, 250, .10);

}


[data-bs-theme="dark"] .modern-header .dropdown-menu {

    background:
        rgba(17, 24, 39, .92);

    border-color:
        rgba(255, 255, 255, .08);

    box-shadow:
        0 18px 45px rgba(0, 0, 0, .30);

}


[data-bs-theme="dark"] .modern-header .dropdown-item:hover {

    background:
        rgba(96, 165, 250, .09);

}


[data-bs-theme="dark"] .modern-header .dropdown-divider {

    border-color:
        rgba(255, 255, 255, .07);

}


[data-bs-theme="dark"] .modern-header .user-menu > .nav-link span {

    color:
        #f8fafc;

}


[data-bs-theme="dark"] .modern-header .user-body {

    border-color:
        rgba(255, 255, 255, .07);

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575.98px) {

    .modern-header {

        min-height:
            58px;

    }


    .modern-header .nav-link {

        width:
            38px;

        height:
            38px;

        margin:
            0 .05rem;

    }


    .modern-header .dropdown-menu-lg {

        min-width:
            min(340px, calc(100vw - 20px));

    }


    .modern-header .user-menu > .nav-link {

        padding:
            .2rem;

    }

}
/* =========================================================
   MODERN GLASS SIDEBAR
========================================================= */

.modern-sidebar {

    background:
        linear-gradient(
            180deg,
            rgba(15, 23, 42, 0.96) 0%,
            rgba(17, 24, 39, 0.98) 100%
        ) !important;

    border-right:
        1px solid rgba(255, 255, 255, 0.07);

    box-shadow:
        10px 0 35px rgba(15, 23, 42, 0.12) !important;

    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);

}


/* =========================================================
   BRAND
========================================================= */

.modern-sidebar .sidebar-brand {

    height: 70px;

    padding: 0 1.15rem;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.07);

}


.modern-sidebar .brand-link {

    height: 100%;

    display: flex;

    align-items: center;

    gap: .75rem;

    text-decoration: none;

}


.modern-sidebar .brand-image {

    width: 38px;

    height: 38px;

    margin: 0;

    object-fit: contain;

    border-radius: 10px;

    padding: 5px;

    background:
        rgba(255, 255, 255, 0.08);

    border:
        1px solid rgba(255, 255, 255, 0.10);

    box-shadow:
        0 5px 18px rgba(0, 0, 0, .18) !important;

}


.modern-sidebar .brand-text {

    color: rgba(255, 255, 255, .94);

    font-size: 1.08rem;

    font-weight: 600 !important;

    letter-spacing: -.01em;

}


/* =========================================================
   NAVIGATION
========================================================= */

.modern-sidebar .sidebar-wrapper {

    padding:
        .75rem .65rem;

}


.modern-sidebar .sidebar-menu {

    gap: .25rem;

}


.modern-sidebar .nav-item {

    width: 100%;

}


.modern-sidebar .nav-link {

    position: relative;

    display: flex;

    align-items: center;

    min-height: 46px;

    padding:
        .7rem .85rem;

    border-radius: 11px;

    color:
        rgba(255, 255, 255, .62);

    transition:
        color .2s ease,
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;

}


.modern-sidebar .nav-link:hover {

    color: #ffffff;

    background:
        rgba(255, 255, 255, .065);

    transform:
        translateX(2px);

}


/* =========================================================
   ICONS
========================================================= */

.modern-sidebar .nav-icon {

    width: 22px;

    margin-right: .7rem;

    font-size: 1.05rem;

    text-align: center;

    color:
        rgba(255, 255, 255, .55);

    transition:
        color .2s ease,
        transform .2s ease;

}


.modern-sidebar .nav-link:hover .nav-icon {

    color: #ffffff;

    transform: scale(1.05);

}


.modern-sidebar .nav-link p {

    margin: 0;

    font-size: .92rem;

    font-weight: 500;

    letter-spacing: .01em;

}


/* =========================================================
   ACTIVE ITEM
========================================================= */

.modern-sidebar .nav-link.active {

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            rgba(37, 99, 235, .28),
            rgba(59, 130, 246, .12)
        );

    border:
        1px solid rgba(96, 165, 250, .16);

    box-shadow:
        0 8px 20px rgba(0, 0, 0, .12);

}


.modern-sidebar .nav-link.active::before {

    content: "";

    position: absolute;

    left: 0;

    top: 8px;

    bottom: 8px;

    width: 3px;

    border-radius: 0 5px 5px 0;

    background:
        #60a5fa;

    box-shadow:
        0 0 12px rgba(96, 165, 250, .55);

}


.modern-sidebar .nav-link.active .nav-icon {

    color:
        #60a5fa;

}


/* =========================================================
   SIDEBAR SCROLLBAR
========================================================= */

.modern-sidebar .sidebar-wrapper::-webkit-scrollbar {

    width: 5px;

}


.modern-sidebar .sidebar-wrapper::-webkit-scrollbar-track {

    background: transparent;

}


.modern-sidebar .sidebar-wrapper::-webkit-scrollbar-thumb {

    background:
        rgba(255, 255, 255, .12);

    border-radius: 20px;

}


.modern-sidebar .sidebar-wrapper::-webkit-scrollbar-thumb:hover {

    background:
        rgba(255, 255, 255, .20);

}


/* =========================================================
   DARK MODE
========================================================= */

[data-bs-theme="dark"] .modern-sidebar {

    background:
        linear-gradient(
            180deg,
            rgba(8, 15, 30, .98),
            rgba(15, 23, 42, .98)
        ) !important;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 991.98px) {

    .modern-sidebar {

        box-shadow:
            8px 0 30px rgba(0, 0, 0, .20) !important;

    }

}
        /* =========================================================
           GLOBAL DESIGN SYSTEM
        ========================================================= */

        :root {

            --app-primary: #2563eb;
            --app-primary-dark: #1d4ed8;

            --app-bg: #f5f7fb;
            --app-card: #ffffff;

            --app-text: #111827;
            --app-muted: #6b7280;

            --app-border: #e5e7eb;

            --app-radius: 14px;

            --app-shadow:
                0 4px 20px rgba(15, 23, 42, 0.05);

            --app-shadow-hover:
                0 12px 30px rgba(15, 23, 42, 0.09);
        }


        /* =========================================================
           BODY
        ========================================================= */

        body {

            background: var(--app-bg);

            color: var(--app-text);

            font-family:
                "Source Sans 3",
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            -webkit-font-smoothing: antialiased;

        }


        /* =========================================================
           APP WRAPPER
        ========================================================= */

        .app-wrapper {

            min-height: 100vh;

        }


        /* =========================================================
           MAIN CONTENT
        ========================================================= */

        .app-main {

            background: var(--app-bg);

        }


        /* =========================================================
           CARDS
        ========================================================= */

        .card {

            border: 1px solid var(--app-border);

            border-radius: var(--app-radius);

            background: var(--app-card);

            box-shadow: var(--app-shadow);

        }


        .card-header {

            border-bottom: 1px solid var(--app-border);

            padding: 1rem 1.25rem;

        }


        .card-body {

            padding: 1.25rem;

        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .btn {

            border-radius: 9px;

            font-weight: 600;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;

        }


        .btn-primary {

            background: var(--app-primary);

            border-color: var(--app-primary);

        }


        .btn-primary:hover {

            background: var(--app-primary-dark);

            border-color: var(--app-primary-dark);

            transform: translateY(-1px);

        }


        /* =========================================================
           FORM CONTROLS
        ========================================================= */

        .form-control,
        .form-select {

            border-radius: 9px;

            border-color: var(--app-border);

            min-height: 42px;

        }


        .form-control:focus,
        .form-select:focus {

            border-color: var(--app-primary);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);

        }


        /* =========================================================
           TABLE
        ========================================================= */

        .table {

            margin-bottom: 0;

        }


        .table > :not(caption) > * > * {

            padding: .85rem 1rem;

        }


        .table thead th {

            background: #f8fafc;

            color: #64748b;

            font-size: .78rem;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .04em;

            border-bottom: 1px solid var(--app-border);

        }


        .table tbody tr {

            transition:
                background-color .2s ease;

        }


        .table tbody tr:hover {

            background: #f8fafc;

        }


        /* =========================================================
           BADGES
        ========================================================= */

        .badge {

            border-radius: 999px;

            padding: .4rem .65rem;

            font-weight: 600;

        }


        /* =========================================================
           BREADCRUMB
        ========================================================= */

        .breadcrumb {

            margin-bottom: 0;

        }


        .breadcrumb-item {

            font-size: .9rem;

        }


        /* =========================================================
           DROPDOWN
        ========================================================= */

        .dropdown-menu {

            border: 1px solid var(--app-border);

            border-radius: 12px;

            padding: .45rem;

            box-shadow:
                0 15px 40px rgba(15, 23, 42, 0.10);

        }


        .dropdown-item {

            border-radius: 8px;

            padding: .55rem .75rem;

        }


        .dropdown-item:hover {

            background: #f1f5f9;

        }


        /* =========================================================
           SCROLLBAR
        ========================================================= */

        ::-webkit-scrollbar {

            width: 7px;

            height: 7px;

        }


        ::-webkit-scrollbar-thumb {

            background: #cbd5e1;

            border-radius: 20px;

        }


        ::-webkit-scrollbar-track {

            background: transparent;

        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        [data-bs-theme="dark"] {

            --app-bg: #0f172a;

            --app-card: #111827;

            --app-text: #f8fafc;

            --app-muted: #94a3b8;

            --app-border: #1f2937;

            --app-shadow:
                0 4px 20px rgba(0, 0, 0, .18);

        }


        [data-bs-theme="dark"] .table thead th {

            background: #172033;

            color: #94a3b8;

        }


        [data-bs-theme="dark"] .table tbody tr:hover {

            background: #172033;

        }


        [data-bs-theme="dark"] .dropdown-item:hover {

            background: #1f2937;

        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991.98px) {

            .app-main {

                padding-top: 0;

            }

        }


        @media (max-width: 575.98px) {

            .card-body {

                padding: 1rem;

            }

            .card-header {

                padding: .9rem 1rem;

            }

        }

    </style>

    <!--end::Global Custom Design-->


    @yield('style')

</head>
<!--end::Head-->


<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!--begin::App Wrapper-->

    <div class="app-wrapper">

        @include('admin.layouts.header')

        @include('admin.layouts.sidbar')

        @yield('content')

        @include('admin.layouts.footer')

    </div>

    <!--end::App Wrapper-->


    <!--begin::Scripts-->


    <!--begin::OverlayScrollbars-->

    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous">
    </script>

    <!--end::OverlayScrollbars-->


    <!--begin::Popper-->

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous">
    </script>

    <!--end::Popper-->


    <!--begin::Bootstrap-->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        crossorigin="anonymous">
    </script>

    <!--end::Bootstrap-->


    <!--begin::AdminLTE-->

    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

    <!--end::AdminLTE-->


    <!--begin::OverlayScrollbars Configure-->

    <script>

        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';

        const Default = {

            scrollbarTheme: 'os-theme-light',

            scrollbarAutoHide: 'leave',

            scrollbarClickScroll: true,

        };


        document.addEventListener('DOMContentLoaded', function () {

            const sidebarWrapper =
                document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

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

                            theme: Default.scrollbarTheme,

                            autoHide: Default.scrollbarAutoHide,

                            clickScroll:
                                Default.scrollbarClickScroll,

                        },

                    }
                );

            }

        });

    </script>

    <!--end::OverlayScrollbars Configure-->


    <!--begin::ApexCharts-->

    <script
        src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
        crossorigin="anonymous">
    </script>

    <!--end::ApexCharts-->


    <!--begin::Existing Dashboard Charts-->

    <script>

        /* Existing dashboard chart configuration */

        const visitors_chart_options = {

            series: [

                {
                    name: 'High - 2023',
                    data: [100, 120, 170, 167, 180, 177, 160],
                },

                {
                    name: 'Low - 2023',
                    data: [60, 80, 70, 67, 80, 77, 100],
                },

            ],

            chart: {

                height: 200,

                type: 'line',

                toolbar: {
                    show: false,
                },

            },

            colors: [
                '#0d6efd',
                '#adb5bd'
            ],

            stroke: {

                curve: 'smooth',

            },

            grid: {

                borderColor: '#e7e7e7',

                row: {

                    colors: [
                        '#f3f3f3',
                        'transparent'
                    ],

                    opacity: 0.5,

                },

            },

            legend: {

                show: false,

            },

            markers: {

                size: 1,

            },

            xaxis: {

                categories: [
                    '22th',
                    '23th',
                    '24th',
                    '25th',
                    '26th',
                    '27th',
                    '28th'
                ],

            },

        };


        const visitors_chart_element =
            document.querySelector('#visitors-chart');


        if (visitors_chart_element) {

            const visitors_chart =
                new ApexCharts(
                    visitors_chart_element,
                    visitors_chart_options
                );

            visitors_chart.render();

        }


        const sales_chart_options = {

            series: [

                {
                    name: 'Net Profit',

                    data: [
                        44,
                        55,
                        57,
                        56,
                        61,
                        58,
                        63,
                        60,
                        66
                    ],
                },

                {
                    name: 'Revenue',

                    data: [
                        76,
                        85,
                        101,
                        98,
                        87,
                        105,
                        91,
                        114,
                        94
                    ],
                },

                {
                    name: 'Free Cash Flow',

                    data: [
                        35,
                        41,
                        36,
                        26,
                        45,
                        48,
                        52,
                        53,
                        41
                    ],
                },

            ],

            chart: {

                type: 'bar',

                height: 200,

            },

            plotOptions: {

                bar: {

                    horizontal: false,

                    columnWidth: '55%',

                    endingShape: 'rounded',

                },

            },

            legend: {

                show: false,

            },

            colors: [
                '#0d6efd',
                '#20c997',
                '#ffc107'
            ],

            dataLabels: {

                enabled: false,

            },

            stroke: {

                show: true,

                width: 2,

                colors: [
                    'transparent'
                ],

            },

            xaxis: {

                categories: [
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct'
                ],

            },

            fill: {

                opacity: 1,

            },

            tooltip: {

                y: {

                    formatter: function (val) {

                        return '$ ' + val + ' thousands';

                    },

                },

            },

        };


        const sales_chart_element =
            document.querySelector('#sales-chart');


        if (sales_chart_element) {

            const sales_chart =
                new ApexCharts(
                    sales_chart_element,
                    sales_chart_options
                );

            sales_chart.render();

        }

    </script>

    <!--end::Existing Dashboard Charts-->


    @yield('script')

    <!--end::Scripts-->

</body>

<!--end::Body-->

</html>