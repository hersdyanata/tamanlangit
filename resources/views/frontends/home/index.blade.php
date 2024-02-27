@extends('layouts.frontend')

@section('content')
    @include('frontends.home.elements.topbar')
    @include('frontends.home.elements.banner')
    @include('frontends.home.elements.services')
    @include('frontends.home.elements.features')
    @include('frontends.home.elements.catalogs')
    @include('frontends.home.elements.actions')
    @include('frontends.home.elements.about')
    @include('frontends.home.elements.reviews')
    @include('frontends.home.elements.footer')
    @include('frontends.home.elements.book_popup')
@endsection