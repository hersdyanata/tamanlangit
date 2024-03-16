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
                            <h1 class="mil-mb-40">{{ $post->title }}</h1>
                            <div class="mil-suptitle mil-breadcrumbs">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">{{ $post->category->title }}</a></li>
                                    <li><a href="#">{{ $post->title }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- publication -->
    <div class="mil-pub-frame mil-mb-40">
        <div class="container mil-p-100-100">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    {!! $post->content !!}
                    <div class="mil-divider mil-mb-100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- publication end -->
@endsection