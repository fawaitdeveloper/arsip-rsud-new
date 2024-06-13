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
        @error('file')
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @enderror
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Data Karyawan
                <a href="#">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalimport">
                        <i class='bx bx-upload'></i> Import Karyawan
                    </button>
                </a>
            </h5>
            <div class="table-responsive text-nowrap p-2">
                <table class="table table-striped table-hover" id="tableemployee">
                    <caption class="ms-4">
                        Data Karyawan
                    </caption>
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Unit</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalimport" tabindex="-1" aria-labelledby="modalimport" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('employee.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalimport">Import Data
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary btn-loading">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('customjs')
    <script>
        $(document).ready(function() {
            let filter = {
                value: $("#filter").find(":selected").val()
            }
            const table = $("#tableemployee").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    search: "Search in table:"
                },
                ajax: {
                    url: '{{ route('employee.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d.filter = filter.value
                    }
                },

                columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }

                }, {
                    data: 'name',

                }, {
                    data: 'nip',

                }, {
                    data: 'unit',
                }, {
                    data: 'position',
                }]
            })

            $("#filter").on('change', function() {
                const value = $(this).val()
                filter.value = value
                console.log('value', filter.value)
                table.clear().draw()
            })
        })
    </script>
@endpush
