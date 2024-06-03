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
        font-size: 10px;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>

<body>
    <table width="100%">
        <tr style="line-height: 15px;">
            <td width="10%"><img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="80px" /></td>
            <td>
                <h1 style="font-size: 12px;">{{ ENV('APP_NAME') }}</h1>
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr style="line-height: 10px;">
            <td>
                <h3>Tiket</h3>
                <h3>Tanggal</h3>
            </td>
            <td>
                <h3>:</h3>
                <h3>:</h3>
            </td>
            <td>
                <h3>#{{ $data->presale->code }}-{{ $data->serial_number }}</h3>
                <h3>{{ date('d.m.Y H:i', strtotime($data->sold_date)) }}</h3>
            </td>
        </tr>
    </table>

    <hr>

    <table width="100%">
        <tr>
            <td style="border: 1px solid rgba(0, 0, 0, 0.5); text-align:center;"><h2>{{ Str::upper($data->category->name) }}</h2></td>
            <td width="5%"></td>
            <td style="border: 1px solid rgba(0, 0, 0, 0.5); text-align:center;">
                <h1>{{ number_format($data->price) }}</h1>
            </td>
        </tr>
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