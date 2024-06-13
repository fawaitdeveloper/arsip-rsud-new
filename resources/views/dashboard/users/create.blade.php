@extends('dashboard.layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($id) ? '/users/' . $id : '/users' }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($id))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nomor Induk Pegawai*</label>
                                        <input type="text" name="nip"
                                            value="{{ old('nip', isset($id) ? $user->nip : null) }}"
                                            class="form-control @error('nip') is-invalid @enderror"
                                            placeholder="Nomor Induk Pegawai" />
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">NIK*</label>
                                        <input type="text" name="nik"
                                            value="{{ old('nik', isset($id) ? $user->nik : null) }}"
                                            class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" />
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama Lengkap*</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', isset($id) ? $user->name : null) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Nama Lengkap" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nomor Seluler*</label>
                                        <input type="text" name="phone_number"
                                            value="{{ old('phone_number', isset($id) ? $user->phone_number : null) }}"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            placeholder="Nomor Seluler" />
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama Pengguna*</label>
                                        <input type="text" name="username"
                                            value="{{ old('username', isset($id) ? $user->username : null) }}"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Nama Pengguna" />
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Email*</label>
                                        <input type="email" name="email"
                                            value="{{ old('email', isset($id) ? $user->email : null) }}"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Kata Sandi*</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Minimal 8 karakter" />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Hak Akses</label>
                                        <select class="form-select @error('role') is-invalid @enderror" name="role">
                                            <option selected>Pilih Salah Satu</option>
                                            <option value="admin"
                                                {{ old('role', isset($id) ? $user->role : null) == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="secretary"
                                                {{ old('role', isset($id) ? $user->role : null) == 'secretary' ? 'selected' : '' }}>
                                                Sekretaris</option>
                                            <option value="user"
                                                {{ old('role', isset($id) ? $user->role : null) == 'user' ? 'selected' : '' }}>
                                                User</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- <div class="mb-3">
                      <label for="work_unit_id" class="form-label">Unit Kerja</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="work_unit_id">
                        <option selected>-- Pilih Unit Kerja --</option>
                        @foreach ($workUnit as $work)
    <option value="{{ $work->id }}" {{ old('work') == $work->id ? 'selected' : '' }}>{{ $work->name }}</option>
    @endforeach
                      </select>
                      @error('work_unit_id')
        <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
    @enderror
                    </div> -->

                                    <div class="mb-3">
                                        <label for="position_id" class="form-label">Jabatan</label>
                                        <select class="form-select select2  @error('position_id') is-invalid @enderror"
                                            id="exampleFormControlSelect1" name="position_id">
                                            <option selected>-- Pilih Jabatan --</option>
                                            @foreach ($position as $position)
                                                @php
                                                    $parent = $position->parent->name ?? '';
                                                @endphp
                                                <option value="{{ $position->id }}"
                                                    {{ old('position_id', isset($id) ? $user->job_position_id : null) == $position->id ? 'selected' : '' }}>
                                                    {{ $position->name . ' ' . $parent }}</option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="/users">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#photo');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFEvent) {
                imgPreview.src = oFEvent.target.result;
            }
        }
    </script>
@endsection
