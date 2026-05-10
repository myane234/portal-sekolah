<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel – {{ config('app.name', 'Portal Sekolah') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Inter', sans-serif; }
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-border: #1e293b;
            --sidebar-hover: #1e293b;
            --sidebar-active: #3b82f6;
            --topbar-bg: #ffffff;
            --content-bg: #f1f5f9;
            --text-primary: #0f172a;
            --text-muted: #64748b;
            --accent: #3b82f6;
            --accent-dark: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        body { background: var(--content-bg); margin: 0; }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
            border-right: 1px solid var(--sidebar-border);
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            flex-shrink: 0;
        }
        .sidebar-brand h1 {
            font-size: 17px; font-weight: 700;
            color: #ffffff; margin: 0;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand h1 .brand-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .sidebar-brand p {
            color: #64748b; font-size: 11px; margin: 4px 0 0 42px;
        }
        .sidebar-nav { flex: 1; padding: 16px 12px; }
        .nav-section-label {
            font-size: 10px; font-weight: 600; letter-spacing: 0.1em;
            color: #475569; text-transform: uppercase;
            padding: 0 8px; margin: 16px 0 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: #94a3b8; font-size: 13.5px; font-weight: 500;
            text-decoration: none; transition: all 0.2s ease;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: var(--sidebar-hover); color: #e2e8f0; }
        .nav-item.active {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--sidebar-border);
        }
        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 8px;
            background: var(--sidebar-hover);
        }
        .user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .user-info .user-name { font-size: 13px; font-weight: 600; color: #e2e8f0; }
        .user-info .user-role { font-size: 11px; color: #64748b; }

        /* Top Bar */
        .admin-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 60px;
            background: var(--topbar-bg);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 90;
        }
        .topbar-title { font-size: 16px; font-weight: 600; color: var(--text-primary); }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .logout-btn {
            display: flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 6px;
            background: transparent; border: 1px solid #e2e8f0;
            color: #64748b; font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .logout-btn:hover { background: #f8fafc; border-color: #cbd5e1; color: #0f172a; }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            padding-top: 60px;
            min-height: 100vh;
        }
        .admin-content { padding: 28px; }

        /* Page Header */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-header h2 {
            font-size: 22px; font-weight: 700;
            color: var(--text-primary); margin: 0;
        }
        .page-header p { color: var(--text-muted); font-size: 13px; margin: 4px 0 0; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 8px; font-size: 13.5px; font-weight: 500; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: var(--accent-dark); color: white; }
        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #fecaca; }
        .btn-secondary { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-secondary:hover { background: #e2e8f0; color: #0f172a; }
        .btn-sm { padding: 6px 12px; font-size: 12.5px; }

        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h3 { font-size: 15px; font-weight: 600; color: #0f172a; margin: 0; }
        .card-body { padding: 24px; }

        /* Table */
        .table-wrapper { overflow-x: auto; }
        table.admin-table { width: 100%; border-collapse: collapse; }
        .admin-table thead th {
            padding: 11px 16px;
            background: #f8fafc;
            font-size: 11.5px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.05em;
            color: #64748b; text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .admin-table tbody td {
            padding: 14px 16px;
            font-size: 13.5px; color: #374151;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .admin-table tbody tr:hover { background: #fafafa; }
        .admin-table tbody tr:last-child td { border-bottom: none; }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-blue { background: #eff6ff; color: #2563eb; }
        .badge-green { background: #f0fdf4; color: #16a34a; }
        .badge-yellow { background: #fffbeb; color: #d97706; }
        .badge-purple { background: #f5f3ff; color: #7c3aed; }
        .badge-red { background: #fef2f2; color: #dc2626; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px; }
        .form-label span.required { color: #ef4444; margin-left: 2px; }
        .form-control {
            width: 100%; padding: 9px 13px;
            border: 1px solid #d1d5db; border-radius: 8px;
            font-size: 13.5px; color: #111827;
            background: white; transition: all 0.2s;
            box-sizing: border-box;
        }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .form-control::placeholder { color: #9ca3af; }
        textarea.form-control { resize: vertical; }
        select.form-control { cursor: pointer; }

        /* File Upload */
        .file-upload-area {
            border: 2px dashed #d1d5db; border-radius: 10px;
            padding: 24px; text-align: center;
            cursor: pointer; transition: all 0.2s;
            background: #f9fafb;
        }
        .file-upload-area:hover { border-color: #3b82f6; background: #eff6ff; }
        .file-upload-area input { display: none; }
        .file-upload-area svg { width: 32px; height: 32px; color: #9ca3af; margin: 0 auto 8px; display: block; }
        .file-upload-area p { font-size: 13px; color: #6b7280; margin: 0; }
        .file-upload-area p span { color: #3b82f6; font-weight: 500; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .stat-card {
            background: white; border-radius: 12px;
            border: 1px solid #e2e8f0; padding: 20px;
            display: flex; align-items: center; gap: 16px;
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-info .stat-value { font-size: 26px; font-weight: 700; color: #0f172a; line-height: 1; }
        .stat-info .stat-label { font-size: 12.5px; color: #64748b; margin-top: 4px; }

        /* Alert/flash */
        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        .alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        /* Thumbnail */
        .thumb { width: 44px; height: 44px; border-radius: 8px; object-fit: cover; background: #f1f5f9; }

        /* Form section divider */
        .form-section { margin-bottom: 28px; }
        .form-section-title { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #64748b; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0; margin-bottom: 18px; }

        /* Image preview */
        #imagePreview, #logoPreview { display: none; margin-top: 10px; }
        #imagePreview img, #logoPreview img { max-height: 160px; border-radius: 8px; border: 1px solid #e2e8f0; }

        /* Grid 2 cols */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }

        /* Empty state */
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-state svg { width: 48px; height: 48px; color: #d1d5db; margin: 0 auto 12px; display: block; }
        .empty-state h3 { font-size: 15px; font-weight: 600; color: #374151; margin: 0 0 4px; }
        .empty-state p { font-size: 13px; color: #9ca3af; margin: 0; }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h1>
            <img src="{{ asset('school.webp') }}" alt="Logo" class="brand-icon">
            Portal Admin
        </h1>
        <p>SMKN 2 Jakarta</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-section-label">Konten</div>
        <a href="{{ route('admin.berita.index') }}" class="nav-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            Berita
        </a>
        <a href="{{ route('admin.eskul.index') }}" class="nav-item {{ request()->routeIs('admin.eskul.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Ekstrakurikuler
        </a>
        <a href="{{ route('admin.agenda.index') }}" class="nav-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Agenda
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </div>
</aside>

<!-- Top Bar -->
<header class="admin-topbar">
    <span class="topbar-title">
        @isset($header){{ $header }}@endisset
    </span>
    <div class="topbar-actions">
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</header>

<!-- Main Content -->
<main class="admin-main">
    <div class="admin-content">
        @if (session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif
        {{ $slot }}
    </div>
</main>

</body>
</html>
