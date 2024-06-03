@extends('layouts.frontend')

@section('page_resources')
    <script src="{{ asset('assets/fe/js/plugins/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection

@section('page_css')
    <link href="{{ asset('assets/fe/css/additional.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
@endsection

@section('subtitle')
    | {{ ucwords(strtolower($data->name)) }}
@endsection

@section('meta_data')
    <meta name="description" content="{{ $data->description }}">
    <meta name="keywords" content="{{ strtolower($data->keywords) }}">
    <meta name="author" content="{{ $data->creator->name }}">
@endsection

@section('content')
    <!-- banner -->
    <div class="mil-p-100-60">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; top: 0; right: -12%; transform: rotate(180deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 80%; bottom: -12%; right: -22%; transform: rotate(0deg) scaleX(-1);" alt="shape">
        <div class="container">
            <div class="mil-banner-head">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <h1 class="mil-h2-lg mil-mb-40">{{ ucwords(strtolower($data->name)) }}</h1>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="mil-desctop-right mil-right-no-m mil-fade-up mil-mb-40">
                            <div class="mil-suptitle mil-breadcrumbs mil-light">
                                <ul>
                                    <li><a href="home-1.html">Beranda</a></li>
                                    <li><a href="search.html">Paket Wisata</a></li>
                                    <li><a href="room-1.html">{{ ucwords(strtolower($data->name)) }}</a></li>
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
                    <!-- room slider -->
                    <div class="mil-slider-frame mil-frame-2 mil-mb-100">
                        <div class="swiper-container mil-room-slider" style="overflow: hidden">
                            <div class="swiper-wrapper">
                                @php
                                    $mapImage = 'Tidak ada';
                                @endphp
                                @forelse ($data->images as $r)
                                    @if ($r->is_map == null)
                                        <div class="swiper-slide">
                                            <div class="mil-image-frame">
                                                <img src="{{ asset($r->image_path) }}" alt="room" data-swiper-parallax="0" data-swiper-parallax-scale="1.2">
                                            </div>
                                        </div>
                                    @else
                                        @php
                                            $mapImage = '<a href="'.asset($r->image_path).'" target="_blank">
                                                            <img src="'.asset($r->image_path).'" alt="room" width="80%">
                                                        </a>';
                                        @endphp
                                    @endif
                                @empty
                                    <div class="swiper-slide">
                                        <div class="mil-image-frame">
                                            <div class="mil-card-cover"></div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mil-room-nav">
                            <div class="mil-slider-btn mil-room-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                            <div class="mil-slider-btn mil-room-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div class="mil-room-pagination" style="bottom: 8px"></div>
                    </div>
                    <!-- room slider end -->

                    <!-- features -->
                    <div class="row mil-mb-60-adapt">
                        <div class="col-12">
                            <h3 class="mil-fade-up mil-mb-40">Fasilitas</h3>
                        </div>
                        @foreach ($data->facilities as $r)
                            <div class="col-xl-4">
                                <div class="mil-iconbox mil-iconbox-sm mil-mb-40-adapt mil-fade-up">
                                    <div class="mil-bg-icon"></div>
                                    <div class="mil-icon mil-icon-fix">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    </div>
                                    <h5>{{ $r->name }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- features -->

                    <!-- description -->
                    <div class="row">
                        <div class="col-xl-11 mil-fade-up">
                            <div class="mil-dercription mil-mb-100">
                                <h3 class="mil-mb-20">Deskripsi</h3>
                                {!! $data->description !!}
                            </div>
                        </div>
                    </div>
                    <!-- description end -->
                    
                    <!-- map -->
                    <div class="mil-mb-100">
                        <h3 class="mil-description mil-fade-up mil-mb-20">Peta</h3>
                        <div class="mil-fade-up">
                            {!! $mapImage !!}
                        </div>
                    </div>
                    <!-- map end -->

                </div>

                <!-- sidebar -->
                <div class="col-xl-4" data-sticky-container>
                    <div class="mil-sticky mil-stycky-right mil-p-0-100" data-margin-top="120">
                        <div class="mil-price-frame mil-mb-20">
                            <div class="mil-price"><span class="mil-symbol">IDR</span><span class="mil-number">{{ number_format($data->price) }}</span>/per malam</div>
                        </div>
                        <ul class="mil-parameters mil-mb-20">
                            <li>
                                <div class="mil-icon">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M12.7432 5.75582C12.6516 7.02721 11.7084 8.00663 10.6799 8.00663C9.65144 8.00663 8.70673 7.02752 8.6167 5.75582C8.52291 4.43315 9.44106 3.505 10.6799 3.505C11.9188 3.505 12.837 4.45722 12.7432 5.75582Z" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10.6793 10.0067C8.64232 10.0067 6.68345 11.0185 6.19272 12.9889C6.12771 13.2496 6.29118 13.5075 6.55905 13.5075H14.7999C15.0678 13.5075 15.2303 13.2496 15.1662 12.9889C14.6755 10.9869 12.7166 10.0067 10.6793 10.0067Z" stroke="black" stroke-width="1.00189" stroke-miterlimit="10" />
                                            <path d="M6.42937 6.31713C6.3562 7.33276 5.59385 8.13264 4.77209 8.13264C3.95033 8.13264 3.18672 7.33308 3.1148 6.31713C3.04007 5.26053 3.7821 4.50537 4.77209 4.50537C5.76208 4.50537 6.50411 5.27992 6.42937 6.31713Z" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.61604 10.0688C6.05177 9.81023 5.4303 9.71082 4.77162 9.71082C3.14604 9.71082 1.57985 10.5189 1.18752 12.0929C1.13594 12.3011 1.26661 12.5071 1.48043 12.5071H4.99045" stroke="black" stroke-width="1.00189" stroke-miterlimit="10" stroke-linecap="round" />
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="16.0035" height="16.0035" fill="white" transform="translate(0.176514 0.504028)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>Maks. {{ $data->max_person }} orang</div>
                            </li>
                            <li>
                                <div class="mil-icon">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.9578 14.6084H12.7089C13.1733 14.6084 13.6187 14.4239 13.9471 14.0955C14.2755 13.7671 14.46 13.3217 14.46 12.8573V11.1062" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.46 6.10644V4.35534C14.46 3.89092 14.2755 3.44553 13.9471 3.11713C13.6187 2.78874 13.1733 2.60425 12.7089 2.60425H10.9578" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.95898 14.6084H4.20788C3.74346 14.6084 3.29806 14.4239 2.96967 14.0955C2.64128 13.7671 2.45679 13.3217 2.45679 12.8573V11.1062" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M2.45679 6.10644V4.35534C2.45679 3.89092 2.64128 3.44553 2.96967 3.11713C3.29806 2.78874 3.74346 2.60425 4.20788 2.60425H5.95898" stroke="black" stroke-width="1.00189" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>Luas: {{ $data->room_wide }}m²</div>
                            </li>
                        </ul>

                        <div class="mil-book-window">
                            <form method="POST" action="{{ route('reservasi.form') }}" onsubmit="return validateForm()">
                                @csrf
                                <input type="hidden" name="wahana_id" value="{{ $data->id }}" readonly>
                                <div class="mil-field-frame mil-mb-20">
                                    <label>Tanggal Reservasi</label>
                                    <input id="reservation_date" name="reservation_date" class="daterange-basic" type="text">
                                </div>

                                <input type="hidden" name="nights" id="nights" readonly>

                                <div class="mil-field-frame mil-mb-20">
                                    <label>Tenda</label>
                                    <select class="select" name="tent" id="tent" data-minimum-results-for-search="Infinity">
                                        <option value="">-- Pilih Tenda --</option>
                                        @foreach ($data->rooms as $r)
                                            @if ($r->status === 'A')
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mil-field-frame mil-mb-20">
                                    <label>Anggota</label>
                                    <input type="number" name="person_quantity" id="person_quantity" placeholder="Enter quantity" min="1" value="1">
                                </div>

                                <button type="submit" class="mil-button mil-accent-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    <span>Pesan</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- sidebar end -->
            </div>

			@include('frontends.pages.wahana_reviews')
        </div>
    </div>
    <!-- room info end -->
@endsection

@section('page_js')
<script>
        let inputNightCount = document.getElementById('nights');
        let inputPerson = document.getElementById('person_quantity');
        let inputTent = document.getElementById('tent');

        $(document).ready(function() {
            $('.select').each(function(){
                $(this).select2();
            });

            $('.daterange-basic').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear',
                },
                minDate: moment(),
            });
        });

        inputPerson.addEventListener('change', function() {
            let maxPerson = "{{ $data->max_person }}";
            if(this.value > maxPerson){
                this.value = this.value -1 ;
                swalInit.fire({
                    title: 'Maaf!',
                    html: 'Jumlah anggota tidak bisa melebihi ' + maxPerson + ' orang.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
            }
        });

        $('#reservation_date').on('change', function() {
            const dateRange = $('#reservation_date').val();
            const [startDate, endDate] = dateRange.split(' - ');
            const start = new Date(startDate);
            const end = new Date(endDate);
            const oneDay = 24 * 60 * 60 * 1000; // One day in milliseconds
            const nightCount = Math.round(Math.abs((end - start) / oneDay));

            inputNightCount.value = nightCount;
        });

        function validateForm() {
            if (inputNightCount.value < 1) {
                swalInit.fire({
                    title: 'Maaf!',
                    html: 'Silahkan tentukan tanggal reservasi terlebih dahulu.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                return false;
            }
        }
    </script>
@endsection