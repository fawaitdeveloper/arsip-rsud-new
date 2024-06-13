@extends('dashboard.layouts.main')
@section('container')

<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Kategori Pengguna</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="/user-category">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Kategori Pengguna</label>
              <input type="text" name="name" class="form-control" style="width: 350px;" id="basic-default-fullname" placeholder="Kategori Pengguna" required/>
            </div>
            <a type="button" class="btn btn-danger" href="/unit-kerja">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection