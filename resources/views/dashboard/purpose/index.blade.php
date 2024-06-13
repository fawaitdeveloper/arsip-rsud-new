@extends('dashboard.layouts.main')
@section('container')
<div class="container-xxl flex-grow-1 container-p-y">
@if(session()->has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
      {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
  </div>
@endif
<div class="card">
    <h5 class="card-header d-flex justify-content-between align-items-center">
        Data Tujuan
        <a href="/purpose/create">
          <button type="button" class="btn btn-primary">
            <span class="tf-icons bx bx-plus"></span>
          </button>
        </a>
    </h5>
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <caption class="ms-4">
          Data Tujuan
        </caption>
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Instansi/Unit Kerja</th>
            <th>Pengguna</th>
            <th>Tipe</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($purposes as $row)
          <tr>
            <td class="fab">{{ $loop->iteration }}</td>
            <td> <strong>{{ $row->unitWork->name ?? ''}}</strong></td>
            <td> <strong>{{ $row->user->name ?? ''}}</strong></td>
            <td> <strong>{{ strtoupper($row->type ?? '')}}</strong></td>

            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/users/edit"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <!-- <form method="POST" action="/users/">
                    @method('delete')
                    @csrf
                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah anda yakin?')">
                      <i class="bx bx-trash me-2"></i>
                      <span class="align-middle">Hapus</span>
                    </button>
                  </form> -->
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
</div>
@endsection