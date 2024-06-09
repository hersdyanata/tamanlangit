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
    | {{ $title }}
@endsection

@section('meta_data')
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
                        <h2 class="mil-h2-lg mil-mb-40">Reservasi {{ ucwords(strtolower($data->name)) }}</h2>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <div class="mil-desctop-right mil-right-no-m mil-fade-up mil-mb-40">
                            <div class="mil-suptitle mil-breadcrumbs mil-light">
                                <ul>
                                    <li><a href="#">Beranda</a></li>
                                    <li><a href="#">Reservasi</a></li>
                                    <li><a href="#">Paket Wisata</a></li>
                                    <li><a href="#">{{ ucwords(strtolower($data->name)) }}</a></li>
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
                <div class="col-xl-8 mil-mb-100">
                    <form id="form_data">
                        @csrf
                        <input type="hidden" name="wahana_id" id="wahana_id" value="{{ $data->id }}" readonly>
                        <div class="mil-field-frame mil-mb-20">
                            <div class="row col-xl-12">
                                <div class="col-lg-5">
                                    <label>Tanggal Reservasi</label>
                                    <input id="reservation_date" name="reservation_date" class="daterange-basic" type="text" value="{{ date('Y-m-d', strtotime($start_date)).' - '.date('Y-m-d', strtotime($end_date)) }}">
                                </div>
    
                                <div class="col-lg-4">
                                    <label>Malam</label>
                                    <input id="nights" name="nights" type="text" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mil-field-frame mil-mb-20">
                            <label>Tenda</label>
                            <select class="select" name="tent" id="tent" data-minimum-results-for-search="Infinity">
                                <option value="">-- Pilih Tenda --</option>
                                @foreach ($data->rooms as $r)
                                    @if ($r->status === 'A')
                                        <option value="{{ $r->id }}" {{ ($tent == $r->id) ? 'selected' : '' }}>{{ $r->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mil-field-frame mil-mb-20">
                            <label>Anggota</label>
                            <input type="number" name="persons" id="persons" placeholder="Enter quantity" value="{{ $persons }}">
                        </div>

                        <div class="mil-field-frame mil-mb-20">
                            <label>Nama</label>
                            <input type="text" placeholder="Tulis nama..." name="name" id="name">
                        </div>

                        <div class="mil-field-frame mil-mb-20">
                            <label>Email</label>
                            <input type="text" placeholder="Alamat email..." name="email" id="email">
                        </div>

                        <div class="mil-field-frame mil-mb-20">
                            <label>Nomor WhatsApp</label>
                            <input type="text" placeholder="Nomor yang dapat dihubungi & terhubung ke Whatsapp..." name="wa_number" id="wa_number">
                        </div>
                        
                        <div class="mil-field-frame mil-mb-20">
                            <input type="hidden" name="price" id="price" value="{{ $data->price }}" readonly>
                            <input type="hidden" name="max_person" id="max_person" value="{{ $data->max_person }}" readonly>
                            <input type="hidden" name="ppn" id="ppn" value="{{ $ppn }}" readonly>
                            <input type="hidden" name="ppn_amount" id="ppn_amount" value="{{ $ppn }}" readonly>
                            <input type="hidden" name="subtotal" id="subtotal" readonly>
                            <input type="hidden" name="coupon_id" id="coupon_id" readonly>
                            <input type="hidden" name="discount" id="discount" readonly>
                            <input type="hidden" name="discount_type" id="discount_type" readonly>
                            <input type="hidden" name="total_amount" id="total_amount" readonly>
                        </div>

                        <div class="mil-divider mil-mb-30"></div>

                         <!-- map -->
                        <div class="mil-mb-100">
                            <h3 class="mil-description mil-fade-up mil-mb-20">Peta</h3>
                            <div class="mil-fade-up">
                                @forelse ($data->images as $r)
                                    @if ($r->is_map == 'Y')
                                        <div class="mil-mb-100">
                                            <a href="{{ asset($r->image_path) }}" target="_blank">
                                                <img src="{{ asset($r->image_path) }}" alt="room" width="80%">
                                            </a>
                                        </div>
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
                        <!-- map end -->
                    </form>
                </div>


                <!-- sidebar -->
                <div class="col-xl-4" data-sticky-container>
                    <div class="mil-sticky mil-stycky-right mil-p-0-100" data-margin-top="120">
                        <ul class="mil-bill-frame mil-parameters bg-success mil-mt-20 mil-mb-20">
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
                        <div class="mil-bill-frame mil-mt-20">
                            <div class="row mil-mb-15">
                                <div class="col-md-6">
                                    <h3>Harga</h3>
                                </div>
                                <div class="col-md-6" style="text-align: end;">
                                    <h3 id="display_price"></h3>
                                </div>
                            </div>

                            <div class="row mil-mb-15">
                                <div class="col-md-6">
                                    <h3>Subtotal</h3>
                                </div>
                                <div class="col-md-6" style="text-align: end;">
                                    <h3 id="display_subtotal"></h3>
                                </div>
                            </div>

                            <div class="row mil-mb-30">
                                <div class="col-md-6">
                                    <h3>PPn</h3>
                                </div>
                                <div class="col-md-6" style="text-align: end;">
                                    <h3 id="display_ppn"></h3>
                                </div>
                            </div>

                            <div class="mil-divider mil-mb-30"></div>

                            <label class="form-check">
                                <h4 class="mil-h4-lg mil-mb-10">
                                    <input type="checkbox" name="toggle_coupon" id="toggle_coupon"> &nbsp;&nbsp;Saya punya Kupon!
                                </h4>
                            </label>

                            <div class="mil-field-frame mil-mb-30">
                                <input type="text" name="input_coupon" id="input_coupon" placeholder="Masukkan kupon...">
                            </div>

                            
                            <div class="mil-divider mil-mb-40"></div>
                            
                            <div id="div_display_discount"></div>
                            <div class="row mil-mb-40">
                                <div class="col-md-6">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-md-6" style="text-align: end;">
                                    <h3 id="display_total_amount"></h3>
                                </div>
                            </div>

                            <button type="button" onclick="save()" class="mil-button mil-accent-1 mil-mb-10 btn-launch-spinner" data-icon="ph-spinner">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <span>Pesan</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>
    </div>
    <!-- room info end -->
@endsection

@section('page_js')
    <script>
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

            setPrice();

            countNights();
            calculateSubtotal();
            calculatePpn();
            calculateTotalAmount();
        });

        const inputReservationDate = document.getElementById('reservation_date');

        let inputName = document.getElementById('name');
        inputName.focus();
        let inputEmail = document.getElementById('email');
        let inputPhone = document.getElementById('wa_number');
        let inputTent = document.getElementById('tent');

        let inputPrice = document.getElementById('price');
        let inputNightCount = document.getElementById('nights');
        let inputMaxPerson = document.getElementById('max_perons');
        let inputPpn = document.getElementById('ppn');
        let inputPpnAmount = document.getElementById('ppn_amount');
        let inputSubtotal = document.getElementById('subtotal');
        let inputDiscount = document.getElementById('discount');
        let inputDiscountType = document.getElementById('discount_type');
        let inputTotalAmount = document.getElementById('total_amount');
        let toggleCoupon = document.getElementById('toggle_coupon');
        let inputCoupon = document.getElementById('input_coupon');
        let inputCouponId = document.getElementById('coupon_id');
        inputCoupon.disabled = true;

        let displayPrice = document.getElementById('display_price');
        let displayPpn = document.getElementById('display_ppn');
        let displaySubtotal = document.getElementById('display_subtotal');
        let displayTotalAmount = document.getElementById('display_total_amount');
        let displayDivDiscount = document.getElementById('div_display_discount');

        $('#tent').on('change', function() {
            checkAvailablility();
        });

        $('#reservation_date').on('change', function() {
            countNights();
            setPrice();
            calculateSubtotal();
            calculatePpn();
            calculateTotalAmount();
            checkAvailablility();
        });

        toggleCoupon.addEventListener('change', function() {
            inputCoupon.disabled = false;
            inputCoupon.focus();
        });

        inputCoupon.addEventListener('change', function() {
            getCoupon(this.value);
        });

        function setPrice(){
            displayPrice.innerHTML = formatCurrency(inputPrice.value) + ' x ' + inputNightCount.value;
        }

        function countNights() {
            const dateRange = $('#reservation_date').val();
            const [startDate, endDate] = dateRange.split(' - ');
            const start = new Date(startDate);
            const end = new Date(endDate);
            const oneDay = 24 * 60 * 60 * 1000; // One day in milliseconds
            const nightCount = Math.round(Math.abs((end - start) / oneDay));

            inputNightCount.value = nightCount;
        }

        function calculateSubtotal(){
            let subtotal;
            subtotal = inputPrice.value * inputNightCount.value;

            inputSubtotal.value = subtotal;
            displaySubtotal.innerHTML = formatCurrency(subtotal);
        }

        function calculatePpn(){
            let ppn = {{ $ppn }};
            let ppn_amount = inputSubtotal.value * ppn / 100;
            // console.log(ppn_amount);
            inputPpnAmount.value = ppn_amount;
            displayPpn.innerHTML = formatCurrency(ppn_amount);
        }

        function calculateTotalAmount(){
            let amount = parseInt(inputSubtotal.value) + parseInt(inputPpnAmount.value);
            inputTotalAmount.value = amount;
            displayTotalAmount.innerHTML = formatCurrency(amount)
        }

        function checkAvailablility(){
            if(inputTent.value != ''){
                $.ajax({
                    type: "POST",
                    url: "{{ route('reservasi.check_availability') }}",
                    data: {
                        _token : "{{ csrf_token() }}",
                        daterange: inputReservationDate.value,
                        wahana_id: "{{ $data->id }}",
                        room_id: inputTent.value,
                        source: 'fe',
                    },
                    success: function (s) {
                        if(s.isAvailable == false){
                            swalInit.fire({
                                title: 'Maaf, jadwal Bentrok!',
                                html: s.message,
                                type: 'error',
                                icon: 'error',
                                confirmButtonClass: 'btn btn-danger',
                                allowOutsideClick: false
                            });

                            $('#tent').val(null).trigger('change');
                        }
                    },
                });
            }
        }

        function getCoupon(code){
            $.ajax({
                type: "GET",
                url: "{{ route('reservasi.coupon', [$data->id, ':code']) }}".replace(':code', code),
                success: function (s) {
                    if(s.isActive == false){
                        sw_error(s);
                    }else{
                        sw_success(s);
                        displayDivDiscount.innerHTML = '<div class="row mil-mb-15">\
                                                            <div class="col-md-6">\
                                                                <h3>Diskon</h3>\
                                                            </div>\
                                                            <div class="col-md-6" style="text-align: end;">\
                                                                <h3 id="display_discount"></h3>\
                                                            </div>\
                                                        </div>';
                        calculateDiscount(s.coupon);
                    }
                },
                complete: function(){
                    inputCoupon.value = null;
                    inputCoupon.disabled = true;
                    toggleCoupon.disabled = true;
                }
            });
        }

        function calculateDiscount(coupon){
            let displayDiscount = document.getElementById('display_discount');
            let discountAmount;
            if(coupon.discount_type == 'percentage'){
                discountAmount = parseInt(inputTotalAmount.value) * parseInt(coupon.discount) / 100;
            }else{
                discountAmount = parseInt(coupon.discount);
            }

            inputDiscount.value = discountAmount;
            inputDiscountType.value = coupon.discount_type;
            inputCouponId.value = coupon.id;
            displayDiscount.innerHTML = '-' + formatCurrency(discountAmount);
            calculateGrandTotal();
        }

        function calculateGrandTotal(){
            let grandTotal = inputTotalAmount.value - inputDiscount.value;
            inputTotalAmount.value = grandTotal;
            displayTotalAmount.innerHTML = formatCurrency(grandTotal);
        }

        function save(){
            $.ajax({
                type: "POST",
                url: "{{ route('reservasi.submit') }}",
                data: $('#form_data').serialize(),
                beforeSend: function() {
                    $('.mil-button').prop('disabled', true);
                    openLoader();
                },
                success: function (s) {
                    let redirectUrl = "{{ route('reservasi.make_payment', ':brew') }}".replace(':brew', s.id);
                    sw_success_redirect(s, redirectUrl);
                },
                error: function(e){
                    sw_multi_error(e);
                    // if(e.msg_body){
                    //     sw_multi_error(e);
                    // }else{
                    //     alert(e.error_messages);
                    // }
                },
                complete: function(){
                    closeLoader();
                }
            });
        }
    </script>
@endsection