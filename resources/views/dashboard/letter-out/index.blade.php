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
            <div class="row p-2">
                <div class="col-md-6">
                    <select name="group" id="group" class="form-control">
                        <option value="">pilih type surat</option>
                        <option value="nota-dinas">NOTA DINAS</option>
                        <option value="surat-edaran">SURAT EDARAN</option>
                        <option value="surat-undangan">SURAT UNDANGAN</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="status" id="status" class="form-control">
                        <option value="">pilih status surat</option>
                        <option value="selesai">SELESAI</option>
                        <option value="belum selesai">BELUM SELESAI</option>
                    </select>
                </div>
            </div>
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Data Naskah Keluar
            </h5>
            <div class="table-responsive text-nowrap p-2">
                <table class="table table-striped table-hover" id="tablesuratkeluar">
                    <caption class="ms-4">
                        Data Tujuan
                    </caption>
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal Naskah</th>
                            <th>Nomor Naskah</th>
                            <th>Asal Naskah</th>
                            <th>Tujuan Naskah</th>
                            <th>Tingkat Urgensi</th>
                            <th>Tipe Surat</th>
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
            let filter = {
                data: $("#filter").find(":selected").val(),
                group: null
            }
            const table = $("#tablesuratkeluar").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    search: "Search in table:",
                },
                ajax: {
                    url: '{{ route('naskah-keluar.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d.group = $("#group").find(":selected").val()
                        d.status = $("#status").find(":selected").val()
                    }
                },

                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    }, {
                        data: 'letter_date',

                    }, {
                        data: 'letter_number',

                    }, {
                        data: 'sender_position',
                        render: function(data, type, row, meta) {
                            return row.sender_name + ' ' + row.sender_position
                        }
                    }, {
                        data: 'receive_position'
                    },
                    {
                        data: 'urgency.name',
                    }, {
                        data: 'group',
                        render: function(data, type, row, meta) {
                            return `${row.group ? row.group?.split("-")?.join(" ")?.toUpperCase() : "-"}`
                        }
                    }, {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `<a href="/naskah-keluar/${data.id}"><i class="bx bx-low-vision"></i></a>`
                        }
                    }
                ]
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
