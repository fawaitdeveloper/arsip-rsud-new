<div class="table-responsive text-nowrap">
    <table class="table table-bordered">
        <caption class="ms-4">
            Data Disposisi
        </caption>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Keterangan</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($letterOut->details as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name ?? '' }}</td>
                    <td>{{ $item->position->name ?? '' }}</td>
                    <td>{{ $item->action ?? '' }}</td>
                    <td>
                        @if (auth()->user()->job_position_id == $item->job_position_id && $item->action == 'disposition')
                            @if ($item->user_id == null)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#disposition"
                                    data-id="{{ $item->id }}" title="Disposisi"><i
                                        class='bx bx-checkbox-square'></i></a>
                            @else
                                <span class="badge bg-primary text-white">SELESAI</span>
                            @endif
                        @elseif (auth()->user()->job_position_id == $item->job_position_id && $item->action == 'receiver')
                            @if ($item->user_id == null)
                                <a href="#" title="Terima Surat" data-bs-toggle="modal" data-bs-target="#receive"
                                    data-id="{{ $item->id }}"><i class='bx bxs-badge-check'></i></a>
                            @else
                                <span class="badge bg-primary text-white">SELESAI</span>
                            @endif
                        @else
                            <span class="badge bg-danger text-white">TIDAK ADA AKSI</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="disposition" tabindex="-1" aria-labelledby="dispositionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Disposisi Surat Keluar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin mendisposisi surat ini ?
            </div>
            <form action="{{ route('naskah-keluar.disposition') }}" method="POST">
                @csrf
                <div class="modal-footer">
                    <input type="hidden" name="id" id="disposition_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                    <button type="submit" class="btn btn-primary">YA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="receive" tabindex="-1" aria-labelledby="receiveLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Surat Keluar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menerima surat ini ?
            </div>
            <form action="{{ route('naskah-keluar.receive') }}" method="POST">
                @csrf
                <div class="modal-footer">
                    <input type="hidden" name="id" id="receive_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                    <button type="submit" class="btn btn-primary">YA</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('customjs')
    <script>
        $(document).ready(function() {
            $(document).on('show.bs.modal', '#disposition', function(event) {
                const target = event.relatedTarget
                const id = $(target).data('id')
                $("#disposition_id").val(id)
            })

            $(document).on('show.bs.modal', '#receive', function(event) {
                const target = event.relatedTarget
                const id = $(target).data('id')
                $("#receive_id").val(id)
            })
        })
    </script>
@endpush
