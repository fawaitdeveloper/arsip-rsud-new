<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar">
            {{-- <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" /> --}}
            <div class="avatar avatar-online rounded-circle d-flex justify-content-center align-items-center"
                style="width: 40px; height: 40px; background: #{{ random_color() }}">
                <span class="fw-bold text-white">{{ getFirstCharacterUser() }}</span>
                {{-- <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" /> --}}
            </div>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 40px; height: 40px; background: #{{ random_color() }}">
                            <span class="fw-bold text-white">{{ getFirstCharacterUser() }}</span>
                            {{-- <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" /> --}}
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                        <small class="text-muted">{{ auth()->user()->jobPosition->name ?? '' }}</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('profile-setting.get') }}">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">Pengaturan Akun</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('reset-password.get') }}">
                <i class='bx bx-key me-2'></i>
                <span class="align-middle">Atur Ulang Password</span>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Keluar</span>
                </button>
            </form>
        </li>
    </ul>
</li>
