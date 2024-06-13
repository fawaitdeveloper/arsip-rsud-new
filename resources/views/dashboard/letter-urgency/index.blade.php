@extends('dashboard.layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Data Urgensi Surat
                <a href="/letter-urgency/create">
                    <button type="button" class="btn btn-primary">
                        <span class="tf-icons bx bx-plus"></span>
                    </button>
                </a>
            </h5>

            <div class="table-responsive text-nowrap p-2">
                <table class="table table-striped table-hover" id="tableuser">
                    <caption class="ms-4">
                        Data Kategory Surat
                    </caption>
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('customjs')
    <script>
        $(document).ready(function() {
            $("#tableuser").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    search: "Search in table:"
                },
                ajax: {
                    url: '{{ route('letter-urgency.index') }}',
                    type: 'GET',
                },
                columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }

                }, {
                    data: 'name',

                }, {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `<a href="/letter-urgency/${data.id}/edit"><i class="bx bxs-pencil"></i></a> <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modaldelete" data-action="/letter-urgency/${data.id}"><i class="bx bx-trash text-danger"></i></a>`
                    }
                }]
            })
        })
    </script>
@endpush
