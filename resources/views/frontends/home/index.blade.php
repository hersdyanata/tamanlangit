@extends('layouts.frontend')

@section('subtitle')
    | {{ $title }}
@endsection

@section('meta_data')
    <meta name="description" content="This is a sample description.">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <meta name="author" content="Your Name">
@endsection

@section('content')
    @include('frontends.home.elements.banner')
    @include('frontends.home.elements.services')
    {{-- @include('frontends.home.elements.features') --}}
    @include('frontends.home.elements.catalogs')
    @include('frontends.home.elements.actions')
    @include('frontends.home.elements.about')
    @include('frontends.home.elements.reviews')
@endsection

{{-- API KEY : RZTTC2Y-YZ7M6C6-J3BWRY0-AY9DWND --}}