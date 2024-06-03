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
                            <h1 class="mil-mb-40">Pembayaran Berhasil!</h1>
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
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6">
                    <div class="mil-iconbox mil-mb-40-adapt mil-fade-up mil-text-center">
                        <div class="mil-bg-icon"></div>
                        <div class="mil-text-center">
                            <svg viewBox="0 0 24 24" width="96" height="96" stroke="rgb(64, 140, 76)" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <h3 class="mil-mb-20">Rincian dan tiket untuk sudah kami kirim ke email kamu, silahkan cek inbox atau spam box.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page_js')
@endsection