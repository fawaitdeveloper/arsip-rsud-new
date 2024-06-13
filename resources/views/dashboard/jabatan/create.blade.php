@extends('dashboard.layouts.main')
@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Jabatan</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="/jabatan">
            @csrf
            <div class="mb-3">
              <label for="mainWorkUnit" class="form-label">Unit Kerja</label>
              <select style="width: 350px;" class="form-select" id="exampleFormControlSelect1" name="work_unit_id">
                <option selected>-- Pilih Unit Kerja --</option>
                @foreach($workUnit as $work)
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
              <label for="mainWorkUnit" class="form-label">Induk Jabatan</label>
              <select style="width: 350px;" class="form-select" id="exampleFormControlSelect1" name="main_position_id">
                <option selected>-- Pilih Induk Jabatan --</option>
                @foreach($mainPosition as $position)
                <option value="{{ $position->id }}" {{ old('position') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                @endforeach
              </select>
              @error('category')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname">Nama Jabatan*</label>
              <input type="text" name="name" class="form-control" style="width: 350px;" placeholder="Nama Jabatan" />
            </div>

            <a type="button" class="btn btn-danger" href="/jabatan">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection