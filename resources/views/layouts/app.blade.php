
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inquiry System') | ELC Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <span class="brand-icon">E</span>
            <span>ELC <small>INQUIRY PORTAL</small></span>
        </a>

        <div class="nav-label">MAIN MENU</div>
        <a href="{{ route('dashboard') }}" class="nav-link-custom">▦ Dashboard</a>
        <a href="{{ route('inquiries.create') }}" class="nav-link-custom">＋ Add Query</a>
        <a href="{{ route('inquiries.index') }}" class="nav-link-custom">☷ List Queries</a>

        <div class="sidebar-bottom">
            <div class="user-chip">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="user-info">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Administrator</small>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn" type="submit">↪ Logout</button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <button class="menu-toggle" id="menuToggle" type="button">☰</button>
            <div>
                <span class="topbar-title">@yield('heading', 'Dashboard')</span>
                <div class="topbar-subtitle">ELC Institute · Inquiry Management</div>
            </div>
            <div class="topbar-date">{{ now()->format('d M Y') }}</div>
        </header>

        <section class="page-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please check the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
