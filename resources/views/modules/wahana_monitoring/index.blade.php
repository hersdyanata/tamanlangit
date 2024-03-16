@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<div class="row col-xl-12">
    <div class="col-lg-3">
        <div class="card shadow-xs">
            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto"><i class="ph-gear"></i> {{ $title }}</h6>
            </div>
        
            <div class="card-body">
                <form id="formData">
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="text" class="form-control datepicker-autohide" name="tanggal" id="tanggal" value="2024-03-01" autocomplete="off">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Wahana</label>
                        <select class="form-control select" data-minimum-results-for-search="Infinity" name="wahana" id="wahana">
                            @foreach ($wahana as $r)
                                <option value="{{ $r->id }}"
                                        data-rooms="{{ json_encode($r->rooms) }}"
                                        data-images="{{ json_encode($r->images) }}">
                                    {{ ucwords(strtolower($r->name)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="mt-2 mb-2 form-check form-check-inline form-switch">
                        <input type="checkbox" class="form-check-input" id="scroller">
                        <label class="form-check-label" for="scroller" id="scroller_caption">Aktifkan Bergulir Otomatis</label>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Refresh Rate (Menit)</label>
                        <input type="text" class="form-control" name="refresh_rate" id="refresh_rate" value="5" autocomplete="off">
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="row mb-2" id="loader">
                            <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" id="thumbnails">
            
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
    let displayImageThumbnails = document.getElementById('thumbnails');
    let scroller = document.getElementById('scroller');
    let srollerCaption = document.getElementById('scroller_caption');
    let refreshRate = document.getElementById('refresh_rate');
    let intervalID;
    
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
            let imageThumbnails = wahanaSelected.data('images');
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

            displayImageThumbnails.innerHTML = '';
            imageThumbnails.forEach(image => {
                if(image.is_map == 'Y'){
                    let rendered_image = "{{ asset(':path/image') }}".replace(':path/image', image.image_path);
                    displayImageThumbnails.innerHTML += '<div class="col-xl-6">\
                                                            <div class="card">\
                                                                <div class="card-img-actions mx-1 mb-1 mt-1">\
                                                                    <img class="card-img img-fluid" src="'+rendered_image+'" alt="">\
                                                                    <div class="card-img-actions-overlay card-img">\
                                                                        <a href="'+rendered_image+'" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">\
                                                                            <i class="ph-magnifying-glass-plus"></i>\
                                                                        </a>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>';
                }
            });

            const lightbox = GLightbox({
                selector: '[data-bs-popup="lightbox"]',
                loop: true,
                svg: {
                    next: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
                    prev: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
                }
            });

            // lightbox.open();

        }else{
            displayImageThumbnails.innerHTML = '';
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

    scroller.addEventListener('change', function(){
        if (this.checked) {
            srollerCaption.innerHTML = 'Hentikan Bergulir Otomatis';
            autochange();
        } else {
            srollerCaption.innerHTML = 'Aktifkan Bergulir Otomatis';
            clearInterval(intervalID);
        }
    });

    function autochange() {
        const wahana = document.querySelector('#wahana');
        const options = Array.from(wahana.options)
            .filter(option => option.value !== null)
            .map(option => option.value);

        let currentIndex = 0;
        intervalID = setInterval(() => {
            wahana.value = options[currentIndex];
            currentIndex = (currentIndex + 1) % options.length;

            if (wahana.value !== null) {
                const event = new Event('change', { bubbles: true });
                wahana.dispatchEvent(event);
            }
        }, parseInt(refreshRate.value) * 60000);
    }
</script>
@endsection