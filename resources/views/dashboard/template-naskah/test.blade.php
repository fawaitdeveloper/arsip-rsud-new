<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <title>Nota Dinas</title>
    <style>
        *,
        body,
        html {
            margin: 0;
            padding: 0;
        }

        body {
            padding: 20px;
        }

        tr>td {
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

        .signature {
            background-color: yellow;
            width: 40%;
            float: right;
            text-align: center
        }
    </style>
</head>

<body>
    <div style="width:100%;">
        <div class="signature">
            <div>
                <div>
                    <p style="font-size: 12px;">{{ strtoupper(auth()->user()->jobPosition->name ?? '') }} RUMAH SAKIT
                        UMUM DAERAH</p>
                    <p style="font-size: 12px;">dr. SOEDIRAN MANGUN SUMARSO</p>
                    <p style="font-size: 12px;">KABUPATEN WONOGIRI</p>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div>
                    <u style="font-size: 12px;">
                        {{ strtoupper(auth()->user()->name) }}
                    </u>
                    <p style="font-size: 12px;">NIP. {{ auth()->user()->nip }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
