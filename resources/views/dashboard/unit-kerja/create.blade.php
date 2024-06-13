@extends('dashboard.layouts.main')
@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Induk Unit Kerja</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="/unit-kerja">
            @csrf
            <div class="mb-3">
              <label for="mainWorkUnit" class="form-label">Induk Unit Kerja</label>
              <select style="width: 350px;" class="form-select" id="exampleFormControlSelect1" name="main_unit_id">
                <option selected>-- Pilih Induk Unit --</option>
                @foreach($mainWorkUnit as $work)
                <option value="{{ $work->id }}" {{ old('work') == $work->id ? 'selected' : '' }}>{{ $work->name }}</option>
                @endforeach
              </select>
              @error('category')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Unit Kerja*</label>
              <input type="text" name="name" class="form-control" style="width: 350px;" placeholder="Nama Induk Unit Kerja" />
            </div>

            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Singkatan*</label>
              <input type="text" name="abbreviation" class="form-control" style="width: 350px;" placeholder="Singkatan Unit Kerja" />
            </div>

            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Alamat*</label>
              <textarea name="address" class="form-control" style="width: 350px;"></textarea>
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