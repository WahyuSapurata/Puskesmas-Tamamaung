<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" width="160" />
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item {{ active_class(['admin/puskesmas*']) }}">
          <a href="{{ route('puskesmas.index') }}" class="nav-link">
            <i class="link-icon" data-feather="trello"></i>
            <span class="link-title">Data Puskesmas</span>
          </a>
        </li>
        @endif
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'puskesmas')
        <li class="nav-item {{ active_class(['posyandu*']) }}">
          <a href="{{ route('posyandu.index') }}" class="nav-link">
            <i class="link-icon" data-feather="server"></i>
            <span class="link-title">Data Posyandu</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['report*']) }}">
          <a href="{{ route('pendataan.report') }}" class="nav-link">
            <i class="link-icon" data-feather="command"></i>
            <span class="link-title">Data Bayi</span>
          </a>
        </li>
        @endif
        @if (Auth::user()->role == 'posyandu')
        <li class="nav-item {{ active_class(['pendataan/create']) }}">
          <a href="{{ route('pendataan.create') }}" class="nav-link">
            <i class="link-icon" data-feather="layout"></i>
            <span class="link-title">Form Pendataan</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['pendataan']) }}">
          <a href="{{ route('pendataan.index') }}" class="nav-link">
            <i class="link-icon" data-feather="refresh-ccw"></i>
            <span class="link-title">Riwayat Pendataan</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
</nav>
