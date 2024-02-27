@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<div class="row col-xl-12">
    <div class="col-lg-3">
        <div class="card border border-primary border-opacity-75 shadow-xs">
            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto"><i class="ph-gear"></i> {{ $title }}</h6>
            </div>
        
            <div class="card-body">
                <form id="formData">
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Tanggal</label>
                        {{-- <input type="text" class="form-control datepicker-autohide" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" readonly> --}}
                        <input type="text" class="form-control datepicker-autohide" name="tanggal" id="tanggal" value="2024-03-01">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Wahana</label>
                        <select class="form-control select" data-minimum-results-for-search="Infinity" name="wahana" id="wahana">
                            <option value="">Pilih Wahana</option>
                            @foreach ($wahana as $r)
                                <option value="{{ $r->id }}" data-rooms="{{ json_encode($r->rooms) }}">{{ ucwords(strtolower($r->name)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="row mb-2" id="loader">
                            <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="row" id="roomDisplay">
            <div class="card card-body">
                <blockquote class="blockquote text-center py-2 mb-0">
                    <div class="mb-2">
                        <i class="ph-house-line ph-5x text-muted opacity-25"></i>
                    </div>

                    <p class="mb-1">Untuk mengetahui ketersediaan tenda di tanggal tertentu silahkan memilih wahana tertentu.</p>
                    <footer class="blockquote-footer">Fitur ini menerapkan kondisi: <cite title="Source Title">Reservasi Aktif (tidak dibatalkan), tanggal reservasi mulai dari tanggal yang dipilih</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    sidebar_collapsed();
    $('#loader').hide();

    let wahana = $('#wahana');
    wahana.select2();
    let roomDisplay = document.getElementById('roomDisplay');
    
    let tanggal = document.getElementById('tanggal');
    let dpicker = new Datepicker(tanggal, {
        container: '.content-inner',
        buttonClass: 'btn',
        prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
        nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
        autohide: true,
        format: 'yyyy-mm-dd',
    });

    $(tanggal).on('changeDate', function() {
        wahana.trigger('change');
    });

    wahana.on('change', function() {
        if(this.value != ''){
            let wahanaSelected = $(this).find('option:selected');
            let rooms = wahanaSelected.data('rooms');
            let background = '';
    
            getReservation(this.value, tanggal.value, function(reservations) {
                roomDisplay.innerHTML = null;
                if (rooms && typeof rooms === 'object') {
                    Object.keys(rooms).forEach(room => {
                        let roomInfo = rooms[room];
                        let createUrl = "{{ route('transaksi.reservasi.create.params', [':date', ':wahana', ':room']) }}";
                        createUrl = createUrl.replace(':date', tanggal.value).replace(':wahana', wahana.val()).replace(':room', roomInfo.id);

                        roomDisplay.innerHTML += '<div class="col-sm-2">\
                                                    <a id="aHref_'+ roomInfo.id +'" href="'+ createUrl +'" class="link-success text-dark">\
                                                        <div id="divRoom_'+ roomInfo.id +'" class="card card-body border bg-success bg-opacity-25 shadow-xs border-opacity-75 border-success text-center">\
                                                            <i class="ph-house-line ph-2x"></i>\
                                                            <h6 class="mb-0">'+ roomInfo.name +'</h6>\
                                                            <span class="fs-sm text-muted" id="availabilityInfo_'+ roomInfo.id +'">Available</span>\
                                                        </div>\
                                                    </a>\
                                                </div>';
                    });
    
                    if(reservations.isExists == true){
                        reservations.data.forEach(item => {
                            $('#divRoom_'+item.room_id).addClass('bg-danger bg-opacity-25');
                            $('#availabilityInfo_'+item.room_id).html('');
                            $('#aHref_'+item.room_id).addClass('link-danger');
                            document.getElementById('aHref_'+item.room_id).href = "#";
                            $('#divRoom_'+item.room_id).addClass('border-danger');
                            $('#availabilityInfo_'+item.room_id).html('#' + item.trans_num);
                        });
                    }
                } else {
                    console.log('Invalid or empty rooms data');
                }
            });
        }else{
            roomDisplay.innerHTML = '<div class="card card-body">\
                                        <blockquote class="blockquote text-center py-2 mb-0">\
                                            <div class="mb-2">\
                                                <i class="ph-house-line ph-5x text-muted opacity-25"></i>\
                                            </div>\
                                            <p class="mb-1">Untuk mengetahui ketersediaan tenda di tanggal tertentu silahkan memilih wahana tertentu.</p>\
                                            <footer class="blockquote-footer">Fitur ini menerapkan kondisi: <cite title="Source Title">Reservasi Aktif (tidak dibatalkan), tanggal reservasi mulai dari tanggal yang dipilih</cite></footer>\
                                        </blockquote>\
                                    </div>';
        }
    });

    function getReservation(wahanaId, dateSelected, callback){
        $.ajax({
            type: "POST",
            url: "{{ route('wahana.monitoring.store') }}",
            data: {
                _token: "{{ csrf_token() }}",
                wahana_id: wahanaId,
                date: dateSelected
            },
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                sw_success(s);
                callback(s);
            },
            complete: function(){
                $('#loader').hide();
            }
        });
    }
</script>
@endsection