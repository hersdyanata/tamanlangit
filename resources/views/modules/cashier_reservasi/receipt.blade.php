<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400'>
    <link rel="stylesheet" href="{{ asset('assets/css/reservation_styles.css') }}">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link rel="icon" href="{{ asset('assets/fe/img/favicon-100x100.png') }}" type="image/x-icon">

</head>

<body>
    <div class="boarding-pass">
        <header>
            <img src="{{ asset('assets/images/taman_langit.png') }}" alt="" width="130" />
            <div class="flight">
                <small>No. Tiket</small>
                <strong>#{{ $data->trans_num }}</strong><br>
            </div>
        </header>

        <section class="cities">
            <div class="city">
                <small>Check-in</small>

                <strong>{{ date('Y-m-d', strtotime($data->start_date)) }}</strong>
            </div>
            <div class="city">
                <small>Check-out</small>

                <strong>{{ date('Y-m-d', strtotime($data->end_date)) }}</strong>
            </div>
        </section>

        <section class="infos">
            <div class="places">
                <div class="box">
                    <small>Paket</small>
                    <strong>{{ $data->wahana->name }}</strong>
                </div>

                <div class="box">
                    <small>No. Tenda</small>
                    <strong>{{ $data->room->name }}</strong>
                </div>

                <div class="box">
                    <small>Durasi</small>
                    <strong>{{ $data->night_count }} Malam</strong>
                </div>

                <div class="box">
                    <small>Peserta</small>
                    <strong>{{ $data->persons }} Orang</strong>
                </div>
            </div>

            <div class="times">
                <div class="box">
                    <small>Harga</small>
                    <strong>IDR {{ number_format($data->price)}} x {{ $data->night_count }} Malam</strong>
                </div>

                <div class="box">
                    <small>PPn</small>
                    <strong>{{ $data->ppn }}% / {{ number_format($data->ppn_amount) }}</strong>
                </div>

                <div class="box">
                    <small>Total</small>
                    <strong>IDR {{ number_format($data->total_amount) }}</strong>
                </div>

                <div class="box">
                    <small>Status</small>
                    <strong>{{ $data->payment_status }}</strong>
                </div>
            </div>
        </section>

        <section class="strap">
            <div class="box">
                <div class="passenger">
                    <small>Nama</small>
                    <strong>{{ $data->name }}</strong>
                </div>
                <div class="date">
                    <small>Email</small>
                    <strong>{{ $data->email }}</strong>
                </div>
                <div class="date">
                    <small>Whatsapp</small>
                    <strong>{{ $data->wa_number }}</strong>
                </div>
                <div class="parkir">
                    {{-- <small>Tiket ini sudah termasuk parkir.</small> --}}
                    <strong>*) Tiket ini sudah termasuk parkir.</strong>
                </div>
            </div>
            <svg class="qrcode">
                {{-- <use xlink:href="#qrcode"></use> --}}
                {{ $qrcode }}
            </svg>
        </section>
    </div>
</body>

</html>
