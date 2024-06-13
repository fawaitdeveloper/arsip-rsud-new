<li class="nav-item navbar-dropdown dropdown me-3">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div style="width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center"
            class="{{ count($notifications) > 0 ? 'bg-warning' : 'bg-danger' }}">
            <i class='bx bxs-bell fa-2x text-center text-white'></i>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li class="text-center mt-3">
            <h5>Notifikasi</h5>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        @if (count($notifications) > 0)
            @foreach ($notifications as $item)
                <li class="dropdown-item">
                    <span class="d-block fw-semibold">{{ $item->title }}</span>
                    <span
                        class="text-muted d-block">{{ strlen($item->body) > 50 ? substr($item->body, 0, 50) . ' ...' : $item->body }}</span>
                    <span style="font-size: 10px;"
                        class="text-success">{{ date('d M Y', strtotime($item->created_at)) }}
                        {{ date('h:i', strtotime($item->created_at)) }} WIB</span>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            @endforeach
        @else
            <li class="dropdown-item">
                <span>Tidak ada notifikasi</span>
            </li>
        @endif
    </ul>
</li>
