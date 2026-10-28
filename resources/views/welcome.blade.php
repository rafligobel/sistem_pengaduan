<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-ADUAN — Sistem Pengaduan Inspektorat Kota Gorontalo</title>

    <link rel="shortcut icon" href="{{ asset('images/logo-kota1.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* ========================================================
           HEADER & NAVBAR DITURUNKAN (FLOATING & RESPONSIVE)
           ======================================================== */
        
        .header {
            padding-top: 0 !important;
            position: absolute;
            top: 24px; /* Diturunkan dari batas atas layar */
            left: 0;
            width: 100%;
            z-index: 990;
            transition: top 0.3s ease, transform 0.3s ease;
        }

        @media (max-width: 991px) {
            .header {
                top: 14px; /* Diturunkan pada perangkat mobile / tablet */
            }
        }

        .header-top {
            display: none !important;
        }

        /* Tampilan Navbar Mengambang (Floating Card) Saat Belum Di-scroll */
        .header-bottom {
            max-width: 1240px;
            margin-inline: auto;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 2px solid rgba(255, 255, 255, 0.28);
            border-radius: 20px;
            box-shadow: 0 14px 40px -6px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            transition: all 0.35s ease;
        }

        @media (max-width: 1280px) {
            .header-bottom {
                margin-inline: 20px;
            }
        }

        @media (max-width: 768px) {
            .header-bottom {
                margin-inline: 12px;
                border-radius: 16px;
                border-width: 1.5px;
            }
        }

        /* Saat Halaman Di-scroll: Sticky Navbar di Posisi Top 0 */
        .header.active {
            position: fixed;
            top: 0 !important;
            left: 0;
            width: 100%;
            z-index: 990;
            animation: headerSlideDown 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes headerSlideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        .header.active .header-bottom {
            max-width: 100%;
            margin-inline: 0;
            border-radius: 0;
            background: #ffffff !important;
            border: none;
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08);
        }

        .navbar-container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100%;
            padding-block: 22px; /* Ruang kosong atas-bawah yang lega agar logo & tombol tidak mepet stroke */
            padding-inline: 30px; /* Ruang kosong samping */
            transition: padding 0.3s ease;
        }

        .header.active .navbar-container {
            padding-block: 13px;
            padding-inline: 26px;
            max-width: 1240px;
            margin-inline: auto;
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding-block: 16px;
                padding-inline: 18px;
            }
        }

        /* Logo & Nama Aplikasi di Sisi Kiri */
        .header-logo-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .header-logo-img {
            height: 44px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
            display: block;
            transition: height 0.3s ease;
        }

        .header.active .header-logo-img {
            height: 40px;
        }

        @media (max-width: 768px) {
            .header-logo-img {
                height: 38px;
            }
        }

        .header-logo-text {
            display: flex;
            flex-direction: column;
            text-align: left;
            justify-content: center;
        }

        .header-logo-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.01em;
            line-height: 1.1;
            font-family: var(--ff-montserrat), sans-serif;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transition: color 0.3s ease;
        }

        .header-logo-sub {
            font-size: 0.68rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85);
            letter-spacing: 0.02em;
            margin-top: 1px;
            transition: color 0.3s ease;
        }

        .header.active .header-logo-title {
            color: #1e293b !important;
            text-shadow: none !important;
        }

        .header.active .header-logo-sub {
            color: #64748b !important;
        }

        /* Navigasi Desktop di Sisi Kanan */
        .desktop-nav {
            display: none;
            margin-left: auto;
        }

        @media (min-width: 992px) {
            .desktop-nav {
                display: flex;
                align-items: center;
            }
            .header-btn-group {
                display: none !important;
            }
        }

        .desktop-nav .navbar-list {
            display: flex;
            align-items: center;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .desktop-nav .navbar-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-family: var(--ff-montserrat), sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: none !important;
            padding: 9px 15px;
            border-radius: 9px;
            letter-spacing: 0.01em;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .desktop-nav .navbar-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .desktop-nav .navbar-link.active {
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff !important;
        }

        .header.active .desktop-nav .navbar-link {
            color: #334155 !important;
        }

        .header.active .desktop-nav .navbar-link:hover {
            color: #0284c7 !important;
            background: #f1f5f9;
        }

        .header.active .desktop-nav .navbar-link.active {
            background: #e0f2fe;
            color: #0284c7 !important;
        }

        .desktop-nav .btn {
            padding: 9px 20px !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            text-transform: none !important;
            border-radius: 9px !important;
            margin-left: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .desktop-nav .btn-primary {
            background: #0284c7 !important;
            border: 1px solid #0284c7 !important;
            color: #ffffff !important;
        }

        .desktop-nav .btn-primary:hover {
            background: #0369a1 !important;
            border-color: #0369a1 !important;
            transform: translateY(-1px);
        }

        .desktop-nav .btn-secondary {
            background: rgba(255, 255, 255, 0.16) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
        }

        .desktop-nav .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.28) !important;
            border-color: rgba(255, 255, 255, 0.45) !important;
            transform: translateY(-1px);
        }

        .header.active .desktop-nav .btn-secondary {
            background: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            color: #1e293b !important;
        }

        .header.active .desktop-nav .btn-secondary:hover {
            background: #e2e8f0 !important;
        }

        /* Nav Open Button in Header (Layar kecil / mobile) */
        .header-btn-group {
            margin-left: auto;
        }

        .nav-open-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff !important;
            padding: 7px 13px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            backdrop-filter: blur(8px);
            transition: all 0.2s ease;
        }

        .nav-open-btn:hover {
            background: rgba(255, 255, 255, 0.28);
            border-color: rgba(255, 255, 255, 0.45);
            transform: translateY(-1px);
        }

        .header.active .nav-open-btn {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #1e293b !important;
        }

        .header.active .nav-open-btn:hover {
            background: #e2e8f0;
        }

        .nav-open-icon {
            width: 20px;
            height: 20px;
        }

        .nav-open-label {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Overlay Backdrop */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        /* Sidebar Container */
        .sidebar-drawer {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 310px;
            max-width: 86vw;
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #cbd5e1; /* border-slate-300 */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            z-index: 999;
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            visibility: hidden;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s ease;
            font-family: var(--ff-poppins), 'Montserrat', sans-serif;
        }

        .sidebar-drawer.active {
            transform: translateX(0);
            visibility: visible;
        }

        /* Sidebar Header (Matching Dashboard Logo Area) */
        .sidebar-header {
            height: 64px; /* h-16 */
            padding: 0 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #cbd5e1; /* border-slate-300 */
            background: #f8fafc; /* bg-slate-50 */
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            min-width: 0;
        }

        .sidebar-brand-logo {
            height: 38px;
            width: auto;
            object-fit: contain;
            flex-shrink: 0;
            display: block;
        }

        .sidebar-brand-info {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            min-width: 0;
            justify-content: center;
        }

        .sidebar-brand-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1e293b; /* text-slate-800 */
            letter-spacing: -0.015em;
            font-family: var(--ff-montserrat), sans-serif;
        }

        .sidebar-brand-desc {
            font-size: 0.68rem;
            font-weight: 600;
            color: #64748b; /* text-slate-500 */
            letter-spacing: 0.02em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }

        .sidebar-close-btn {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #94a3b8; /* text-slate-400 */
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .sidebar-close-btn:hover {
            color: #ef4444; /* text-red-500 */
            background: #fef2f2; /* bg-red-50 */
        }

        .sidebar-close-btn svg {
            width: 22px;
            height: 22px;
        }

        /* Sidebar Body */
        .sidebar-body {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-body::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        /* Sidebar Section Header */
        .sidebar-section-title {
            padding: 14px 12px 6px 12px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8; /* slate-400 */
            margin: 0;
        }

        .sidebar-section-title:first-child {
            padding-top: 2px;
        }

        /* Sidebar Links (Features Styled like Dashboard) */
        .sidebar-link {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px; /* rounded-lg */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500;
            color: #475569; /* text-slate-600 */
            text-decoration: none;
            transition: all 0.15s ease-in-out;
            border: 1px solid transparent;
            box-sizing: border-box;
        }

        .sidebar-link:hover {
            color: #0f172a; /* text-slate-900 */
            background: #f8fafc; /* bg-slate-50 */
            border-color: #e2e8f0;
            transform: translateX(2px);
        }

        .sidebar-link.active {
            font-weight: 700;
            color: #ffffff !important;
            background: #2563eb !important; /* bg-blue-600 */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .sidebar-link.active .sidebar-icon {
            color: #ffffff !important;
        }

        .sidebar-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            flex-shrink: 0;
            color: #64748b;
            transition: color 0.15s ease-in-out;
        }

        .sidebar-link:hover .sidebar-icon {
            color: #2563eb;
        }

        /* Highlighted Feature Button (Buat Pengaduan Baru) */
        .sidebar-link-primary {
            background: #eff6ff; /* blue-50 */
            border-color: #bfdbfe; /* blue-200 */
            color: #1d4ed8; /* blue-700 */
            font-weight: 600;
        }

        .sidebar-link-primary .sidebar-icon {
            color: #2563eb;
        }

        .sidebar-link-primary:hover {
            background: #dbeafe;
            border-color: #93c5fd;
            color: #1e40af;
        }

        .sidebar-link-secondary {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #334155;
            font-weight: 600;
        }

        .sidebar-link-secondary .sidebar-icon {
            color: #64748b;
        }

        .sidebar-link-secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .sidebar-link-secondary:hover .sidebar-icon {
            color: #2563eb;
        }

        .sidebar-link-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .sidebar-link-badge {
            font-size: 0.65rem;
            font-weight: 700;
            background: #2563eb;
            color: #ffffff;
            padding: 2px 7px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* Sidebar Footer (User Profile Area / Guest Info) */
        .sidebar-footer {
            border-top: 1px solid #cbd5e1; /* border-slate-300 */
            background: #f8fafc; /* bg-slate-50 */
            padding: 14px 16px;
            flex-shrink: 0;
        }

        .sidebar-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 9999px;
            background: #dbeafe; /* blue-100 */
            border: 1px solid #bfdbfe; /* blue-200 */
            color: #2563eb; /* blue-600 */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .sidebar-user-details {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-size: 0.875rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.725rem;
            color: #64748b;
            margin: 0;
            text-transform: capitalize;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-logout-btn {
            border: none;
            background: transparent;
            padding: 8px;
            border-radius: 8px;
            color: #94a3b8;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logout-btn:hover {
            color: #dc2626; /* red-600 */
            background: #fee2e2; /* red-100 */
        }

        .sidebar-logout-btn svg {
            width: 20px;
            height: 20px;
        }

        .sidebar-footer-info {
            text-align: center;
            padding: 4px 0;
        }

        .sidebar-footer-title {
            font-size: 0.775rem;
            font-weight: 700;
            color: #334155;
            margin: 0 0 2px 0;
        }

        .sidebar-footer-sub {
            font-size: 0.68rem;
            color: #64748b;
            margin: 0;
        }

        /* ========================================================
           SECTION SCALE & RESPONSIVE PROPORTIONS
           ======================================================== */

        /* 1. HERO SECTION (BERANDA) - RESPONSIVE & ADAPTIVE SCALE */
        .hero {
            position: relative !important;
            width: 100% !important;
            min-height: clamp(680px, 92vh, 940px) !important;
            padding-top: clamp(165px, 20vh, 210px) !important;
            padding-bottom: clamp(60px, 8vh, 85px) !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.82) 0%, rgba(15, 23, 42, 0.72) 45%, rgba(15, 23, 42, 0.95) 100%),
                        radial-gradient(circle at 50% 20%, rgba(14, 165, 233, 0.22) 0%, transparent 60%),
                        url("{{ asset('images/inspektorat.jpg') }}") center center / cover no-repeat !important;
            background-attachment: scroll !important;
            overflow: hidden;
            box-sizing: border-box;
        }

        /* Subtle bottom glow separator */
        .hero::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.18) 50%, transparent 100%);
            z-index: 3;
        }

        /* Hero Container */
        .hero .container.hero-container,
        .hero .container {
            max-width: 960px !important;
            width: 100% !important;
            margin-inline: auto !important;
            padding-inline: clamp(16px, 4vw, 32px) !important;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Hero Badge Pill */
        .hero-badge-wrap {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: clamp(14px, 2.5vh, 22px);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.22);
            padding: 6px 18px;
            border-radius: 9999px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .hero-badge:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateY(-1px);
        }

        .hero-badge-pulse {
            position: relative;
            display: flex;
            width: 10px;
            height: 10px;
        }

        .hero-badge-ping {
            position: absolute;
            display: inline-flex;
            height: 100%;
            width: 100%;
            border-radius: 9999px;
            background-color: #38bdf8;
            opacity: 0.75;
            animation: heroPing 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .hero-badge-dot {
            position: relative;
            display: inline-flex;
            border-radius: 9999px;
            height: 10px;
            width: 10px;
            background-color: #0ea5e9;
        }

        @keyframes heroPing {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .hero-badge-text {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: clamp(0.75rem, 1.3vw, 0.85rem);
            font-weight: 600;
            color: #f1f5f9;
            letter-spacing: 0.02em;
        }

        /* Hero Main Title */
        .hero-main-title {
            font-family: var(--ff-montserrat), sans-serif !important;
            font-size: clamp(2.1rem, 5.5vw, 3.8rem) !important;
            font-weight: 800 !important;
            letter-spacing: -0.025em !important;
            line-height: 1.12 !important;
            margin-bottom: clamp(10px, 1.8vh, 14px) !important;
            text-align: center !important;
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, #ffffff 55%, #bae6fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 4px 16px rgba(0, 0, 0, 0.5));
            display: inline-block;
        }

        /* Hero Sub Title */
        .hero-sub-title {
            font-family: var(--ff-montserrat), sans-serif !important;
            font-size: clamp(1.05rem, 2.2vw, 1.4rem) !important;
            font-weight: 600 !important;
            color: #e2e8f0 !important;
            letter-spacing: -0.01em !important;
            line-height: 1.35 !important;
            margin-bottom: clamp(14px, 2.2vh, 20px) !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.45) !important;
            text-align: center !important;
        }

        /* Hero Lead Text */
        .hero .hero-text {
            font-family: var(--ff-poppins), sans-serif !important;
            font-size: clamp(0.9rem, 1.6vw, 1.05rem) !important;
            line-height: 1.75 !important;
            color: rgba(241, 245, 249, 0.92) !important;
            max-width: 680px !important;
            margin-inline: auto !important;
            margin-bottom: clamp(24px, 4vh, 34px) !important;
            text-shadow: 0 1px 6px rgba(0, 0, 0, 0.35) !important;
            text-align: center !important;
            padding: 0 !important;
        }

        /* CTA Buttons Group */
        .hero .btn-group,
        .hero-btn-group {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: clamp(12px, 2vw, 16px) !important;
            flex-wrap: wrap !important;
            margin-top: 0 !important;
            margin-bottom: clamp(28px, 4.8vh, 44px) !important;
            width: 100% !important;
        }

        .hero .btn,
        .hero-btn-main,
        .hero-btn-outline {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            padding: clamp(12px, 1.8vw, 14px) clamp(22px, 2.8vw, 30px) !important;
            font-size: clamp(0.875rem, 1.3vw, 0.95rem) !important;
            font-weight: 600 !important;
            border-radius: 12px !important;
            text-transform: none !important;
            text-decoration: none !important;
            letter-spacing: 0.01em !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
            cursor: pointer;
            white-space: nowrap;
        }

        .hero-btn-icon {
            width: 19px;
            height: 19px;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        /* Primary Button */
        .hero .btn-primary,
        .hero-btn-main {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 6px 20px -2px rgba(2, 132, 199, 0.55), 0 0 0 1px rgba(255, 255, 255, 0.1) inset !important;
        }

        .hero .btn-primary:hover,
        .hero-btn-main:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 26px -2px rgba(2, 132, 199, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
        }

        .hero .btn-primary:hover .hero-btn-icon,
        .hero-btn-main:hover .hero-btn-icon {
            transform: scale(1.1);
        }

        /* Secondary Button (Frosted Glass) */
        .hero .btn-secondary,
        .hero-btn-outline {
            background: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25) !important;
        }

        .hero .btn-secondary:hover,
        .hero-btn-outline:hover {
            background: rgba(255, 255, 255, 0.22) !important;
            border-color: rgba(255, 255, 255, 0.55) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.35) !important;
        }

        .hero .btn-secondary:hover .hero-btn-icon,
        .hero-btn-outline:hover .hero-btn-icon {
            transform: scale(1.1);
        }

        /* Hero Highlights / Trust Cards */
        .hero-highlights {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: clamp(12px, 2vw, 18px);
            width: 100%;
            max-width: 920px;
            margin-inline: auto;
        }

        .hero-highlight-item {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 14px;
            padding: clamp(12px, 1.8vw, 16px) clamp(14px, 2vw, 18px);
            display: flex;
            align-items: center;
            gap: 13px;
            text-align: left;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px -3px rgba(0, 0, 0, 0.25);
        }

        .hero-highlight-item:hover {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(255, 255, 255, 0.28);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.35);
        }

        .hero-highlight-icon {
            width: clamp(38px, 4.5vw, 44px);
            height: clamp(38px, 4.5vw, 44px);
            flex-shrink: 0;
            border-radius: 11px;
            background: rgba(14, 165, 233, 0.16);
            border: 1px solid rgba(14, 165, 233, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #38bdf8;
            transition: all 0.3s ease;
        }

        .hero-highlight-icon svg {
            width: 22px;
            height: 22px;
        }

        .hero-highlight-item:hover .hero-highlight-icon {
            background: rgba(14, 165, 233, 0.26);
            transform: scale(1.08);
            color: #7dd3fc;
        }

        .hero-highlight-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .hero-highlight-title {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: clamp(0.825rem, 1.2vw, 0.925rem);
            font-weight: 700;
            color: #ffffff;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .hero-highlight-sub {
            font-family: var(--ff-poppins), sans-serif;
            font-size: clamp(0.725rem, 1.05vw, 0.8rem);
            color: #cbd5e1;
            line-height: 1.35;
        }

        /* Scroll Down Indicator */
        .hero-scroll-btn {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-top: clamp(24px, 4vh, 36px);
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.25s ease, transform 0.25s ease;
        }

        .hero-scroll-btn:hover {
            color: #ffffff;
            transform: translateY(2px);
        }

        .hero-scroll-mouse {
            width: 20px;
            height: 32px;
            border-radius: 16px;
            border: 2px solid currentColor;
            display: flex;
            justify-content: center;
            padding-top: 5px;
            box-sizing: border-box;
        }

        .hero-scroll-dot {
            width: 4px;
            height: 6px;
            border-radius: 2px;
            background-color: currentColor;
            animation: heroScrollDot 1.8s infinite ease-in-out;
        }

        @keyframes heroScrollDot {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            60% {
                transform: translateY(10px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 0;
            }
        }

        .hero-scroll-text {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: 0.725rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* RESPONSIVE BREAKPOINTS FOR HERO */
        @media (max-width: 991px) {
            .hero {
                min-height: clamp(580px, 82vh, 760px) !important;
                padding-top: 160px !important;
                padding-bottom: 55px !important;
            }

            .hero-highlights {
                gap: 12px;
            }

            .hero-highlight-item {
                padding: 12px 14px;
                gap: 10px;
            }

            .hero-highlight-icon {
                width: 36px;
                height: 36px;
            }

            .hero-highlight-icon svg {
                width: 19px;
                height: 19px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: auto !important;
                padding-top: 140px !important;
                padding-bottom: 45px !important;
            }

            .hero-highlights {
                grid-template-columns: 1fr;
                max-width: 420px;
                gap: 10px;
            }

            .hero-highlight-item {
                padding: 10px 14px;
                border-radius: 12px;
            }

            .hero-scroll-btn {
                display: none; /* Hide scroll mouse on mobile to save vertical space */
            }
        }

        @media (max-width: 575px) {
            .hero {
                padding-top: 120px !important;
                padding-bottom: 40px !important;
            }

            .hero-badge {
                padding: 5px 14px;
                gap: 8px;
            }

            .hero-badge-text {
                font-size: 0.725rem;
            }

            .hero .btn-group,
            .hero-btn-group {
                flex-direction: column !important;
                width: 100% !important;
                max-width: 310px !important;
                margin-inline: auto !important;
                gap: 10px !important;
            }

            .hero .btn,
            .hero-btn-main,
            .hero-btn-outline {
                width: 100% !important;
                padding: 12px 18px !important;
                font-size: 0.885rem !important;
                border-radius: 10px !important;
            }

            .hero-highlights {
                max-width: 320px;
                gap: 8px;
            }

            .hero-highlight-item {
                padding: 9px 12px;
            }

            .hero-highlight-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
            }

            .hero-highlight-icon svg {
                width: 17px;
                height: 17px;
            }

            .hero-highlight-title {
                font-size: 0.8rem;
            }

            .hero-highlight-sub {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 360px) {
            .hero {
                padding-top: 110px !important;
                padding-bottom: 35px !important;
            }

            .hero-main-title {
                font-size: 1.85rem !important;
            }

            .hero-sub-title {
                font-size: 0.95rem !important;
            }

            .hero-badge-text {
                font-size: 0.685rem;
            }
        }

        /* 2. SECTION COMMONS (HEADINGS & TEXTS) */
        .popular,
        .gallery,
        .news {
            padding-block: 72px !important;
        }

        @media (max-width: 768px) {
            .popular,
            .gallery,
            .news {
                padding-block: 52px !important;
            }
        }

        .section-title {
            font-family: var(--ff-montserrat), sans-serif !important;
            font-size: clamp(1.6rem, 3.2vw, 2.1rem) !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            letter-spacing: -0.02em !important;
            text-align: center !important;
            margin-bottom: 12px !important;
        }

        .section-text {
            font-family: var(--ff-poppins), sans-serif !important;
            font-size: 0.95rem !important;
            line-height: 1.75 !important;
            color: #64748b !important;
            max-width: 780px !important;
            margin-inline: auto !important;
            margin-bottom: 32px !important;
            text-align: center !important;
        }

        /* 3. TENTANG KAMI (#about / .popular) */
        .about-subheading {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: clamp(1.2rem, 2.4vw, 1.45rem);
            font-weight: 700;
            color: #1e293b;
            margin-top: 40px;
            margin-bottom: 28px;
            text-align: center;
            letter-spacing: -0.01em;
        }

        .popular-list {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
            gap: 24px !important;
            margin-bottom: 0 !important;
        }

        .popular-card {
            position: relative;
            overflow: hidden;
            border-radius: 16px !important;
            height: 310px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06) !important;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        .popular-card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12) !important;
        }

        .popular-card .card-content {
            position: absolute;
            bottom: 14px;
            left: 14px;
            right: 14px;
            background: #ffffff !important;
            border-radius: 12px !important;
            padding: 16px 18px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid #f1f5f9;
        }

        .popular-card .card-title {
            font-size: 1.05rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            margin-bottom: 4px !important;
            font-family: var(--ff-montserrat), sans-serif;
        }

        .popular-card .card-text {
            font-size: 0.85rem !important;
            line-height: 1.5 !important;
            color: #64748b !important;
            margin-bottom: 0 !important;
        }

        /* 4. GALERI FOTO (#gallery / .gallery) */
        .gallery-slider-container {
            width: 100%;
            overflow: hidden;
            padding: 10px 0 20px 0;
        }

        .gallery-slider {
            display: grid;
            grid-template-rows: repeat(2, 240px);
            grid-auto-flow: column;
            grid-auto-columns: 280px;
            gap: 20px;
            overflow-x: auto;
            padding: 10px 20px 24px 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        @media (max-width: 768px) {
            .gallery-slider {
                grid-template-rows: repeat(1, 260px);
                grid-auto-columns: 260px;
                gap: 16px;
                padding-inline: 14px;
            }
        }

        .gallery-slider::-webkit-scrollbar {
            display: none;
        }

        .gallery-item-wrapper {
            scroll-snap-align: center;
            height: 100%;
            width: 100%;
        }

        .gallery-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            aspect-ratio: 1 / 1;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.22);
        }

        .gallery-banner {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .gallery-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-card:hover .gallery-banner img {
            transform: scale(1.08);
        }

        .gallery-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 22px 18px;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 50%, transparent 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            z-index: 1;
        }

        .gallery-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            font-family: var(--ff-montserrat);
        }

        .gallery-desc {
            font-size: 0.825rem;
            color: #e2e8f0;
            font-weight: 400;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            opacity: 0.9;
        }

        /* 5. BERITA TERKINI (#news / .news) */
        .news-slider-container {
            width: 100%;
            overflow: hidden;
            padding: 10px 0 20px 0;
        }

        .news-slider {
            display: grid;
            grid-template-rows: repeat(2, 320px);
            grid-auto-flow: column;
            grid-auto-columns: 290px;
            gap: 22px;
            overflow-x: auto;
            padding: 10px 20px 24px 20px;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        @media (max-width: 768px) {
            .news-slider {
                grid-template-rows: repeat(1, 335px);
                grid-auto-columns: 280px;
                gap: 16px;
                padding-inline: 14px;
            }
        }

        .news-slider::-webkit-scrollbar {
            display: none;
        }

        .news-card-item {
            scroll-snap-align: center;
            height: 100%;
            width: 100%;
            position: relative;
        }

        .news-card-item .popular-card {
            height: 100% !important;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-radius: 14px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06) !important;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        .news-card-item .popular-card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .news-card-item .card-img {
            height: 145px;
            min-height: 145px;
            width: 100%;
            overflow: hidden;
            position: relative;
            margin: 0;
        }

        .news-card-item .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card-item .popular-card:hover .card-img img {
            transform: scale(1.06);
        }

        .news-card-item .card-content {
            position: static !important;
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 14px 16px !important;
            background: transparent !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            border: none !important;
            margin: 0;
        }

        .news-card-item .card-rating {
            position: static;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
            color: #64748b;
            font-size: 0.725rem;
            background: #f1f5f9;
            width: fit-content;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .news-card-item .card-title {
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            line-height: 1.4 !important;
            margin-bottom: 6px !important;
            color: #1e293b !important;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-card-item .card-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .news-card-item .card-title a:hover {
            color: #0284c7;
        }

        .news-card-item .card-text {
            font-size: 0.825rem !important;
            line-height: 1.5 !important;
            color: #64748b !important;
            margin-bottom: 14px !important;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .news-card-item .btn-detail {
            width: 100%;
            padding: 7px 0;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #0284c7;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            font-size: 0.8rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .news-card-item .btn-detail:hover {
            background-color: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);
        }

        /* 6. CALL TO ACTION / HUBUNGI KAMI (#contact / .cta) */
        .cta {
            background: linear-gradient(135deg, #0369a1 0%, #0284c7 50%, #0ea5e9 100%) !important;
            padding-block: 64px !important;
            position: relative;
            overflow: hidden;
        }

        .cta .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 32px;
        }

        @media (max-width: 991px) {
            .cta .container {
                flex-direction: column;
                text-align: center;
                gap: 24px;
            }
        }

        .cta-content {
            flex: 1;
        }

        .cta .section-subtitle {
            color: #bae6fd !important;
            font-size: 0.825rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.06em !important;
            text-transform: uppercase !important;
            margin-bottom: 6px !important;
            font-family: var(--ff-montserrat), sans-serif;
        }

        .cta .section-title {
            color: #ffffff !important;
            font-size: clamp(1.5rem, 3vw, 2.1rem) !important;
            font-weight: 800 !important;
            margin-bottom: 10px !important;
            text-align: left !important;
            letter-spacing: -0.015em;
        }

        .cta .section-text {
            color: rgba(255, 255, 255, 0.92) !important;
            font-size: 0.95rem !important;
            line-height: 1.65 !important;
            max-width: 680px !important;
            margin-inline: 0 !important;
            margin-bottom: 0 !important;
            text-align: left !important;
        }

        @media (max-width: 991px) {
            .cta .section-title,
            .cta .section-text {
                text-align: center !important;
                margin-inline: auto !important;
            }
        }

        .cta .btn-secondary {
            padding: 13px 32px !important;
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            border-radius: 10px !important;
            background: #ffffff !important;
            color: #0369a1 !important;
            border: none !important;
            white-space: nowrap !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.25s ease !important;
            flex-shrink: 0;
        }

        .cta .btn-secondary:hover {
            transform: translateY(-2px);
            background: #f8fafc !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.28) !important;
        }

        /* 7. FOOTER SECTION */
        .footer-top {
            background: #0f172a !important;
            padding-block: 64px 44px !important;
            color: #94a3b8 !important;
        }

        .footer-top .container {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)) !important;
            gap: 36px !important;
            align-items: start;
        }

        .footer-brand .logo img {
            max-height: 48px;
            width: auto;
        }

        .footer-brand .footer-text {
            font-size: 0.875rem;
            line-height: 1.65;
            color: #94a3b8;
            margin-top: 14px;
        }

        .footer-contact .contact-title {
            font-family: var(--ff-montserrat), sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .footer-contact .contact-text {
            font-size: 0.875rem;
            color: #94a3b8;
            margin-bottom: 16px;
        }

        .footer-contact .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.875rem;
            color: #cbd5e1;
        }

        .footer-contact .contact-item ion-icon {
            font-size: 1.15rem;
            color: #38bdf8;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-contact .contact-link {
            color: #cbd5e1;
            transition: color 0.2s ease;
        }

        .footer-contact .contact-link:hover {
            color: #38bdf8;
        }

        .contact-map iframe {
            width: 100% !important;
            max-width: 380px;
            height: 220px !important;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .footer-bottom {
            background: #020617 !important;
            padding-block: 18px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .footer-bottom .copyright {
            color: #64748b;
            font-size: 0.85rem;
            text-align: center;
        }

        .footer-bottom .copyright a {
            color: #94a3b8;
            font-weight: 600;
        }

        .footer-bottom .copyright a:hover {
            color: #38bdf8;
        }
    </style>
</head>

<body id="top">

    <header class="header" data-header>
        {{-- BACKDROP OVERLAY --}}
        <div class="overlay" data-overlay></div>

        {{-- SIDEBAR DRAWER (SEPERTI SIDEBAR DASHBOARD) --}}
        <aside class="sidebar-drawer" data-navbar>
            {{-- 1. HEADER SIDEBAR DENGAN LOGO RESMI KOTA GORONTALO & BRANDING SI-ADUAN --}}
            <div class="sidebar-header">
                <a href="{{ route('landing') }}" class="sidebar-brand">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota Gorontalo" class="sidebar-brand-logo">
                    <div class="sidebar-brand-info">
                        <span class="sidebar-brand-name">SI-ADUAN</span>
                        <span class="sidebar-brand-desc">Inspektorat Kota Gorontalo</span>
                    </div>
                </a>
                <button class="sidebar-close-btn" aria-label="Tutup Menu" data-nav-close-btn>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- 2. TOMBOL FITUR SIDEBAR (SESUAI DENGAN NAVBAR BERANDA) --}}
            <div class="sidebar-body">
                
                {{-- Section: Navigasi Halaman --}}
                <p class="sidebar-section-title">Navigasi Halaman</p>

                <a href="#home" class="sidebar-link active" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="#about" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Tentang Kami</span>
                </a>

                <a href="#gallery" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span>Galeri</span>
                </a>

                <a href="#news" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    <span>Berita</span>
                </a>

                <a href="#contact" class="sidebar-link" data-nav-link>
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <span>Hubungi Kami</span>
                </a>

                {{-- Section: Autentikasi / Akun --}}
                <p class="sidebar-section-title">Akses Akun</p>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="sidebar-link sidebar-link-primary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1.125-1.125M10.5 16.5l-1.125-1.125m0 0L8.25 14.25m1.125 1.125l-1.125 1.125m3.75-3.75L12 14.25m0 0l-1.125 1.125M12 14.25l1.125 1.125m0 0L14.25 16.5m1.125-1.125l-1.125-1.125M16.5 14.25l1.125 1.125" />
                            </svg>
                            <span class="font-bold">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="sidebar-link sidebar-link-primary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <span>Login</span>
                        </a>

                        <a href="{{ route('register') }}" class="sidebar-link sidebar-link-secondary">
                            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                            </svg>
                            <span>Daftar Sekarang</span>
                        </a>
                    @endauth
                @endif
            </div>

            {{-- 3. FOOTER USER PROFILE (SEPERTI SIDEBAR DASHBOARD) --}}
            @auth
                <div class="sidebar-footer">
                    <div class="sidebar-user-card">
                        <div class="sidebar-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="sidebar-user-details">
                            <p class="sidebar-user-name">{{ Auth::user()->name }}</p>
                            <p class="sidebar-user-role">{{ Auth::user()->roles->pluck('name')->first() ?? 'Pengguna' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="sidebar-logout-btn" title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="sidebar-footer">
                    <div class="sidebar-footer-info">
                        <p class="sidebar-footer-title">SI-ADUAN Kota Gorontalo</p>
                        <p class="sidebar-footer-sub">Saluran Pengaduan Tipikor Resmi</p>
                    </div>
                </div>
            @endauth
        </aside>

        {{-- HEADER BAR: LOGO & NAMA APLIKASI DI SEBELAH KIRI, DERETAN NAVBAR DI SEBELAH KANAN --}}
        <div class="header-bottom">
            <div class="container navbar-container">
                {{-- 1. LOGO & NAMA APLIKASI (DI BAGIAN KIRI DERETAN NAVBAR) --}}
                <a href="{{ route('landing') }}" class="header-logo-link">
                    <img src="{{ asset('images/logo-kota1.png') }}" alt="Logo Kota Gorontalo" class="header-logo-img">
                    <div class="header-logo-text">
                        <span class="header-logo-title">SI-ADUAN</span>
                        <span class="header-logo-sub">Inspektorat Kota Gorontalo</span>
                    </div>
                </a>

                {{-- 2. DERETAN NAVBAR DESKTOP DI SEBELAH KANAN --}}
                <nav class="desktop-nav">
                    <ul class="navbar-list">
                        <li>
                            <a href="#home" class="navbar-link">Beranda</a>
                        </li>
                        <li>
                            <a href="#about" class="navbar-link">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#gallery" class="navbar-link">Galeri</a>
                        </li>
                        <li>
                            <a href="#news" class="navbar-link">Berita</a>
                        </li>
                        <li>
                            <a href="#contact" class="navbar-link">Hubungi Kami</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                </li>
                                <li><a href="{{ route('register') }}" class="btn btn-secondary">Daftar Sekarang</a></li>
                            @endauth
                        @endif
                    </ul>
                </nav>

                {{-- 3. TOMBOL MENU (HANYA MUNCUL DI LAYAR KECIL / MOBILE) --}}
                <div class="header-btn-group">
                    <button class="nav-open-btn" aria-label="Buka Menu Sidebar" data-nav-open-btn>
                        <svg class="nav-open-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span class="nav-open-label">Menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <article>

            <section class="hero" id="home">
                <div class="container hero-container">
                    {{-- 1. BADGE RESMI / PILL TAG --}}
                    <div class="hero-badge-wrap">
                        <div class="hero-badge">
                            <span class="hero-badge-pulse">
                                <span class="hero-badge-ping"></span>
                                <span class="hero-badge-dot"></span>
                            </span>
                            <span class="hero-badge-text">Kanal Pengaduan Resmi — Inspektorat Kota Gorontalo</span>
                        </div>
                    </div>

                    {{-- 2. JUDUL UTAMA & SUB JUDUL --}}
                    <h1 class="hero-main-title">
                        <span class="hero-title-gradient">SI-ADUAN</span>
                    </h1>
                    <h2 class="hero-sub-title">Sistem Pengaduan Dugaan Tindak Pidana Korupsi</h2>

                    {{-- 3. DESKRIPSI SINGKAT DENGAN SKALA RESPONSIF --}}
                    <p class="hero-text">
                        Laporkan dugaan tindak pidana korupsi secara aman dan terstruktur melalui
                        metode 5W+1H sesuai Perwako Tahun 2025. Identitas pelapor dilindungi sepenuhnya oleh hukum.
                    </p>

                    {{-- 4. TOMBOL AKSI UTAMA (CTA) --}}
                    <div class="btn-group hero-btn-group">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary hero-btn-main">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span>Buat Laporan Baru</span>
                                </a>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary hero-btn-outline">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                    </svg>
                                    <span>Riwayat Laporan</span>
                                </a>
                            @else
                                <a href="{{ route('complaint.public.step1.create') }}" class="btn btn-primary hero-btn-main">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span>Mulai Pengaduan</span>
                                </a>
                                <a href="{{ route('status.index') }}" class="btn btn-secondary hero-btn-outline">
                                    <svg class="hero-btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <span>Cek Status Tiket</span>
                                </a>
                            @endauth
                        @endif
                    </div>

                    {{-- 5. KARTU HIGHLIGHT FITUR & KEAMANAN (TRUST BADGES) --}}
                    <div class="hero-highlights">
                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Kerahasiaan Terjamin</span>
                                <span class="hero-highlight-sub">Identitas pelapor dilindungi penuh</span>
                            </div>
                        </div>

                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Metode 5W + 1H</span>
                                <span class="hero-highlight-sub">Laporan terstruktur & akurat</span>
                            </div>
                        </div>

                        <div class="hero-highlight-item">
                            <div class="hero-highlight-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                            <div class="hero-highlight-text">
                                <span class="hero-highlight-title">Respon Transparan</span>
                                <span class="hero-highlight-sub">Pantau proses tindak lanjut</span>
                            </div>
                        </div>
                    </div>

                    {{-- 6. INDIKATOR GULIR KE BAWAH (SCROLL DOWN) --}}
                    <a href="#about" class="hero-scroll-btn" aria-label="Gulir ke bagian Tentang Kami">
                        <span class="hero-scroll-mouse">
                            <span class="hero-scroll-dot"></span>
                        </span>
                        <span class="hero-scroll-text">Pelajari Lebih Lanjut</span>
                    </a>
                </div>
            </section>

            <section class="popular" id="about">
                <div class="container">
                    <h2 class="h2 section-title">Tentang SI-ADUAN</h2>

                    <p class="section-text">
                        SI-ADUAN adalah Sistem Informasi Pengaduan Dugaan Tindak Pidana Korupsi yang dikelola oleh
                        Inspektorat Kota Gorontalo. Melalui sistem ini, masyarakat dapat melaporkan berbagai
                        dugaan pelanggaran, penyimpangan, maupun penyalahgunaan wewenang yang terjadi
                        di lingkungan Pemerintah Kota Gorontalo secara aman dan terstruktur.
                    </p>

                    <h3 class="about-subheading">Mengapa Melapor Melalui SI-ADUAN?</h3>

                    <div class="popular-list">
                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/ho.png') }}" alt="Kerahasiaan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Kerahasiaan Terjamin</span>
                                </h3>
                                <p class="card-text">
                                    Identitas pelapor dijaga ketat dan dilindungi undang-undang.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/hihi.png') }}" alt="Cepat Transparan" loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Proses Cepat & Transparan</span>
                                </h3>
                                <p class="card-text">
                                    Setiap laporan diproses secara transparan dengan pembaruan status real-time.
                                </p>
                            </div>
                        </div>

                        <div class="popular-card">
                            <figure class="card-img">
                                <img src="{{ asset('images/pemerintah.png') }}" alt="Pemerintahan Bersih"
                                    loading="lazy">
                            </figure>
                            <div class="card-content">
                                <h3 class="h3 card-title">
                                    <span>Pemerintahan Bersih</span>
                                </h3>
                                <p class="card-text">
                                    Partisipasi Anda membantu mewujudkan tata kelola pemerintahan yang bersih dan akuntabel.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="gallery" id="gallery">
                <div class="container">
                    <h2 class="h2 section-title">Galeri Foto</h2>
                    <p class="section-text">
                        Selamat datang di Galeri Foto Inspektorat Kota Gorontalo! Di sini, Anda dapat menjelajahi
                        momen-momen berharga yang mencerminkan dedikasi, inovasi, dan kebersamaan tim kami.
                    </p>

                    <div class="gallery-slider-container">
                        <ul class="gallery-slider">
                            @forelse($galleries as $gallery)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({{ json_encode($gallery) }})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $gallery->title }}</h3>
                                            @if($gallery->description)
                                                <p class="gallery-desc">{{ $gallery->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @empty
                                {{-- Fallback data --}}
                                @php
                                    $fallbacks = [
                                        ['image' => 'images/1.jpg', 'title' => 'Kegiatan Inspektorat', 'desc' => 'Dokumentasi kegiatan rutin inspektorat kota Gorontalo.'],
                                        ['image' => 'images/3.jpg', 'title' => 'Rapat Koordinasi', 'desc' => 'Koordinasi bersama staf dan pimpinan.'],
                                        ['image' => 'images/2.jpg', 'title' => 'Kunjungan Kerja', 'desc' => 'Kunjungan kerja ke beberapa instansi terkait.'],
                                        ['image' => 'images/4.jpg', 'title' => 'Sosialisasi', 'desc' => 'Kegiatan sosialisasi kepada masyarakat.'],
                                        ['image' => 'images/5.jpg', 'title' => 'Pelatihan', 'desc' => 'Pelatihan peningkatan kapasitas pegawai.'],
                                    ];
                                @endphp
                                @foreach($fallbacks as $fb)
                                <li class="gallery-item-wrapper">
                                    <div class="gallery-card" onclick="openGalleryModal({'image_path': '{{ $fb['image'] }}', 'title': '{{ $fb['title'] }}', 'description': '{{ $fb['desc'] }}', 'is_local': true})">
                                        <figure class="gallery-banner">
                                            <img src="{{ asset($fb['image']) }}" alt="Gallery image">
                                        </figure>
                                        <div class="gallery-content">
                                            <h3 class="gallery-title">{{ $fb['title'] }}</h3>
                                            <p class="gallery-desc">{{ $fb['desc'] }}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endforelse
                        </ul>
                    </div>
                </div>
            </section>

            <section class="news" id="news">
                <div class="container">
                    <h2 class="h2 section-title">Berita Terkini</h2>
                    <p class="section-text">
                        Ikuti perkembangan terbaru dan informasi penting seputar kegiatan Inspektorat Kota Gorontalo.
                    </p>

                    @if($news->count() > 0)
                        <div class="news-slider-container">
                            <ul class="news-slider">
                                @foreach($news as $item)
                                    <li class="news-card-item">
                                        <div class="popular-card">
                                            <figure class="card-img">
                                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                                            </figure>
                                            <div class="card-content">
                                                <div class="card-rating">
                                                    <ion-icon name="calendar-outline"></ion-icon>
                                                    <data>{{ $item->created_at->format('d M Y') }}</data>
                                                </div>
                                                <h3 class="h3 card-title">
                                                    <a href="javascript:void(0)" onclick="openNewsModal({{ json_encode($item) }})">{{ Str::limit($item->title, 50) }}</a>
                                                </h3>
                                                <p class="card-text">
                                                    {{ Str::limit(strip_tags($item->content), 80) }}
                                                </p>
                                                <button class="btn-detail" onclick="openNewsModal({{ json_encode($item) }})">
                                                    Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div style="text-align: center; padding: 60px 20px;">
                            <div style="margin-bottom: 20px; color: #cbd5e1;">
                                <ion-icon name="newspaper-outline" style="font-size: 64px;"></ion-icon>
                            </div>
                            <h3 class="h3" style="color: #64748b; margin-bottom: 10px;">Belum ada berita saat ini</h3>
                            <p style="color: #94a3b8;">Nantikan informasi kegiatan terbaru dari Inspektorat Kota Gorontalo.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- News Modal --}}
            <div id="news-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeNewsModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="modal-img" src="" alt="News Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            {{-- Gallery Modal --}}
            <div id="gallery-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="modal-close-btn" onclick="closeGalleryModal()">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    <figure class="modal-img-wrapper">
                        <img id="gallery-modal-img" src="" alt="Gallery Image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px;">
                    </figure>
                    <div class="modal-body" style="margin-top: 15px;">
                        <span id="gallery-modal-date" class="modal-date" style="font-size: 0.9em; color: #666; display: block; margin-bottom: 5px;"></span>
                        <h2 id="gallery-modal-title" class="h2 modal-title" style="color: var(--gunmetal); margin-bottom: 15px;"></h2>
                        <div id="gallery-modal-desc" class="modal-desc" style="color: var(--sonic-silver); line-height: 1.6; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>

            <style>
                /* Modal Styles (Only minimal modal styles kept here if not in main CSS) */
                /* Actually let's move modal styles to main CSS too for cleanliness, but for this step I'll keep them or remove strictly if present in main CSS.
                   The user didn't ask to move modal styles but it's cleaner. 
                   Wait, I am replacing the big style block. I should preserve the modal styles unless I move them.
                   I didn't move modal styles to style.css yet.
                   I will keep the modal styles here for now or add them to the ReplacementContent.
                */
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    z-index: 1000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                    backdrop-filter: blur(5px);
                }
                .modal-content {
                    background: white;
                    padding: 25px;
                    border-radius: 15px;
                    max-width: 600px;
                    width: 100%;
                    max-height: 90vh;
                    overflow-y: auto;
                    position: relative;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                    animation: modalSlideIn 0.3s ease-out;
                }
                .modal-close-btn {
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    background: #f1f1f1;
                    border: none;
                    border-radius: 50%;
                    width: 32px;
                    height: 32px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 20px;
                    color: #333;
                    transition: background 0.2s;
                }
                .modal-close-btn:hover {
                    background: #e1e1e1;
                }
                @keyframes modalSlideIn {
                    from { transform: translateY(20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
            </style>

            <script>
                function openNewsModal(newsItem) {
                    const modal = document.getElementById('news-modal');
                    const img = document.getElementById('modal-img');
                    const title = document.getElementById('modal-title');
                    const date = document.getElementById('modal-date');
                    const desc = document.getElementById('modal-desc');

                    // Set Content
                    img.src = "{{ asset('storage/') }}/" + newsItem.image_path;
                    title.innerText = newsItem.title;
                    
                    // Format Date (Simple JS date)
                    const d = new Date(newsItem.created_at);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    date.innerText = d.toLocaleDateString('id-ID', options);
                    
                    desc.innerText = newsItem.content; // Use innerText to treat as plain text if content is plain, or innerHTML if it contains safe HTML

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                }

                function closeNewsModal() {
                    const modal = document.getElementById('news-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                // Close on click outside
                document.getElementById('news-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeNewsModal();
                    }
                });

                /* Gallery Modal Functions */
                function openGalleryModal(item) {
                    const modal = document.getElementById('gallery-modal');
                    const img = document.getElementById('gallery-modal-img');
                    const title = document.getElementById('gallery-modal-title');
                    const desc = document.getElementById('gallery-modal-desc');
                    const date = document.getElementById('gallery-modal-date');

                    const basePath = item.is_local ? "{{ asset('') }}" : "{{ asset('storage/') }}/";
                    // If item.image_path (from DB) or item.image_path (from fallback, wait fallback use 'image')
                    // Let's standardise
                    let imageSrc = '';
                    if(item.is_local) {
                        imageSrc = basePath + item.image_path; // item.image_path passed as "images/..."
                    } else {
                        imageSrc = basePath + item.image_path;
                    }
                    
                    img.src = imageSrc;
                    title.innerText = item.title;
                    desc.innerText = item.description || '';
                    
                    // Add date if available (optional, but matching news structure)
                    if(item.created_at) {
                         const d = new Date(item.created_at);
                         const options = { year: 'numeric', month: 'long', day: 'numeric' };
                         date.innerText = d.toLocaleDateString('id-ID', options);
                         date.style.display = 'block';
                    } else {
                        date.style.display = 'none';
                    }

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }

                function closeGalleryModal() {
                    const modal = document.getElementById('gallery-modal');
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }

                document.getElementById('gallery-modal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeGalleryModal();
                    }
                });
            </script>

            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-content">
                        <p class="section-subtitle">Hubungi Kami</p>
                        <h2 class="h2 section-title">Ada Pertanyaan atau Masukan?</h2>
                        <p class="section-text">
                            Tim Inspektorat Kota Gorontalo siap membantu Anda. Jangan ragu untuk menghubungi kami
                            jika memiliki pertanyaan, saran, atau membutuhkan bantuan terkait pelaporan.
                        </p>
                    </div>
                    <a href="#gg" class="btn btn-secondary">Hubungi Kami</a>
                </div>
            </section>

        </article>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">
                        <img src="{{ asset('images/test.png') }}" alt="Inspektorat logo">
                    </a>
                    <p class="footer-text">
                        SI-ADUAN — Sistem Informasi Pengaduan Dugaan Tindak Pidana Korupsi
                        Inspektorat Kota Gorontalo.
                    </p>
                </div>

                <div class="footer-contact">
                    <h4 class="contact-title" id="gg">Hubungi Kami</h4>
                    <p class="contact-text">Kami siap membantu Anda.</p>
                    <ul>
                        <li class="contact-item">
                            <ion-icon name="call-outline"></ion-icon>
                            <a href="tel:+6282349656594" class="contact-link">+62823-49-6565-94</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="mail-outline"></ion-icon>
                            <a href="mailto:inspektoratgtlo@gmail.com"
                                class="contact-link">inspektoratgtlo@gmail.com</a>
                        </li>
                        <li class="contact-item">
                            <ion-icon name="location-outline"></ion-icon>
                            <address>Jl. Achmad Nadjamuddin No 11 Wumialo Kota Gorontalo, Gorontalo</address>
                        </li>
                    </ul>
                </div>

                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d558.6719892285665!2d123.05598984058676!3d0.5572244054739232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1768815766156!5m2!1sid!2sid"
                        width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright-container">
                <p class="copyright">
                    © {{ date('Y') }} <a href="">Inspektorat Kota Gorontalo</a>. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>

    <script src="{{ asset('js/script1.js') }}"></script>

    <script>
        // Keyboard and scrollspy controls for sidebar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const navbar = document.querySelector('[data-navbar]');
                const overlay = document.querySelector('[data-overlay]');
                if (navbar && navbar.classList.contains('active')) {
                    navbar.classList.remove('active');
                    if (overlay) overlay.classList.remove('active');
                }
            }
        });

        // Scrollspy to update active state on sidebar and desktop navbar links
        const trackedSections = document.querySelectorAll('section[id]');
        const sidebarSectionLinks = document.querySelectorAll('.sidebar-link[data-nav-link]');
        const desktopNavLinks = document.querySelectorAll('.desktop-nav .navbar-link');

        window.addEventListener('scroll', function() {
            let currentSection = '';
            const scrollPos = window.pageYOffset;

            trackedSections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 120;
                const sectionId = section.getAttribute('id');

                if (scrollPos > sectionTop && scrollPos <= sectionTop + sectionHeight) {
                    currentSection = sectionId;
                }
            });

            if (currentSection) {
                sidebarSectionLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });

                desktopNavLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });
            }
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
