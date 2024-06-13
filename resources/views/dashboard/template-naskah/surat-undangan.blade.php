<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <title>Surat Undangan</title>
    <style>
        *,
        body,
        html {
            margin: 0px;
            padding: 0px;
            font-family: "sans-serif";
        }

        body {
            padding: 15px;
        }

        tr {
            padding: 0px !important;
        }

        tr td {
            padding-bottom: 5px;
            padding-top: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table tr th,
        .table tr td {
            border: 1px solid black;
        }

        .line {
            width: 100%;
            height: 0.5px;
            background: black;
        }

        .text-decoration-none {
            list-style: none
        }

        .signature {
            width: 40%;
            float: right;
            text-align: center;
            font-size: 14px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <div style="width:100%;">
        @include('dashboard.template-naskah.header')
        <u style="text-align: center">
            <h5 style="font-size: 18px; margin-bottom: 15px;">Surat Undangan</h5>
        </u>
        <div>
            <table>
                <tr>
                    <td align="top">Kepada</td>
                    <td> : &nbsp;&nbsp;&nbsp;</td>
                    <td>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($positions as $item)
                            <li class="text-decoration-none">{{ $no++ }}. {{ $item->name ?? '' }}</li>
                        @endforeach
                        @foreach ($employes as $item)
                            <li class="text-decoration-none">{{ $no++ }}. {{ $item->name ?? '' }}</li>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td> : </td>
                    <td>{{ auth()->user()->jobPosition->name ?? '' }} RSUD dr. Soediran Mangun Sumarso
                        Kab. Wonogiri
                    </td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td> : </td>
                    <td>{{ date('d M Y') }}</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td> : </td>
                    <td>{{ $request->letter_number }}</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td> : </td>
                    <td>{{ $attribute->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td> : </td>
                    <td> {{ count($attachmentFileId) }} Lampiran</td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td> : </td>
                    <td>{{ $request->about }}</td>
                </tr>
            </table>
        </div>
        <hr>
        <div style="margin-top: 30px">
            {!! $request->description !!}
        </div>
        <div class="signature">
            <div>
                <div>
                    <p style="font-size:14px;">DIREKTUR RUMAH SAKIT UMUM DAERAH</p>
                    <p style="font-size:14px;">dr. SOEDIRAN MANGUN SUMARSO</p>
                    <p style="font-size:14px;">KABUPATEN WONOGIRI</p>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div>
                    <u style="font-size:14px;">
                        {{ strtoupper(auth()->user()->name) }}
                    </u>
                    <p style="font-size:14px;">NIP. {{ auth()->user()->nip }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
