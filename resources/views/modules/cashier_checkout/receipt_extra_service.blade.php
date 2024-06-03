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
        font-size: 11px;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: 11px;
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
            <td><strong>Layanan Tambahan Tiket:</strong> #{{ $data->trans_num }}</td>
            <td style="text-align: end;"><strong>Tgl Check-In:</strong> {{ date('d.m.Y H:i', strtotime($data->checkin_date)) }}</td>
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
            @foreach ($data->extras as $item)
                @php
                    $no++;
                    $total += $item->subtotal;

                    if($item->type !== 'person'){
                        $invType = ($item->stock->product->inventory_type === 'loan') ? 'Sewa - ' : 'Beli - ';
                    }
                @endphp
                <tr>
                    <td align="center">{{ $no }}</td>
                    <td>{{ ($item->type === 'person') ? '+ Anggota' : $invType . ucwords(strtolower($item->stock->product->name)) }}</td>
                    <td align="right">{{ $item->quantity }}</td>
                    <td align="right">{{ number_format($item->price) }}</td>
                    <td align="right">{{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>