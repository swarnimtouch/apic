<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin Panel') — Apic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:        #0a0f1e;
            --surface:   #111827;
            --surface2:  #1a2438;
            --border:    #1f2f4a;
            --accent:    #00d4ff;
            --accent2:   #7c3aed;
            --green:     #00e5a0;
            --orange:    #ff6b35;
            --text:      #e2e8f0;
            --muted:     #64748b;
            --sidebar-w: 260px;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            top: 0; left: 0;
            transition: transform .3s ease;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo .logo-mark {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .logo-brand-img {
            max-height: 28px;
            max-width: 130px;
            object-fit: contain;
            display: block;
        }

        .logo-text {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 18px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: none; /* shown by JS if image fails */
        }

        .logo-sub {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
            letter-spacing: .05em;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 12px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .12em;
            color: var(--muted);
            text-transform: uppercase;
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: var(--surface2);
            color: var(--text);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(0,212,255,.12), rgba(124,58,237,.12));
            color: var(--accent);
            border: 1px solid rgba(0,212,255,.15);
        }

        .nav-item .nav-icon {
            width: 20px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px 24px;
            border-top: 1px solid var(--border);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: var(--surface2);
            border-radius: 10px;
            margin-bottom: 8px;
        }

        .admin-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-role {
            font-size: 11px;
            color: var(--muted);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #ff4d6d;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all .2s;
            border: 1px solid transparent;
        }

        .logout-btn:hover {
            background: rgba(255,77,109,.08);
            border-color: rgba(255,77,109,.2);
        }

        /* ── MAIN CONTENT ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            cursor: pointer;
            text-decoration: none;
            color: var(--text);
            transition: all .2s;
            position: relative;
        }

        .topbar-icon-btn:hover {
            border-color: var(--accent);
            background: rgba(0,212,255,.08);
        }

        /* green dot on user icon */
        .topbar-icon-btn.user-btn::after {
            content: '';
            position: absolute;
            bottom: 6px; right: 6px;
            width: 7px; height: 7px;
            background: var(--green);
            border-radius: 50%;
            border: 1.5px solid var(--surface);
        }

        .topbar-logout {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: rgba(255,77,109,.08);
            border: 1px solid rgba(255,77,109,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            cursor: pointer;
            text-decoration: none;
            color: #ff4d6d;
            transition: all .2s;
        }

        .topbar-logout:hover {
            background: rgba(255,77,109,.18);
            border-color: rgba(255,77,109,.45);
            transform: scale(1.05);
        }

        /* ── USER DROPDOWN ── */
        .user-dropdown-wrap {
            position: relative;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            min-width: 200px;
            box-shadow: 0 16px 40px rgba(0,0,0,.5);
            z-index: 200;
            overflow: hidden;
            animation: dropDown .18s ease;
        }

        .user-dropdown.open { display: block; }

        @keyframes dropDown {
            from { opacity:0; transform: translateY(-6px); }
            to   { opacity:1; transform: translateY(0); }
        }

        .dropdown-header {
            padding: 14px 16px 12px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .dropdown-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-role {
            font-size: 11px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .dropdown-role::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--green);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dropdown-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #ff4d6d;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background .15s;
        }

        .dropdown-logout:hover {
            background: rgba(255,77,109,.08);
        }

        .hamburger {
            display: none;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-size: 18px;
            cursor: pointer;
            width: 38px; height: 38px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: border-color .2s;
        }
        .hamburger:hover { border-color: var(--accent); }

        .content {
            padding: 32px;
            flex: 1;
        }

        /* ── ALERTS ── */
        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(0,229,160,.08);
            border-color: rgba(0,229,160,.25);
            color: var(--green);
        }

        .alert-error {
            background: rgba(255,77,109,.08);
            border-color: rgba(255,77,109,.25);
            color: #ff4d6d;
        }

        /* ── OVERLAY ── */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.65);
            z-index: 90;
            backdrop-filter: blur(2px);
        }
        .overlay.show { display: block; }

        /* ── TABLET (≤1024px) ── */
        @media (max-width: 1024px) {
            :root { --sidebar-w: 220px; }
            .content { padding: 24px 20px; }
        }

        /* ── MOBILE (≤768px) ── */
        @media (max-width: 768px) {
            :root { --sidebar-w: 260px; }
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 4px 0 24px rgba(0,0,0,.5);
            }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .hamburger { display: flex; }
            .topbar { padding: 0 16px; height: 58px; }
            .page-title { font-size: 15px; }
            .content { padding: 16px 12px; }
            .topbar-icon-btn, .topbar-logout {
                width: 34px; height: 34px; font-size: 15px;
            }
        }

        /* ── SMALL PHONES (≤480px) ── */
        @media (max-width: 480px) {
            .topbar-right { gap: 8px; }
            .content { padding: 12px 10px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-mark">
            <div class="logo-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                     style="width:100%;height:100%;object-fit:cover;border-radius:10px;"
                     onerror="this.style.display='none';this.parentElement.innerHTML='🏥'">
            </div>
            <div>
                {{-- Brand image: public/images/brand.png --}}
                <img class="logo-brand-img"
                     src="{{ asset('images/brand.png') }}" alt="Brand"
                     onerror="this.style.display='none'; document.getElementById('sidebarBrandText').style.display='block'">
                <span class="logo-text" id="sidebarBrandText">Admin Panel</span>
                <div class="logo-sub">Medical Dashboard</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-label">Main</div>
            <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⚡</span> Dashboard
            </a>
        </div>
        <div class="nav-section">
            <div class="nav-label">Management</div>
            <a href="/admin/doctors" class="nav-item {{ request()->is('admin/doctors') ? 'active' : '' }}">
                <span class="nav-icon">👨‍⚕️</span> Doctors
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar">{{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}</div>
            <div>
                <div class="admin-name">{{ session('admin_name', 'Admin') }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div style="display:flex;align-items:center;gap:12px">
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="topbar-right">
            <div class="user-dropdown-wrap">
                <div class="topbar-icon-btn user-btn" id="userIconBtn" onclick="toggleDropdown()" title="Account">
                    👤
                </div>
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-avatar">{{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}</div>
                        <div>
                            <div class="dropdown-name">{{ session('admin_name', 'Admin') }}</div>
                            <div class="dropdown-role">Online</div>
                        </div>
                    </div>
                    <a href="/admin/logout" class="dropdown-logout">
                        🚪 Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">❌ {{ $errors->first() }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }

    function toggleDropdown() {
        document.getElementById('userDropdown').classList.toggle('open');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const wrap = document.querySelector('.user-dropdown-wrap');
        if (wrap && !wrap.contains(e.target)) {
            document.getElementById('userDropdown').classList.remove('open');
        }
    });
</script>
@stack('scripts')
</body>
</html>
