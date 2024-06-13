    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Kelola</span>
    </li>
    <li class="menu-item {{ Request::is('filemanager') ? 'active' : '' }}">
        <a href="/filemanager" class="menu-link">
            <i class='menu-icon tf-icons bx bxs-folder-open'></i>
            <div data-i18n="Analytics">Manajemen File</div>
        </a>
    </li>
    @if (auth()->user()->role == 'admin')
        <li class="menu-item {{ Request::is('filemanager') ? 'active' : '' }}">
            <a href="/user-monitoring/actions-monitoring" class="menu-link">
                {{-- <i class='menu-icon tf-icons bx bxs-folder-open'></i> --}}
                <i class='menu-icon tf-icons bx bx-run'></i>
                <div data-i18n="Analytics">Aktifitas User</div>
            </a>
        </li>
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Unit</span>
        </li>
        <li class="menu-item {{ Request::is('induk-unit-kerja') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div data-i18n="Induk Unit">Induk Unit</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('induk-unit-kerja') ? 'active' : '' }}">
                    <a href="/induk-unit-kerja" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Induk Unit</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ Request::is('unit-kerja') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-briefcase"></i>
                <div data-i18n="Authentications">Unit Kerja</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('unit-kerja') ? 'active' : '' }}">
                    <a href="/unit-kerja" class="menu-link">
                        <div data-i18n="Basic">Data Unit Kerja</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen Pengguna</span></li>
        <!-- Cards -->
        {{-- <li
            class="menu-item {{ Request::is('jabatan') || Request::is('grup-jabatan') || Request::is('induk-jabatan') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Induk Unit">Jabatan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('grup-jabatan') ? 'active' : '' }}">
                    <a href="/grup-jabatan" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Grup Jabatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('induk-jabatan') ? 'active' : '' }}">
                    <a href="/induk-jabatan" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Induk Jabatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('jabatan') ? 'active' : '' }}">
                    <a href="/jabatan" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Jabatan</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- core -->
        <li
            class="menu-item {{ Request::is('job-level') || Request::is('job-position') || Request::is('letter-category') || Request::is('letter-urgency') || Request::is('letter-attribute') || Request::is('employee') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Induk Unit">Core</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('job-position') ? 'active' : '' }}">
                    <a href="/job-position" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Posisi</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('employee') ? 'active' : '' }}">
                    <a href="{{ route('employee.index') }}" class="menu-link">
                        <div data-i18n="Data Induk Unit">Data Karyawan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('letter-category') ? 'active' : '' }}">
                    <a href="/letter-category" class="menu-link">
                        <div data-i18n="Data Kategori Pengguna">Data Kategori Surat</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('letter-urgency') ? 'active' : '' }}">
                    <a href="/letter-urgency" class="menu-link">
                        <div data-i18n="Data Kategori Pengguna">Data Urgensi Surat</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('letter-attribute') ? 'active' : '' }}">
                    <a href="/letter-attribute" class="menu-link">
                        <div data-i18n="Data Kategori Pengguna">Data Sifat Surat</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('user-category') || Request::is('users') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div data-i18n="Induk Unit">Pengguna</div>
            </a>
            <ul class="menu-sub">
                {{-- <li class="menu-item {{ Request::is('user-category') ? 'active' : '' }}">
                    <a href="/user-category" class="menu-link">
                        <div data-i18n="Data Kategori Pengguna">Data Kategori Pengguna</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ Request::is('users') ? 'active' : '' }}">
                    <a href="/users" class="menu-link">
                        <div data-i18n="Data Pengguna">Data Pengguna</div>
                    </a>
                </li>
            </ul>
        </li>
    @else
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Naskah Dinas</span>
        </li>
        <li
            class="menu-item {{ Request::is('naskah-masuk*') || Request::is('naskah-keluar*') || Request::is('naskah-disposisi') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Induk Unit">Data Naskah</div>
            </a>
            <ul class="menu-sub">
                {{-- <li class="menu-item {{ Request::is('naskah-masuk/create') ? 'active' : '' }}">
                    <a href="/naskah-masuk/create" class="menu-link">
                        <div data-i18n="Data Naskah Masuk">Registrasi Naskah Masuk</div>
                    </a>
                </li> --}}
                {{-- <li class="menu-item {{ Request::is('naskah-keluar/create') ? 'active' : '' }}">
                <a href="/naskah-keluar/create" class="menu-link">
                    <div data-i18n="Data Naskah Masuk">Registrasi Naskah Keluar</div>
                </a>
            </li> --}}
                <li
                    class="menu-item {{ Request::getRequestUri() == '/naskah-keluar/create?type=nota-dinas' || Request::getRequestUri() == '/naskah-keluar/create?type=surat-edaran' ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Authentications">Registrasi Naskah Keluar</div>
                    </a>
                    <ul class="menu-sub">
                        <li
                            class="menu-item {{ Request::getRequestUri() == '/naskah-keluar/create?type=nota-dinas' ? 'active' : '' }}">
                            <a href="{{ route('naskah-keluar.create') }}?type=nota-dinas" class="menu-link">
                                <div data-i18n="Basic">Nota Dinas</div>
                            </a>
                        </li>
                        @if (auth()->user()->jobPosition->name == 'Direktur')
                            <li
                                class="menu-item {{ Request::getRequestUri() == '/naskah-keluar/create?type=surat-edaran' ? 'active' : '' }}">
                                <a href="{{ route('naskah-keluar.create') }}?type=surat-edaran" class="menu-link">
                                    <div data-i18n="Basic">Surat Edaran</div>
                                </a>
                            </li>
                            <li
                                class="menu-item {{ Request::getRequestUri() == '/naskah-keluar/create?type=surat-undangan' ? 'active' : '' }}">
                                <a href="{{ route('naskah-keluar.create') }}?type=surat-undangan" class="menu-link">
                                    <div data-i18n="Basic">Surat Undangan</div>
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
            <li class="menu-item {{ Request::is('naskah-masuk') ? 'active' : '' }}">
                <a href="/naskah-masuk" class="menu-link">
                    <div data-i18n="Data Naskah Masuk">Data Naskah Masuk</div>
                </a>
            </li>
        </ul>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('naskah-keluar') ? 'active' : '' }}">
                <a href="/naskah-keluar" class="menu-link">
                    <div data-i18n="Data Naskah Keluar">Data Naskah Keluar</div>
                </a>
            </li>
        </ul>
        {{-- <ul class="menu-sub">
            <li class="menu-item {{ Request::is('naskah-disposisi') ? 'active' : '' }}">
                <a href="/naskah-disposisi" class="menu-link">
                    <div data-i18n="Data Naskah Disposisi">Data Naskah Disposisi</div>
                </a>
            </li>
        </ul> --}}
    </li>
    {{-- <li class="menu-item {{ Request::is('unit-kerja') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-note"></i>
            <div data-i18n="Authentications">Template Naskah</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('unit-kerja') ? 'active' : '' }}">
                <a href="/unit-kerja" class="menu-link">
                    <div data-i18n="Basic">Data Template Naskah</div>
                </a>
            </li>
        </ul>
    </li>
    <li
        class="menu-item {{ Request::is('signing*') || Request::is('verificator*') || Request::is('purpose*') || Request::is('group-purpose*') || Request::is('group-disposition*') || Request::is('translucent*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div data-i18n="Authentications">Pengaturan</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('signing*') ? 'active' : '' }}">
                <a href="/signing" class="menu-link">
                    <div data-i18n="Basic">Daftar Penandatanganan</div>
                </a>
            </li>
            <li class="menu-item  {{ Request::is('verificator*') ? 'active' : '' }}">
                <a href="/verificator" class="menu-link">
                    <div data-i18n="Basic">Daftar Verifikator</div>
                </a>
            </li>
            <li class="menu-item  {{ Request::is('purpose*') ? 'active' : '' }}">
                <a href="/purpose" class="menu-link">
                    <div data-i18n="Basic">Daftar Tujuan</div>
                </a>
            </li>
            <li class="menu-item  {{ Request::is('group-purpose*') ? 'active' : '' }}">
                <a href="/group-purpose" class="menu-link">
                    <div data-i18n="Basic">Daftar Group Tujuan</div>
                </a>
            </li>
            <li class="menu-item  {{ Request::is('group-disposition*') ? 'active' : '' }}">
                <a href="/group-disposition" class="menu-link">
                    <div data-i18n="Basic">Daftar Group Tujuan Disposisi</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('translucent*') ? 'active' : '' }}">
                <a href="/translucent" class="menu-link">
                    <div data-i18n="Basic">Daftar Tembusan</div>
                </a>
            </li>
        </ul>
    </li> --}}
@endif
