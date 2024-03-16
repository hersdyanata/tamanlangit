@extends('layouts.frontend')

@section('subtitle')
    | {{ $title }}
@endsection

@section('meta_data')
    <meta name="description" content="{{ $cms->content }}">
    <meta name="keywords" content="camping ground">
    <meta name="author" content="{{ $cms->creator->name }}">
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
                            <h1 class="mil-mb-40">Mari kita <br>berkenalan</h1>
                            <div class="mil-suptitle mil-breadcrumbs">
                                <ul>
                                    <li><a href="{{ route('home') }}">Beranda</a></li>
                                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- banner end -->

    <!-- about 1 -->
    <div class="mil-content-pad mil-p-100-60 mil-mb-100">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-12">
                    <div class="mil-suptitle mil-mb-20 mil-fade-up">Tentang Kami</div>
                    <h2 class="mil-mb-60-adapt mil-fade-up">Sepenggal Cerita Tentang {{ ENV('APP_NAME') }}</h2>
                </div>
                <div class="col-xl-12">
                    {!! $cms->content !!}
                </div>
            </div>
        </div>
    </div>
    <!-- about 1 -->
@endsection