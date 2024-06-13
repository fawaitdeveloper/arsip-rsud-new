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
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h6>Form Registrasi Naskah Keluar</h6>
            </div>
            <form action="{{ route('naskah-keluar.store') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <input type="hidden" value="{{ request()->get('type') }}" name="type">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>DETAIL TUJUAN SURAT</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div
                            class="col-md-{{ request()->filled('type') && request()->get('type') != 'nota-dinas' ? '6' : '12' }}">
                            <div class="form-group">
                                <label for="job_position_id">Tujuan Berdasarkan Jabatan</label>
                                <select name="job_position_id[]" id="job_position_id"
                                    {{ old('tujuan') == 'all' ? 'disabled' : '' }}
                                    class="form-control select2 @error('job_position_id') is-invalid @enderror" multiple
                                    onchange="changePosition(event)">
                                    @foreach ($positions as $item)
                                        <option value="{{ $item->id }}"
                                            {{ in_array($item->id, old('job_position_id', [])) ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('job_position_id')
                                    <span class="errors">The job position id field is required.</span>
                                @enderror
                            </div>
                        </div>
                        @if (request()->filled('type') && request()->get('type') != 'nota-dinas')
                            <div
                                class="col-md-{{ request()->filled('type') && request()->get('type') != 'nota-dinas' ? '6' : '12' }}">
                                <div class="form-group">
                                    <label for="employee_id">Tujuan Berdasarkan Nama</label>
                                    <select name="employee_id[]" id="employee_id"
                                        {{ old('tujuan') == 'all' ? 'disabled' : '' }}
                                        class="form-control select2 @error('employee_id') is-invalid @enderror" multiple
                                        onchange="changePosition(event)">
                                        @foreach ($employes as $item)
                                            <option value="{{ $item->id }}"
                                                {{ in_array($item->id, old('employee_id', [])) ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>DETIL ISI NASKAH</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="sender_type" class="form-label">Dikirim</label>
                                        <select name="sender_type" id="sender_type"
                                            class="form-control select2  @error('sender_type') is-invalid @enderror">
                                            <option value="melalui"
                                                {{ old('sender_type', null) == 'melalui' ? 'selected' : '' }}>
                                                Melalui</option>
                                            <option value="mengetahui"
                                                {{ old('sender_type', null) == 'mengetahui' ? 'selected' : '' }}>Mengetahui
                                            </option>
                                        </select>
                                        @error('sender_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_category_id"
                                            class="form-label  @error('letter_category_id') is-invalid @enderror">Jenis
                                            Naskah</label>
                                        <select name="letter_category_id" id="letter_category_id"
                                            class="form-control select2">
                                            @foreach ($letterCategory as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('letter_category_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('letter_category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_attribute_id" class="form-label">Sifat Naskah</label>
                                        <select name="letter_attribute_id"
                                            id="letter_attribute_id  @error('letter_attribute_id') is-invalid @enderror"
                                            class="form-control select2">
                                            @foreach ($letterAttribute as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('letter_attribute_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('letter_attribute_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_urgency_id"
                                            class="form-label  @error('letter_urgency_id') is-invalid @enderror">Tingkat
                                            Urgensi</label>
                                        <select name="letter_urgency_id" id="letter_urgency_id"
                                            class="form-control select2">
                                            @foreach ($letterUrgency as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('letter_urgency_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('letter_urgency_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_number" class="form-label">Nomor Naskah</label>
                                        <input type="text" name="letter_number"
                                            class="form-control  @error('letter_number') is-invalid @enderror"
                                            value="{{ old('letter_number') }}">
                                        @error('letter_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="about" class="form-label">Hal</label>
                                        <textarea name="about" id="about" cols="30" rows="10"
                                            class="form-control  @error('about') is-invalid @enderror">{{ old('about') }}</textarea>
                                        @error('about')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                    @error('description')
                        <span class="errors">{{ $message }}</span>
                    @enderror
                    <div class="row" style="margin-top: 100px">
                        <div class="col-md-12">
                            <h6>LAMPIRAN NASKAH</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Format yang didukung: .JPG .JPEG .PNG .DOC .DOCX .PDF
                                .XLS .XLSX .PPT .PPTX .MP4 .WAV</label>
                            <label for="" class="form-label">Mohon memberikan nama file lampiran yang tepat dan
                                benar,
                                tidak menggunakan unsur (titik), (koma), symbol (!@#$%^&* ( ) ) dan maksimal 10 file</label>
                            <input type="file" name="attachment_file[]" id="attachment"
                                class="form-control dropify  @error('attachment_file') is-invalid @enderror">
                            @error('attachment_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-loading">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <p><span class="ql-size-huge">asfsadasdfasfd</span></p>
@endsection
@push('customjs')
    <script>
        function changePosition(event) {
            let value = $(event.target).val()
            $.ajax({
                url: "{{ route('ajax.user') }}",
                method: "get",
                data: {
                    job_position_id: value
                },
                success: function(response) {
                    let options = ''
                    $.each(response, (key, value) => {
                        options += `<option value="${value.id}">${value.name}</option>`
                    })
                    $("#input-user").html(options)
                }
            })

        }

        $("#input-user").select2().change(changePosition);
        $("input[type=checkbox]").on("change", function() {
            if ($(this).is(":checked")) {
                // Do stuff
                $("#job_position_id").attr("disabled", true);
                $("#job_position_id").val(null).trigger("change");
            } else {
                $("#job_position_id").attr("disabled", false);
            }
        });

        $(document).ready(function() {
            $('#description').summernote({
                height: 300,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                },
            });
        })
    </script>
@endpush
