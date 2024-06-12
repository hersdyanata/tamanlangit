@extends('layouts.frontend')

@section('page_resources')
    <script src="{{ asset('assets/fe/js/plugins/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection

@section('page_css')
    <link href="{{ asset('assets/fe/css/additional.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('meta_data')
@endsection

@section('content')
    <!-- banner -->
    <div class="mil-banner-sm mil-fade-up">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; top: 0; right: -35%; transform: rotate(190deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; bottom: -12%; left: -30%; transform: rotate(40deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 110%; top: -5%; left: -30%; opacity: .3" alt="shape">
        <div class="container">
            <div class="mil-banner-img-4">
                <img src="{{ asset('assets/fe/img/shapes/1.png') }}" alt="object" class="mil-figure mil-1">
                <img src="{{ asset('assets/fe/img/shapes/2.png') }}" alt="object" class="mil-figure mil-2">
                <img src="{{ asset('assets/fe/img/shapes/3.png') }}" alt="object" class="mil-figure mil-3">
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6">
                    <div class="mil-banner-content-frame">
                        <div class="mil-banner-content mil-text-center">
                            <h2 class="mil-mb-40">Yah, Beneran mau dibatalin ya😞</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <div class="mil-contact mil-p-0-100 mil-fade-up">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
        <div class="container">
            @php
                $currentDate = new DateTime(date('Y-m-d'));
                $reservedDate = new DateTime($data->start_date);

                $interval = $currentDate->diff($reservedDate);
                $daysDifference = $interval->days;

                if ($currentDate < $reservedDate) {
                    if($daysDifference >= 3){
                        $rule = $cancelRules->where('parameter', 'more_than_3')->first();
                        $refund = $data->total_amount * ($rule->value / 100);
                    }else{
                        $rule = $cancelRules->where('parameter', 'less_than_3')->first();
                        $refund = 0;
                    }
                }else{
                    $refund = 0;
                    $rule = null;
                }
            @endphp
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8">
                    <div class="mil-iconbox mil-mb-40-adapt mil-fade-up mil-text-center">
                        @if ($data->payment_status === 'paid')
                            @if($currentDate < $reservedDate)
                                @if ($daysDifference >= 3)
                                    <p class="mil-mb-20">
                                        Nomor tiket kamu #{{ $data->trans_num }}<br>
                                        Tanggal reservasi: {{ date('Y-m-d', strtotime($data->start_date)) }} sd. {{ date('Y-m-d', strtotime($data->end_date)) }}<br>
                                        Status pembayaran: Lunas / IDR {{ number_format($data->total_amount) }}<br>
                                        Dana refund: IDR {{ number_format($refund) }}
                                    </p>
                                    <p class="mil-mb-20">
                                        Sesuai aturan yang berlaku saat ini, karena kamu membatalkan lebih dari 3 hari sebelum tanggal reservasi yang kamu tentukan, maka kami akan mengembalikan {{ $rule->value }}% dari pembayaran yang sudah kamu selesaikan sebelumnya.<br>
                                        Sedih sih 😞 tapi setidaknya beri tau kami alasan kamu ya 🙏🏻
                                    </p>                            
                                @else
                                    <p class="mil-mb-20">
                                        Nomor tiket kamu #{{ $data->trans_num }}<br>
                                        Tanggal check-in: {{ date('Y-m-d', strtotime($data->start_date)) }}<br>
                                        Status pembayaran: Lunas / IDR {{ number_format($data->total_amount) }}<br>
                                        Dana refund: -
                                    </p>
                                    <p class="mil-mb-20">
                                        Sesuai aturan yang berlaku saat ini, karena kamu membatalkan lebih dari 3 hari sebelum tanggal reservasi yang kamu tentukan, maka kami akan mengembalikan {{ $rule->value }}% dari pembayaran yang sudah kamu selesaikan sebelumnya.<br>
                                        Sedih sih 😞 tapi setidaknya beri tau kami alasan kamu ya 🙏🏻
                                    </p>
                                @endif
                            @else
                                <p class="mil-mb-20">
                                    Nomor tiket kamu #{{ $data->trans_num }}<br>
                                    Tanggal check-in: {{ date('Y-m-d', strtotime($data->start_date)) }}<br>
                                    Status pembayaran: Lunas / IDR {{ number_format($data->total_amount) }}<br>
                                    Dana refund: -
                                </p>
                                <p class="mil-mb-20">
                                    Sesuai aturan yang berlaku saat ini, karena kamu membatalkan sudah lewat dari tanggal reservasi, maka tidak ada data refund yang akan dikembalikan.<br>
                                    Sedih sih 😞 tapi setidaknya beri tau kami alasan kamu ya 🙏🏻
                                </p>
                            @endif
                        @else
                            <p class="mil-mb-20">
                                Sedih sih 😞 tapi setidaknya beri tau kami alasan kamu ya 🙏🏻
                            </p>
                        @endif

                        <form id="form_cancel">
                            @csrf
                            <div class="mil-field-frame mil-mb-20">
                                <input type="hidden" class="mil-text-center" name="id" id="id" value="{{ $data->id }}" readonly>
                                <input type="hidden" class="mil-text-center" name="payment_status" id="payment_status" value="{{ $data->payment_status }}" readonly>
                                <input type="hidden" class="mil-text-center" name="refund" id="refund" value="{{ $refund }}" readonly>
                                <input type="hidden" class="mil-text-center" name="omzet" id="omzet" value="{{ $data->total_amount - $refund }}" readonly>
                                <input type="text" class="mil-text-center" name="cancel_reason" id="cancel_reason" placeholder="Tulis alasan kamu disini">
                            </div>

                            <button type="button" class="mil-button mil-accent-1 mil-mb-10" onclick="save()">
                                <span>Batalkan Reservasi</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page_js')
    <script>
        $('#cancel_reason').focus();

        function save(){
            let cancelReason = document.getElementById('cancel_reason');
            if(cancelReason.value.trim() === ''){
                swalInit.fire({
                    title: 'Oops!',
                    html: 'Silahkan isi alasan pembatalan',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
            }

            $.ajax({
                type: "POST",
                url: "{{ route('front_cancel.submit') }}",
                data: $('#form_cancel').serialize(),
                success: function (s) {
                    sw_success_redirect(s, "{{ route('home') }}");
                },
                error: function(e){
                    sw_multi_error(e);
                },
            });
        }
    </script>
@endsection