<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <img src="{{ asset('assets/img/wonogiri.png') }}" alt="logo" width="40px">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">E-Arsip</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @can('secretary')
            @include('dashboard.layouts.menu')
        @endcan

        @can('admin')
            @include('dashboard.layouts.menu')
        @endcan
        @can('user')
            @include('dashboard.layouts.menu')
        @endcan
    </ul>
</aside>
