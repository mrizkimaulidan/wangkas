<div class="sidebar-header">
    <div class="d-flex justify-content-between">
        <div class="logo">
            <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        </div>
        <div class="toggler">
            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
    </div>
</div>
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-title"><i class="bi bi-menu-button-wide"></i></li>

        <li class="sidebar-item {{ request()->is('pelajar*') ? 'active' : '' }}">
            <a href="{{ route('pelajar.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Pelajar</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('kelas*') ? 'active' : '' }}">
            <a href="{{ route('kelas.index') }}" class='sidebar-link'>
                <i class="bi bi-bookmark-fill"></i>
                <span>Kelas</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('jurusan*') ? 'active' : '' }}">
            <a href="{{ route('jurusan.index') }}" class='sidebar-link'>
                <i class="bi bi-briefcase-fill"></i>
                <span>Jurusan</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('kas*') ? 'active' : '' }}">
            <a href="{{ route('kas.index') }}" class='sidebar-link'>
                <i class="bi bi-cash-stack"></i>
                <span>Kas</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <a href="{{ route('laporan.index') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('administrator*') ? 'active' : '' }}">
            <a href="{{ route('administrator.index') }}" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Administrator</span>
            </a>
        </li>

        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                    class='sidebar-link'>
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </form>
        </li>

    </ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>