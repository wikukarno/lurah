@if (Auth::user()->roles == 'Lurah')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/public">
                <img alt="image" src="{{ asset('assets/images/logo.jpg') }}" style="max-height: 50px"
                    class="header-logo" />
                <span class="logo-name">Lurah Sorek Satu</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LSS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('pages/dashboard/lurah') ? 'active' : '') }}">
                <a href="{{ route('lurah.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="{{ (request()->is('pages/dashboard/lurah/sku-lurah') ? 'active' : '') }}">
                <a href="{{ route('sku-lurah.index') }}" class="nav-link"><i class="fas fa-store"></i>
                    <span>SK Usaha</span></a>
            </li>
            <li class="{{ (request()->is('pages/dashboard/lurah/skp-lurah') ? 'active' : '') }}">
                <a href="{{ route('skp-lurah.index') }}" class="nav-link"><i class="fas fa-file"></i>
                    <span>SK Pemakaman</span></a>
            </li>
            <li class="{{ (request()->is('pages/dashboard/lurah/sktm-lurah') ? 'active' : '') }}">
                <a href="{{ route('sktm-lurah.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Tidak Mampu</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/lurah/ski-lurah') ? 'active' : '') }}">
                <a href="{{ route('ski-lurah.index') }}" class="nav-link"><i class="fas fa-info-circle"></i>
                    <span>SK Izin</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/lurah/laporan') ? 'active' : '') }}">
                <a href="{{ route('lurah.laporan') }}" class="nav-link"><i class="fas fa-flag"></i>
                    <span>Laporan</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/lurah/penduduk') ? 'active' : '') }}">
                <a href="{{ route('lurah.penduduk') }}" class="nav-link"><i class="fas fa-users"></i>
                    <span>Data Pengguna</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/lurah/akun-lurah') ? 'active' : '') }}">
                <a href="{{ route('akun-lurah.index') }}" class="nav-link"><i class="fas fa-user"></i>
                    <span>Akun</span></a>
            </li>



        </ul>

        <div class="mt-3 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" data-toggle="modal"
                data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>
</div>
@endif

@if (Auth::user()->roles == 'Staff')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/public">
                <img alt="image" src="{{ asset('assets/images/logo.jpg') }}" style="max-height: 50px"
                    class="header-logo" />
                <span class="logo-name">Lurah Sorek Satu</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LSS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('pages/dashboard/staff') ? 'active' : '') }}">
                <a href="{{ route('staff.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="{{ (request()->is('pages/dashboard/staff/sku-staff') ? 'active' : '') }}">
                <a href="{{ route('sku-staff.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Usaha</span></a>
            </li>
            <li class="{{ (request()->is('pages/dashboard/staff/skp-staff') ? 'active' : '') }}">
                <a href="{{ route('skp-staff.index') }}" class="nav-link"><i class="fas fa-file"></i>
                    <span>SK Pemakaman</span></a>
            </li>
            <li class="{{ (request()->is('pages/dashboard/staff/sktm-staff') ? 'active' : '') }}">
                <a href="{{ route('sktm-staff.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Tidak Mampu</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/staff/ski-staff') ? 'active' : '') }}">
                <a href="{{ route('ski-staff.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Izin</span></a>
            </li>

            <li class="{{ (request()->is('pages/dashboard/staff/penduduk') ? 'active' : '') }}">
                <a href="{{ route('staff.penduduk') }}" class="nav-link"><i class="fas fa-users"></i>
                    <span>Data Pengguna</span></a>
            </li>

            <li
                class="{{ (request()->is('pages/dashboard/staff/akun-staff') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/ski-user/create') ? 'active' : '') }}">
                <a href="{{ route('akun-staff.index') }}" class="nav-link"><i class="fas fa-user"></i>
                    <span>Akun</span></a>
            </li>
        </ul>

        <div class="mt-3 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" data-toggle="modal"
                data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>
</div>
@endif

@if (Auth::user()->roles == 'User')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/public">
                <img alt="image" src="{{ asset('assets/images/logo.jpg') }}" style="max-height: 50px"
                    class="header-logo" />
                <span class="logo-name">Lurah Sorek Satu</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LSS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('pages/dashboard/user') ? 'active' : '') }}">
                <a href="{{ route('user.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li
                class="{{ (request()->is('pages/dashboard/user/sku-user') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/sku-user/create') ? 'active' : '') }}">
                <a href="{{ route('sku-user.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Usaha</span></a>
            </li>
            <li
                class="{{ (request()->is('pages/dashboard/user/skp-user') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/skp-user/create') ? 'active' : '') }}">
                <a href="{{ route('skp-user.index') }}" class="nav-link"><i class="fas fa-file"></i>
                    <span>SK Pemakaman</span></a>
            </li>
            <li
                class="{{ (request()->is('pages/dashboard/user/sktm-user') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/sktm-user/create') ? 'active' : '') }}">
                <a href="{{ route('sktm-user.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Tidak Mampu</span></a>
            </li>

            <li
                class="{{ (request()->is('pages/dashboard/user/ski-user') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/ski-user/create') ? 'active' : '') }}">
                <a href="{{ route('ski-user.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>SK Izin</span></a>
            </li>

            <li
                class="{{ (request()->is('pages/dashboard/user/akun-user') ? 'active' : '') }} {{ (request()->is('pages/dashboard/user/ski-user/create') ? 'active' : '') }}">
                <a href="{{ route('akun-user.index') }}" class="nav-link"><i class="fas fa-user"></i>
                    <span>Akun</span></a>
            </li>
        </ul>

        <div class="mt-3 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" data-toggle="modal"
                data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>
</div>
@endif