<!-- Modal -->
<div class="modal fade" id="modalterima" tabindex="-1" aria-labelledby="modalBalasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('naskah-masuk.terima') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBalasLabel">Terima Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="code" value="{{ $letterIn->code }}">
                            <div class="form-group">
                                <label for="description">Keterangan</label>
                                <textarea name="note" id="description" cols="30" rows="10" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
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
