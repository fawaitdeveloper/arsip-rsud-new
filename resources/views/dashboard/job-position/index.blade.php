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
                Data Jabatan
            </h5>
            <div class="table-responsive text-nowrap p-2">
                <table class="table table-bordered" id="table-job-position">
                    <caption class="ms-4">
                        Data Jabatan
                    </caption>
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Atasan</th>
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
            let filter = {
                value: $("#filter").find(":selected").val()
            }
            const table = $("#table-job-position").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    search: "Search in table:"
                },
                ajax: {
                    url: '{{ route('jobposition.index') }}',
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
                    data: 'parent',
                    render: function(data, type, row, meta) {
                        return `<span class="badge bg-primary">${row?.parent?.name || "-"}</span>`;
                    }
                }]
            })

            $("#group").on("change", function() {
                table.draw();
            })
            $("#status").on("change", function() {
                table.draw();
            })
        })
    </script>
@endpush
