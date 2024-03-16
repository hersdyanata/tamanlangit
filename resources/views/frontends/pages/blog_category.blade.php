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
                <div class="col-xl-12">

                    <div class="mil-banner-content-frame">
                        <div class="mil-banner-content mil-text-center">
                            <h1 class="mil-mb-40">Jelajahi {{ ENV('APP_NAME') }}<br>lewat teropong kami🔭</h1>
                            <div class="mil-suptitle mil-breadcrumbs">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="{{ route('blog_category', $category->url) }}">{{ $category->title }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- blog -->
    <div class="mil-rooms mil-p-100-100">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; top: -20%; left: -30%; transform: rotate(35deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; bottom: -12%; right: -30%; transform: rotate(-30deg) scaleX(-1);" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
        <div class="container">
            <div class="row mil-mb-40">
                @forelse ($posts as $post)
                    <div class="col-xl-4">
                        <a href="{{ route('post', [$post->category->url, $post->url]) }}" class="mil-card mil-mb-40-adapt mil-fade-up">
                            <div class="swiper-container mil-card-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="mil-card-cover">
                                            <img src="{{ asset('assets/images/demo/blog/4.jpg') }}" alt="cover" data-swiper-parallax="-100" data-swiper-parallax-scale="1.1">
                                        </div>
                                    </div>
                                </div>
                                <div class="mil-card-nav">
                                    <div class="mil-slider-btn mil-card-prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                    <div class="mil-slider-btn mil-card-next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mil-card-pagination"></div>
                            </div>
                            <ul class="mil-parameters">
                                <li>
                                    <div class="mil-icon">
                                        <img src="{{ asset('assets/fe/img/faces/6.jpg') }}" alt="author">
                                    </div>
                                    <div>{{ $post->creator->name }}</div>
                                </li>
                                <li>
                                    <div class="mil-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.1881 2.62402H3.18597C2.35736 2.62402 1.68564 3.29574 1.68564 4.12435V13.1263C1.68564 13.9549 2.35736 14.6266 3.18597 14.6266H13.1881C14.0168 14.6266 14.6885 13.9549 14.6885 13.1263V4.12435C14.6885 3.29574 14.0168 2.62402 13.1881 2.62402Z" stroke="#272746" stroke-width="1.00189" stroke-linejoin="round" />
                                            <path d="M4.18536 1.62305V2.63226" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.188 1.62305V2.63226" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.6885 5.12402H1.68564" stroke="#272746" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>{{ date('d.m.Y', strtotime($post->created_at)) }}</div>
                                </li>
                            </ul>
                            <div class="mil-descr">
                                <h3 class="mil-mb-20">{{ $post->title }}</h3>
                                <p class="mil-mb-20">{!! Str::limit($post->content, 105, '...') !!}</p>
                                <div class="mil-divider"></div>
                                <div class="mil-card-bottom">
                                    <div class="mil-link">
                                        <span>Baca Lebih Lanjut</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="row align-items-center mil-text-center justify-content-center mil-mb-40">
                        <div class="col-xl-12">
                            <h3 class="mil-mb-40">Belum ada yang nulis nih 😅</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- blog end -->
@endsection