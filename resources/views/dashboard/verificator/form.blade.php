@extends('dashboard.layouts.main')
@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tambah Verifikator</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="/verificator">
          @csrf
          <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Pengguna</label>
                  <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror">
                        <option value="">pilih</option>
                        @foreach($users as $row)
                        <option value="{{$row->id}}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                      <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
          </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a type="button" class="btn btn-danger" href="/verificator">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
 function previewImage(){
   const image      = document.querySelector('#photo');
   const imgPreview = document.querySelector('.img-preview')

   imgPreview.style.display = 'block';

   const oFReader = new FileReader();
   oFReader.readAsDataURL(image.files[0]);

   oFReader.onload = function(oFEvent){
    imgPreview.src = oFEvent.target.result;
   }
 }
</script>
@endsection