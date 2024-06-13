@extends('dashboard.layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Kategori Surat</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($id) ? '/letter-category/' . $id : '/letter-category' }}">
                            @csrf
                            @if (isset($id))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-fullname">Nama Ketegori*</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', isset($id) ? $letterCategory->name : null) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Nama Kategori" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a type="button" class="btn btn-danger" href="/letter-category">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
