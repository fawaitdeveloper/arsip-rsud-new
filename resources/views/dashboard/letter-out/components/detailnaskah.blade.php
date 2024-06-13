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
                        <td>{{ $letterOut->sender_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan Pengirim</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterOut->sender_position ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Tujuan Naskah</h5>
                <table>
                    <tr>
                        <td>Tujuan Jabatan</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterOut->receive_position ?? '-' }}</td>
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
                        <td>{{ $letterOut->category->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Sifat Naskah</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterOut->attribute->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Urgensi</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ $letterOut->urgency->name ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Tanggal Kirim</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ date('d M Y', strtotime($letterOut->letter_date ?? '')) }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Terima</td>
                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                        <td>{{ date('d M Y', strtotime($letterOut->letter_received ?? '')) }}</td>
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
                <td>{{ $letterOut->about ?? '' }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="col-md-12 mb-3">
        <div>
            {!! $letterOut->description !!}
        </div>
    </div>
</div>
