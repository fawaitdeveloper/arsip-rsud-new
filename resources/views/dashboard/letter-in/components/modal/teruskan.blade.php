<style>
    .select2-container--open {
        z-index: 9999999
    }

    .select2-container {
        width: 100% !important;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalteruskandirektur" aria-labelledby="modalteruskandirektur" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('naskah-masuk.teruskan') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $letterIn->code }}" name="code">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalteruskandirektur">Teruskan Surat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="job_position_id[]" id="test" multiple="multiple">
                                @foreach ($belowPosition as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('customjs')
    <script>
        $(document).ready(function() {
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
            $('#modalteruskandirektur').on('shown.bs.modal', function() {
                $("#test").select2({
                    dropdownParent: "#modalteruskandirektur",
                    allowClear: true,
                    multiple: true,
                });
            })
        })
    </script>
@endpush
