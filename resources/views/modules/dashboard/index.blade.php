@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
@php
    $start_date = date('Y-m-01');
    $end_date = date('Y-m-d');
@endphp
<div class="col-lg-5 mb-3">
    <label class="form-label">Periode:</label>
    <input type="text" class="form-control input-sm" placeholder="Periode..." id="tanggal" name="tanggal" autocomplete="off" value="{{ $start_date.' - '.$end_date }}">
</div>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        $('#tanggal').daterangepicker({
            parentEl: '.content-inner',
            locale: {
                format: 'YYYY-MM-DD', // Set the date format
                cancelLabel: 'Clear',
            },
        });
    });
</script>
@endsection