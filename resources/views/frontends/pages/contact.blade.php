@extends('layouts.frontend')

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
        <!-- banner -->
        <div class="mil-banner-sm">
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
                                <h1 class="mil-mb-40">Mari Terhubung!</h1>
                                <div class="mil-suptitle mil-breadcrumbs">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Beranda</a></li>
                                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- banner end -->

        @php
            $kontak = getContact();
        @endphp

        <!-- contact info -->
        <div class="mil-contact mil-p-100-60">
            <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
            <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="mil-iconbox mil-mb-40-adapt mil-fade-up">
                            <div class="mil-bg-icon"></div>
                            <div class="mil-icon mil-icon-fix">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call">
                                    <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                {{-- <i class="ph-phone-call ph-5x"></i> --}}
                            </div>
                            <h3 class="mil-mb-20">{{ $kontak->mobile_number }}</h3>
                            <p>Silahkan hubungi kami kapanpun.</p>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="mil-iconbox mil-mb-40-adapt mil-fade-up">
                            <div class="mil-bg-icon"></div>
                            <div class="mil-icon mil-icon-fix">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <h3 class="mil-mb-20">{{ $kontak->email }}</h3>
                            <p>Kami akan membalas secepat mungkin.</p>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="mil-iconbox mil-mb-40-adapt mil-fade-up">
                            <div class="mil-bg-icon"></div>
                            <div class="mil-icon mil-icon-fix">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <h3 class="mil-mb-20">Pangalengan, Kab. Bandung</h3>
                            <p>Ayo merapat!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact info end -->

        <!-- map -->
        <div class="mil-p-0-100">
            <div class="container">
                <div class="mil-map-frame mil-fade-up">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15832.41682160483!2d107.51714500946623!3d-7.228954038286724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68914469b3196f%3A0x7e0b4b479efb8424!2sTaman%20Langit%20Pangalengan%20(Sunrise%20Point%20%26%20Camping%20Ground)!5e0!3m2!1sid!2sid!4v1709631214338!5m2!1sid!2sid"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen="yes"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        <!-- map end -->
@endsection