<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<title>{{ $title }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: 8px;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: 8px;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>

<body>

    {{-- <table width="100%">
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
    </table> --}}

    <table width="100%">
        <tr style="line-height: 15px;">
            <td width="10%"><img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="80px" /></td>
            <td>
                <h1 style="font-size: 12px;">{{ ENV('APP_NAME') }}</h1>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>No. Tiket:</strong> #{{ $data->trans_num }}</td>
            <td style="text-align: end;"><strong>Tgl:</strong> {{ date('d.m.Y H:i', strtotime($data->trans_date)) }}</td>
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
            @endphp
            @foreach ($data->details as $r)
                @php
                    $no++;
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>Tiket - {{ $r->ticket->category_->name }}</td>
                    <td align="right">{{ $r->quantity }}</td>
                    <td align="right">{{ number_format($r->price) }}</td>
                    <td align="right">{{ number_format($r->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total</td>
                <td align="right" class="gray">{{ number_format($data->amount) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

<script>
    $(document).ready(function() {
        // Function to print and then close the window
        function printAndClose() {
            window.print();
        }

        // Add afterprint event listener
        window.addEventListener('afterprint', function() {
            window.close();
        });

        // Trigger printAndClose function on page load
        printAndClose();
    });
</script>