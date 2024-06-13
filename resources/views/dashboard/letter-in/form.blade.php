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
            <div class="card-header">
                <h6>Form Registrasi Naskah Masuk</h6>
            </div>
            <form action="/naskah-masuk" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="sender_name" class="form-label">Nama Pengirim*</label>
                                <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                                    placeholder="Nama Pengirim"
                                    class="form-control @error('sender_name') is-invalid @enderror">
                                @error('sender_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="sender_position" class="form-label">Jabatan Pengirim*</label>
                                <input type="text" value="{{ old('sender_position') }}" name="sender_position"
                                    placeholder="Nama Pengirim"
                                    class="form-control  @error('sender_position') is-invalid @enderror">
                                @error('sender_position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="sender_instansi" class="form-label">Instansi Pengirim*</label>
                                <input type="text" name="sender_instansi" value="{{ old('sender_instansi') }}"
                                    placeholder="Nama Pengirim"
                                    class="form-control  @error('sender_instansi') is-invalid @enderror">
                                @error('sender_instansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                                        <label for="letter_category_id" class="form-label">Jenis Naskah</label>
                                        <select name="letter_category_id" id="letter_category_id"
                                            class="form-control select2  @error('letter_category_id') is-invalid @enderror">
                                            <option value="">pilih</option>
                                            @foreach ($letterCategory as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('letter_category_id') ? 'selected' : null }}>
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
                                        <select name="letter_attribute_id" id="letter_attribute_id"
                                            class="form-control select2  @error('letter_attribute_id') is-invalid @enderror">
                                            <option value="">pilih</option>
                                            @foreach ($letterAttribute as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('letter_attribute_id') ? 'selected' : null }}>
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
                                        <label for="letter_urgency_id" class="form-label">Tingkat Urgensi</label>
                                        <select name="letter_urgency_id" id="letter_urgency_id"
                                            class="form-control select2  @error('letter_urgency_id') is-invalid @enderror">
                                            <option value="">pilih</option>
                                            @foreach ($letterUrgency as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == old('letter_urgency_id') ? 'selected' : null }}>
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
                                        <input type="text" name="letter_number" value="{{ old('letter_number') }}"
                                            class="form-control  @error('letter_number') is-invalid @enderror">
                                        @error('letter_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_refrency" class="form-label">Nomor Refrensi</label>
                                        <select name="letter_refrency" id="letter_refrency"
                                            class="form-control select2  @error('letter_refrency') is-invalid @enderror"
                                            disabled>
                                            <option value="">pilih</option>
                                        </select>
                                        @error('letter_refrency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_date" class="form-label">Tanggal Naskah</label>
                                        <input type="date" value="{{ old('letter_date') }}" name="letter_date"
                                            id="letter_date"
                                            class="form-control  @error('letter_date') is-invalid @enderror">
                                        @error('letter_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_received" class="form-label">Tanggal Diterima</label>
                                        <input type="date" value="{{ old('letter_received') }}"
                                            name="letter_received" id="letter_received"
                                            class="form-control  @error('letter_received') is-invalid @enderror">
                                        @error('letter_received')
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
                                        <textarea name="about" value="{{ old('about') }}" id="about" cols="30" rows="10"
                                            class="form-control  @error('about') is-invalid @enderror"></textarea>
                                        @error('about')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Isi Ringkas</label>
                                        <textarea name="description" id="description" cols="30" rows="10"
                                            class="form-control  @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="letter_file" class="form-label">File Naskah</label>
                                        <input type="file" name="letter_file" id="letter_file"
                                            class="form-control  @error('letter_file') is-invalid @enderror">
                                        @error('letter_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>LAMPIRAN NASKAH</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="attachment_file" class="form-label">Format yang didukung: .JPG .JPEG .PNG .DOC
                                .DOCX .PDF .XLS .XLSX .PPT .PPTX .MP4 .WAV</label>
                            <label for="attachment_file" class="form-label">Mohon memberikan nama file lampiran yang tepat
                                dan benar, tidak menggunakan unsur (titik), (koma), symbol (!@#$%^&* ( ) ) dan maksimal 10
                                file</label>
                            <input type="file" name="attachment_file[]" multiple id="attachment_file"
                                class="form-control dropify" data-allowed-file-extensions="pdf png jpg jpeg">
                            @error('attachment_file')
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h6>Tujuan Utama</h6>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="group_purpose_id" class="form-label">Group Tujuan</label>
                                            <select name="group_purpose_id" id="group_purpose_id"
                                                class="form-control select2  @error('group_purpose_id') is-invalid @enderror">
                                                <option value="">pilih</option>
                                                @foreach ($groupPurposes as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == old('group_purpose_id') ? 'selected' : null }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('group_purpose_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="user_id" class="form-label">Utama</label>
                                            <select name="user_id[]" id="user_id" multiple
                                                class="form-control select2  @error('user_id') is-invalid @enderror">
                                                <option value="">pilih</option>
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == old('user_id') ? 'selected' : null }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h6>Tujuan Tembusan</h6>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="translucent_id" class="form-label">Tembusan</label>
                                            <select name="translucent_id[]" id="translucent_id" multiple
                                                class="form-control select2 @error('translucent_id') is-invalid @enderror">
                                                @foreach ($translucents as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == old('translucent_id') ? 'selected' : null }}>
                                                        {{ $item->user->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('translucent_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-loading">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('customjs')
    <script>
        $('#description').summernote({
            height: 300,
            codemirror: {
                mode: 'text/html',
                htmlMode: true,
                lineNumbers: true,
                theme: 'monokai'
            },
        });
    </script>
@endpush
