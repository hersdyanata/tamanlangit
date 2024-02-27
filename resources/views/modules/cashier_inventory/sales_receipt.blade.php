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
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="130" /></td>
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
            <td><strong>No. Transaksi:</strong> #{{ $data->trans_num }}</td>
            <td><strong>Tgl:</strong> {{ date('d.m.Y H:i', strtotime($data->trans_date)) }}</td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            $total = 0;
            @endphp
            @foreach ($data->items as $r)
            @php
            $no++;
            $total += $r->subtotal;
            @endphp
            <tr>
                <th scope="row">{{ $no }}</th>
                <td>{{ $r->product->name }}</td>
                <td align="right">{{ $r->quantity }}</td>
                <td align="right">{{ number_format($r->price) }}</td>
                <td align="right">{{ number_format($r->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Subtotal</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">PPn ({{ ($data->ppn != null) ? $data->ppn.'%' : '-' }})</td>
                <td align="right">{{ number_format($data->ppn_amount) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total</td>
                <td align="right" class="gray">{{ number_format($data->total_amount) }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>