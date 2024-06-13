<div class="col-lg-6 col-md-12 col-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                        class="rounded" />
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('naskah-masuk.index') }}">Lihat</a>
                    </div>
                </div>
            </div>
            <span class="fw-medium d-block mb-1">Naskah Masuk</span>
            <h3 class="card-title mb-2">{{ $letterIn }} Data</h3>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-12 col-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/img/icons/unicons/cc-warning.png') }}" alt="chart success"
                        class="rounded" />
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('naskah-keluar.index') }}">Lihat</a>
                    </div>
                </div>
            </div>
            <span class="fw-medium d-block mb-1">Naskah Keluar</span>
            <h3 class="card-title mb-2">{{ $letterOut }} Data</h3>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-12 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="chart success"
                        class="rounded" />
                </div>
            </div>
            <span class="fw-medium d-block mb-1">Notifikasi</span>
            <h3 class="card-title mb-2">{{ $notificationCount }} Data</h3>
        </div>
    </div>
</div>
