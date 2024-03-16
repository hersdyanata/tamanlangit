@extends('layouts.frontend')

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<!-- banner -->
<div class="mil-p-100-60">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; top: -5%; right: -12%; transform: rotate(180deg)" alt="shape">
    <div class="container">
        <div class="mil-banner-head">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <h1 class="mil-h2-lg mil-mb-40">Frequent Asked Questions</h1>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="mil-desctop-right mil-right-no-m mil-fade-up mil-mb-40">
                        <div class="mil-suptitle mil-breadcrumbs mil-light">
                            <ul>
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- room info -->
<div class="mil-info">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; bottom: -20%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-8">
                <h3 class="mil-fade-up mil-mb-40">Gak usah bingung. Yuk cari tau disini!</h3>
                <div class="mil-faq-section mil-mb-100">

                    @foreach ($faqs as $faq)
                        <div class="mil-faq-item mil-fade-up @if ($loop->first) active @endif">
                            <div class="mil-faq-question">
                                <span class="mil-icon">+</span>
                                <h3>{{ $faq->question }}</h3>
                            </div>
                            <div class="mil-faq-answer">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- sidebar -->
            <div class="col-xl-4" data-sticky-container>

                <div class="mil-sticky mil-stycky-right mil-p-0-100" data-margin-top="140">
                    <h3 class="mil-mb-40">Paket Wisata</h3>

                    @foreach ($wahana as $r)
                        <a href="{{ route('wahana_detail', $r->slug) }}" class="mil-service-card-sm mil-mb-20 mil-fade-up">
                            <div class="mil-img-frame">
                                @foreach ($r->images as $img)
                                    <img src="{{ asset($img->image_path) }}" alt="img">
                                @endforeach
                            </div>
                            <div class="mil-description">
                                <h4>{{ ucwords(strtolower($r->name)) }}</h4>
                            </div>
                        </a>
                    @endforeach


                    <a href="{{ route('wahana') }}" class="mil-button mil-accent-1 mil-reply">
                        <span>Tampilkan Semua</span>
                    </a>

                </div>
            </div>
            <!-- sidebar end -->
        </div>
    </div>
</div>
<!-- room info end -->
@endsection

@section('page_js')
    <script src="{{ asset('assets/fe/js/plugins/sticky.js') }}"></script>
@endsection