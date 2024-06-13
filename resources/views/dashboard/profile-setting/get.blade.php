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
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Halaman Pengaturan Akun 🎉</h5>
                                <p class="mb-4">
                                    Silahkan ubah form dibawah ini untuk mengubah pengaturan akun anda
                                </p>
                                <form action="{{ route('profile-setting.post') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip" value="{{ auth()->user()->nip }}"
                                            placeholder="NIP" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" value="{{ auth()->user()->nik }}"
                                            placeholder="NIK" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                                            placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" value="{{ auth()->user()->username }}"
                                            placeholder="Username" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{ auth()->user()->email }}"
                                            placeholder="email" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone_number">No HP</label>
                                        <input type="text" value="{{ auth()->user()->phone_number }}" name="phone_number"
                                            placeholder="NO HP" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning btn-sm">Kembali</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Ubah Akun</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                {{-- <div>
                                    <div
                                        style="width: 110px; height: 110px; background: black; border-radius: 100%;overflow: hidden; opacity: 0.3;margin:auto;">
                                        <img src="{{ auth()->user()->photo }}"
                                            style="width: 100%; height: 100%; object-fit: cover;" alt="photo user">
                                    </div>
                                    <i class='bx bxs-camera text-md cursor-pointer'
                                        onclick="document.getElementById('photo-profile').click()"></i>
                                    <input type="file" id="photo-profile" class="d-none">
                                </div> --}}
                                <img src="../assets/img/illustrations/accounts.svg" width="340px" alt="View Badge User"
                                    data-app-dark-img="illustrations/accounts.svg"
                                    data-app-light-img="illustrations/accounts.svg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
