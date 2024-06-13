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
                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Halaman Mengatur Password 🎉</h5>
                                <p class="mb-4">
                                    Silahkan masukan password anda dibawah ini untuk mengubah pengaturan password anda
                                </p>
                                <form action="{{ route('reset-password.post') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="password_old">Password Lama</label>
                                        <input type="text" name="password_old" placeholder="Password Lama"
                                            class="form-control @error('password_old') is-invalid @enderror">
                                        @error('password_old')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password_new">Password Baru</label>
                                        <input type="text" name="password_new" placeholder="password Baru"
                                            class="form-control @error('password_new') is-invalid @enderror">
                                        @error('password_new')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning btn-sm">Kembali</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/keys.svg" width="340px" alt="View Badge User"
                                    data-app-dark-img="illustrations/keys.svg"
                                    data-app-light-img="illustrations/keys.svg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
