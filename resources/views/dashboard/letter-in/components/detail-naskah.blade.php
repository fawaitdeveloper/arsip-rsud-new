{{--  --}}
<div class="row my-3">
    <hr>
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-6">
                <h5>Asal Naskah</h5>
                <table>
                    <tr>
                        <td>Nama Pengirim</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->sender_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan Pengirim</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->sender_position ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Tujuan Naskah</h5>
                <table>
                    <tr>
                        <td>Tujuan Jabatan</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->receive_position ?? '-' }}</td>
                    </tr>
                    @if (count($received) > 0)
                        <tr>
                            <td>Nama Penerima</td>
                            <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                            <td>
                                @foreach ($received as $item)
                                    <b>{{ $item->name . ' - ' . $item->position }}</b>&nbsp;&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <div class="row">
            <h5>Detail Naskah</h5>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Jenis Naskah</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->category->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Sifat Naskah</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->attribute->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Urgensi</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterIn->urgency->name ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Tanggal Kirim</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ date('d M Y', strtotime($letterIn->letter_date ?? '')) }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Terima</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ date('d M Y', strtotime($letterIn->letter_received ?? '')) }}</td>
                    </tr>
                    <tr>
                        <td>Catatan Naskah</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>
                            @if(count($notes)>0)
                                @foreach($notes as $item)
                                    <b> - {{ $item->note }}</b> <br>
                                @endforeach
                            @else
                                <b>Tidak ada catatan</b>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <h5>Isi Naskah</h5>
        <table>
            <tr>
                <td>Halaman Naskah</td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td>{{ $letterIn->about ?? '' }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <div>
            {!! $letterIn->description !!}
        </div>
    </div>
</div>
