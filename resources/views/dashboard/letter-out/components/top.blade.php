        @include('dashboard.letter-out.components.modalBalas')
        <form action="/naskah-masuk/send" method="post" id="form-send">
            @csrf
            <input type="hidden" name="id" value="{{ $letterOut->id }}">
        </form>
        <div class="card mb-5">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Detail Naskah Keluar
                <div>
                    <a href="/naskah-keluar">
                        <button type="button" class="btn btn-primary btn-sm">
                            Kembali <span class="tf-icons bx bx-reply"></span>
                        </button>
                    </a>
                    @if ($letterOut->access != 'R')
                        <div class="dropdown d-inline">
                            <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Tindak Lanjut <i class='bx bx-reply-all'></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/naskah-keluar/create">Saya Balas</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modalBalas">Dibalaskan Oleh</a></li>
                                <li><a class="dropdown-item" href="#">Disposisi/Kordinasi/Saran</a></li>
                            </ul>
                        </div>
                    @endif
                </div>
            </h5>
            <div class="card-body">
                <p class="text-sm">Naskah masuk dari :</p>
                <div class="row">
                    <div class="col-md-1">
                        <div
                            style="width: 50px; height: 50px; border-radius: 50%; background: black; background-size: contain; overflow: hidden; display: flex; justify-content: center;align-items: center;">
                            <img src="https://placehold.co/400x400" width="100px" height="100px"
                                class="img-rounded img-thumbnail img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <p>{{ $letterOut->sender_name }} - {{ $letterOut->sender_position }}</p>
                        <p>{{ $letterOut->sender_instansi }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>Nomor Referensi</p>
                        <span class="badge bg-primary">TIDAK ADA</span>
                    </div>
                    <div class="col-md-4">
                        <p>Nomor Naskah</p>
                        <p>{{ $letterOut->letter_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Tanggal Naskah</p>
                        <p>{{ date('d M Y', strtotime($letterOut->letter_date)) }}</p>
                    </div>
                </div>
                @include('dashboard.letter-out.components.detailnaskah')
                <div class="row">
                    <div class="col-md-12 mt-3">
                        {{-- <iframe src="{{ asset($letterOut->letter_file) }}">
                            <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                    An &#105;frame should be displayed here but your browser version does not support
                                    &#105;frames. </em>Please update your browser to its most recent version and try
                                again.</p>
                        </iframe> --}}
                        <object data="{{ asset($letterOut->letter_file) }}" type="application/pdf"
                            style="width: 100%; height: 700px;">
                            <div>No online PDF viewer installed</div>
                        </object>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <span>{{ count($letterOut->attachments) }} Lampiran</span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            @foreach ($letterOut->attachments as $row)
                                <div class="col-md-3">
                                    <a href="{{ asset($row->file) }}" target="blank">
                                        <span class="text-danger"><i class='bx bxs-file-pdf'></i>
                                            {{ $row->file }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
