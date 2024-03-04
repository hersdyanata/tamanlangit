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

    <table width="100%">
        <tr>
            <td valign="top"><img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="120" /></td>
            <td align="right">
                <h3>{{ ENV('APP_NAME') }}</h3>
                <pre>
                Kp. Puncak Mulya, Jl. Cukul, Sukaluyu,
                Pangalengan, Kabupaten Bandung Selatan
                Jawa Barat
                phone: 283492348
            </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>Tiket:</strong> #{{ $data->serial_number }}</td>
            <td align="right"><strong>Tgl:</strong> {{ date('d.m.Y H:i:s', strtotime($data->sold_date)) }}</td>
        </tr>
    </table>

    <br />

    <table width="100%">
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
    </table>

</body>

</html>