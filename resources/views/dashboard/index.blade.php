@extends('dashboard.layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    Sekarang pukul: <span id="current-time"
                                        class="fw-bold">{{ now()->format('H:i:s') }}</span> WIB<br>
                                </p>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can('admin')
                @include('dashboard.components.admin.user-card')
            @endcan

            @can('secretary')
                @include('dashboard.components.secretary.letter')
            @endcan
            @can('user')
                @include('dashboard.components.user.letter')
            @endcan
        </div>

        <script>
            function updateCurrentTime() {
                const currentTimeElement = document.getElementById('current-time');
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const currentTime = hours + ':' + minutes + ':' + seconds;

                currentTimeElement.textContent = currentTime;
            }

            // Update current time every second
            setInterval(updateCurrentTime, 1000);
        </script>
    @endsection
