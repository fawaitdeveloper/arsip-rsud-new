<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <title>Surat Edaran</title>
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

        .text-right {
            text-align: right
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .float-right {
            float: right;
        }

        .title {
            font-size: 14px;
            text-align: center
        }

        .content {
            margin: 20px
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
        <div>

        </div>
        <hr>
        <div style="margin-top: 30px">
            <table class="float-right">
                <tr>
                    <td>Yth</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
            </table>
        </div>
        <div class="clearfix"></div>
        <div class="float-right" style="margin-right: 80px">
            <p>Di</p>
            <b>Wonogiri</b>
        </div>
        <div class="clearfix"></div>
        <h1 class="title">SURAT EDARAN</h1>
        <h1 class="title">NO {{ $request->letter_number }}</h1>
        <div style="margin-top: 15px">
            <h1 class="title">TENTANG</h1>
            <h1 class="title">{{ strtoupper($request->about) }}</h1>
            <h1 class="title">DI LINGKUNGAN RSUD dr. SOEDIRAN MANGUN SUMARSO</h1>
            <h1 class="title">KABUPATEN WONOGIRI</h1>
        </div>
        <div class="content">
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
