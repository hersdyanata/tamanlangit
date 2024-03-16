<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $title }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: 12px;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>

<body>

    {{-- <h3 style="line-height: 2px;">{{ ENV('APP_NAME') }}</h3>
    <h4>Nomor Tiket: #{{ $data->serial_number }}</h4> --}}

    <table width="100%">
        <tr style="line-height: 15px;">
            <td width="20%"><img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="80px" /></td>
            <td>
                <h1 style="font-size: 30px;">{{ ENV('APP_NAME') }}</h1>
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr style="line-height: 10px;">
            <td>
                <h3>Nomor Tiket</h3>
                <h3>Tanggal</h3>
            </td>
            <td>
                <h3>:</h3>
                <h3>:</h3>
            </td>
            <td>
                <h3>#{{ $data->serial_number }}</h3>
                <h3>{{ date('d.m.Y H:i:s', strtotime($data->sold_date)) }}</h3>
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr>
            <td style="border: 1px solid rgba(0, 0, 0, 0.5); text-align:center;"><h2>{{ Str::upper($data->category) }}</h2></td>
            <td width="5%"></td>
            <td style="border: 1px solid rgba(0, 0, 0, 0.5); text-align:center;">
                <h1>{{ number_format($data->price) }}</h1>
            </td>
        </tr>
    </table>

    {{-- <table width="100%">
        <tr>
            <td><strong>Tiket:</strong> #{{ $data->serial_number }}</td>
            <td align="right"><strong>Tgl:</strong> {{ date('d.m.Y H:i:s', strtotime($data->sold_date)) }}</td>
        </tr>
    </table> --}}

    {{-- <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Item</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">Tiket {{ ucfirst($data->category) }}</td>
                <td align="center">{{ number_format($data->price) }}</td>
            </tr>
        </tbody>
    </table> --}}

</body>

</html>