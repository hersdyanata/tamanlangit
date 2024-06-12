@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<form id="form_data">
    @csrf
    <div class="row col-xl-12">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
                </div>
            
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-10 offset-2">
                            <span class="form-check-label fw-bold text-danger">-- JADWAL DAN PAKET --</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2 fw-bold">Untuk Tanggal</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control border-primary daterange-basic" name="tanggal" id="tanggal"> 
                        </div>
                        <div class="col-lg-2">
                            <input type="hidden" class="form-control border-primary" name="jumlah_malam" id="jumlah_malam" readonly> 
                            <input type="text" class="form-control border-primary" name="jumlah_malam_display" id="jumlah_malam_display" placeholder="Quantity..." readonly> 
                        </div>
                        <div class="col-lg-3">
                            <label class="form-check">
                                <input type="checkbox" name="toggle_checkin" id="toggle_checkin" class="form-check-input form-check-input-primary">
                                <span class="form-check-label">Langsung Check-in</span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2 fw-bold">Paket Wahana</label>
                        <div class="col-lg-4">
                            <select class="form-control select" data-minimum-results-for-search="Infinity" name="wahana_id" id="wahana_id">
                                <option value="" data-max-persons="" data-price="" data-rooms="">-- Pilih Wahana --</option>
                                @foreach ($wahanas as $wahana)
                                    <option value="{{ $wahana->id }}" data-max-persons="{{ $wahana->max_person }}" data-price="{{ $wahana->price }}" data-rooms="{{ json_encode($wahana->rooms) }}">{{ ucwords(strtolower($wahana->name)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="hidden" class="form-control border-primary" name="max_persons" id="max_persons" readonly>
                            <input type="text" class="form-control border-primary" name="max_persons_display" id="max_persons_display" placeholder="Max. Orang...." readonly>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control select" name="room_id" id="room_id">
                                <option value="">-- Tenda --</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control border-primary" name="price" id="price" placeholder="Harga..." readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2 fw-bold">Event Organizer</label>
                        <div class="col-lg-4">
                            <select class="form-control select" data-minimum-results-for-search="Infinity" name="eo_id" id="eo_id">
                                <option value="">-- Pilih Event Organizer --</option>
                                @foreach ($eos as $eo)
                                    <option value="{{ $eo->id }}" data-commission="{{ $eo->commission }}" data-commission-type="{{ $eo->commission_type }}">{{ $eo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <input type="text" class="form-control border-primary" name="eo_commission" id="eo_commission" placeholder="Komisi EO..." readonly>
                        </div>

                        <div class="col-lg-3">
                            <input type="text" class="form-control border-primary" name="eo_commission_type" id="eo_commission_type" placeholder="Jenis Komisi EO..." readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-10 offset-2">
                            <span class="form-check-label fw-bold text-danger">-- PEMESAN --</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2 fw-bold">Nama</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control border-primary" name="name" id="name" placeholder="Nama..."> 
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2 fw-bold">Kontak</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control border-primary" name="email" id="email" placeholder="Email..."> 
                        </div>
                        <div class="col-lg-5">
                            <input type="text" class="form-control border-primary" name="wa_number" id="wa_number" placeholder="Nomor HP yang terhubung ke WhatsApp"> 
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-form-label col-lg-2 fw-bold">Berapa Orang ?</label>
                        <div class="col-lg-3">
                            <input type="number" min="1" class="form-control border-primary" name="persons" id="persons" placeholder="Tentukan jumlah peserta..."> 
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-10 offset-2">
                            <span class="form-check-label fw-bold text-danger">-- KOMPONEN LAIN --</span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-10 offset-2">
                            <label class="form-check">
                                <input type="checkbox" name="toggle_ppn" id="toggle_ppn" class="form-check-input form-check-input-primary">
                                <span class="form-check-label">Terapkan PPn</span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-10 offset-2">
                            <label class="form-check">
                                <input type="checkbox" name="toggle_coupon" id="toggle_coupon" class="form-check-input form-check-input-primary">
                                <span class="form-check-label">Gunakan Kupon</span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2 fw-bold">Diskon</label>
                        <div class="col-lg-5">
                            <select class="form-control select" name="coupon_id" id="coupon_id">
                                <option value=""
                                        data-quantity="" 
                                        data-discount-type=""
                                        data-discount-value=""
                                        data-valid-for=""
                                        data-wahana="">-- Pilih Kupon --</option>
                                @foreach ($coupons as $coupon)
                                    <option value="{{ $coupon->id }}" 
                                            data-quantity="{{ $coupon->balance }}" 
                                            data-discount-type="{{ $coupon->discount_type }}"
                                            data-discount-value="{{ $coupon->discount }}"
                                            data-valid-for="{{ $coupon->valid_for }}"
                                            data-wahana="{{ json_encode($coupon->wahanas) }}">{{ $coupon->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control border-primary" name="discount_type" id="discount_type" placeholder="Jenis diskon..." readonly>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control border-primary" name="discount" id="discount" placeholder="Nilai diskon yang diatur..." readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> Tagihan</h6>
                    {{-- <div class="ms-sm-auto my-sm-auto">
                        <button type="button" class="btn btn-danger btn-labeled btn-labeled-start" onclick="updateTotalTagihan()">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-calculator"></i>
                            </span>
                            Hitung Tagihan!
                        </button>
                    </div> --}}
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <label class="form-label fw-bold">Subtotal <code>Harga Paket x Quantity</code></label>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold">Diskon <code>Dihitung dari subtotal</code></label>
                        <input type="text" class="form-control" readonly name="discount_amount" placeholder="Nilai diskon akan diakumulasi otomatis" id="discount_amount">
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold">PPn <code>Dihitung dari subtotal</code></label>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="ppn" id="ppn" placeholder="Persentase PPn...." readonly>
                            </div>

                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="ppn_amount" id="ppn_amount" placeholder="Nilai PPn akan diakumulasi otomatis..." readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <span class="form-check-label fw-bold text-danger">-- TOTAL TAGIHAN --</span>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control border-primary" name="total_amount" id="total_amount" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-check">
                            <input type="checkbox" name="toggle_paylater" id="toggle_paylater" class="form-check-input form-check-input-primary">
                            <span class="form-check-label">Bayar Nanti</span>
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Pembayaran</label>
                        <select class="form-control select" data-minimum-results-for-search="Infinity" name="payment_method" id="payment_method">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="split">Split (Transfer + Cash)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <div id="split_pay"></div>
                    </div>

                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-start" id="btnSave" onclick="save()">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-floppy-disk"></i>
                            </span>
                            Simpan
                        </button> 
                        <a href="{{ route('transaksi.cash-reservasi.index') }}" class="btn ms-1 btn-warning btn-labeled btn-labeled-start">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-arrow-left"></i>
                            </span>
                            Batal
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page_js')
<script>
    sidebar_collapsed();
    let inputPpn = document.getElementById('ppn');
    let inputPpnAmount = document.getElementById('ppn_amount');
    let inputTotalAmount = document.getElementById('total_amount');
    let totalAfterPpn;
    let inputQuantity = document.getElementById('jumlah_malam');
    let inputPrice = document.getElementById('price');
    let inputPersonByUser = document.getElementById('persons');
    let inputSubtotal = document.getElementById('subtotal');
    let inputPaymentMethod = document.getElementById('payment_method');

    let inputCoupon = document.getElementById('coupon_id');
    let inputDiscountType = document.getElementById('discount_type');
    let inputDiscount = document.getElementById('discount');
    let inputDiscountAmount = document.getElementById('discount_amount');

    let discountType;
    let discount;
    let couponWahanas;

    $(document).ready(function() {
        $('.daterange-basic').daterangepicker({
            parentEl: '.content-inner',
            locale: {
                format: 'YYYY-MM-DD', // Set the date format
                cancelLabel: 'Clear',
            },
            minDate: moment(),
        });

        $('.select').each(function(){
            $(this).select2();
        });

        $('.select2-selection').addClass('border-primary');

        inputPpn.disabled = true;
        inputPpnAmount.disabled = true;

        inputCoupon.disabled = true;
        inputDiscountType.disabled = true;
        inputDiscount.disabled = true;
        inputDiscountAmount.disabled = true;

        document.getElementById('toggle_paylater').addEventListener('change', function() {
            if(this.checked){
                document.getElementById('payment_method').disabled = true;
            }else{
                document.getElementById('payment_method').disabled = false;
            }
        });

        document.getElementById('toggle_ppn').addEventListener('change', function() {
            if(this.checked) {
                inputPpn.value = '11';
                inputPpn.disabled = false;
                inputPpnAmount.disabled = false;

                if(document.getElementById('payment_method').value == 'split'){
                    $('#payment_method').val('cash').trigger('change');
                }

                applyPpn('A');
            }else{
                inputPpn.value = null;
                inputPpnAmount.value = null;

                inputPpn.disabled = true;
                inputPpnAmount.disabled = true;

                if(document.getElementById('payment_method').value == 'split'){
                    $('#payment_method').val('cash').trigger('change');
                }

                applyPpn('N');
            }
        });

        document.getElementById('toggle_coupon').addEventListener('change', function() {
            if(this.checked) {
                inputCoupon.disabled = false;
                inputDiscount.disabled = false;
                inputDiscountType.disabled = false;
                inputDiscountAmount.disabled = false;

                console.log('inputDiscountAmount 1: ', inputDiscountAmount.value);
                if(inputDiscountAmount.value != ''){
                    console.log('crot');
                    updateDiscount();
                    updateTotalTagihan();
                }
            }else{
                $('#coupon_id').val(null).trigger('change');
                inputCoupon.disabled = true;
                inputDiscount.disabled = true;
                inputDiscountType.disabled = true;
                inputDiscountAmount.disabled = true;

                inputDiscountType.value = null;
                inputDiscount.value = null;
                inputDiscountAmount.value = null;


                updateDiscount();
                updateTotalTagihan();
            }
        });

        $('#coupon_id').on('change', function() {
            let couponSelected = $(this).find('option:selected');
            let discountType = couponSelected.data('discount-type');
            let discount = couponSelected.data('discount-value');

            inputDiscountType.value = discountType;
            inputDiscount.value = discount;

            updateDiscount();
            updateTotalTagihan();
        });

        $('#room_id').on('change', function() {
            if(this.value != ''){
                checkAvailablility();
            }
        })

        function checkAvailablility(){
            if($('#room_id').val() != ''){
                $.ajax({
                    type: "POST",
                    url: "{{ route('transaksi.reservasi.check_availability') }}",
                    data: {
                        _token : "{{ csrf_token() }}",
                        daterange: $('#tanggal').val(),
                        wahana_id: $('#wahana_id').val(),
                        room_id: $('#room_id').val()
                    },
                    success: function (s) {
                        if(s.isAvailable == false){
                            swalInit.fire({
                                title: 'Jadwal Bentrok!',
                                html: s.message,
                                type: 'error',
                                icon: 'error',
                                confirmButtonClass: 'btn btn-danger',
                                allowOutsideClick: false
                            });

                            $('#room_id').val(null).trigger('change');
                        }
                    },
                });
            }
        }

        function updateDiscount(){
            inputDiscountAmount.value = null;
            let discountAmount;
            if(inputDiscountType.value === 'nominal'){
                discountAmount = inputDiscount.value;
            }else{
                discountAmount = removeThousandSeparator(inputSubtotal.value) * inputDiscount.value / 100;
            }
            
            inputDiscountAmount.value = formatCurrency(discountAmount);
        }

        $('#wahana_id').on('change', function() {
            if(inputQuantity.value === ''){
                $(this).val(null).trigger('change.select2');
                swalInit.fire({
                    title: 'Gagal!',
                    html: 'Silahkan tentukan terlebih dahulu tanggal reservasi',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                return;
            }
            var selectedOption = $(this).find('option:selected');
            var maxPersons = selectedOption.data('max-persons');
            var price = selectedOption.data('price');
            var rooms = selectedOption.data('rooms');

            document.getElementById('max_persons_display').value = 'Max. ' + maxPersons + ' Orang';
            document.getElementById('max_persons').value = maxPersons;
            inputPrice.value = formatCurrency(price);
            updateSubtotal();
            updateTotalTagihan();

            $('#room_id').empty(); // Clear existing options
            $('#room_id').append('<option value="">-- Pilih Tenda --</option>');

            // Populate the room_id select element with options
            if(this.value != ''){
                rooms.forEach(function(room) {
                    if(room.status == 'A'){
                        $('#room_id').append('<option value="' + room.id + '">' + room.name + '</option>');
                    }
                });
    
                // Trigger select2 to update
                $('#room_id').trigger('change');
            }
        });

        $('#eo_id').on('change', function() {
            var selectedEo = $(this).find('option:selected');
            var commission = selectedEo.data('commission');
            var commission_type = selectedEo.data('commission-type');

            document.getElementById('eo_commission').value = commission != null ? commission : null;
            document.getElementById('eo_commission_type').value = commission_type != null ? commission_type : null;
        });

        inputPersonByUser.addEventListener('change', function() {
            var valMaxPersons = document.getElementById('max_persons');
            if(valMaxPersons.value){
                if(this.value > valMaxPersons.value){
                    this.value = valMaxPersons.value;
                    swalInit.fire({
                        title: 'Gagal!',
                        html: 'Paket ini berisi maksimal <strong>' + valMaxPersons.value + ' orang</strong>',
                        type: 'error',
                        icon: 'error',
                        confirmButtonClass: 'btn btn-danger',
                        allowOutsideClick: false
                    });
                    return                    
                }
            }else{
                this.value = null;
                swalInit.fire({
                    title: 'Gagal!',
                    html: 'Silahkan pilih wahana terlebih dahulu.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                return
            }
        });

        $('#tanggal').on('change', function() {
            checkAvailablility();
            const dateRange = $('#tanggal').val();
            const [startDate, endDate] = dateRange.split(' - ');
            const start = new Date(startDate);
            const end = new Date(endDate);
            const oneDay = 24 * 60 * 60 * 1000; // One day in milliseconds
            const nightCount = Math.round(Math.abs((end - start) / oneDay));


            document.getElementById('jumlah_malam_display').value = nightCount + ' malam';
            inputQuantity.value = nightCount;
            updateSubtotal();
            updateTotalTagihan();
        });

        $('#payment_method').on('change', function() {
            let split_pay_div = document.getElementById('split_pay');
            if(this.value == 'split'){
                split_pay_div.innerHTML = '<div class="row mb-3"><div class="col-lg-10 offset-1">\
                                              <div class="row mb-1">\
                                                  <label class="col-form-label col-lg-3 fw-bold fst-italic">- Cash</label>\
                                                  <div class="col-lg-8">\
                                                      <input type="text" class="form-control border-primary" name="pay[cash]" id="pay_cash" placeholder="Pembayaran Cash...">\
                                                  </div>\
                                              </div>\
                                              <div class="row mb-1">\
                                                  <label class="col-form-label col-lg-3 fw-bold fst-italic">- Transfer</label>\
                                                  <div class="col-lg-8">\
                                                      <input type="text" class="form-control border-primary" name="pay[transfer]" id="pay_transfer" placeholder="Pembayaran via Transfer..." readonly>\
                                                  </div>\
                                              </div>\
                                          </div></div>';

                // Set focus after a short delay
                setTimeout(function() {
                    document.getElementById('pay_cash').focus();
                }, 100);

                document.getElementById('pay_cash').addEventListener('change', function() {
                    if(inputTotalAmount.value){
                        let pay_cash = this.value;
                        let pay_transfer = removeThousandSeparator(inputTotalAmount.value) - this.value;
                        document.getElementById('pay_transfer').value = formatCurrency(pay_transfer);
                        document.getElementById('pay_cash').value = formatCurrency(pay_cash);
                    }else{
                        swalInit.fire({
                            title: 'Gagal!',
                            html: 'Tidak ada yang bisa dihitung.',
                            type: 'error',
                            icon: 'error',
                            confirmButtonClass: 'btn btn-danger',
                            allowOutsideClick: false
                        });
                        return;
                    }
                });
            }else{
                split_pay_div.innerHTML = '';
            }
        });

        @if ($withParams === true)
            var daterangepickerElement = $('#tanggal');
            daterangepickerElement.val("{{ date('Y-m-d', strtotime($date_from)) }} - {{ date('Y-m-d', strtotime($date_from. ' +1 day')) }}");
            inputQuantity.value = 1;
            $('#jumlah_malam_display').val('1 malam');
            daterangepickerElement.trigger('apply.daterangepicker');

            $('#wahana_id').val({{ $wahana_id }});
            $('#wahana_id').trigger('change');
            $('#room_id').val({{ $room_id }});
            $('#room_id').trigger('change');
        @endif
    });

    function updateSubtotal(){
        inputSubtotal.value = formatCurrency(inputQuantity.value * removeThousandSeparator(inputPrice.value));
    }

    function updateTotalTagihan(){
        let calc_subtotal = parseInt(removeThousandSeparator(inputSubtotal.value));
        let calc_discount = inputDiscountAmount.value != '' ? parseInt(removeThousandSeparator(inputDiscountAmount.value)) : 0;
        let calc_ppn = inputPpnAmount.value != '' ? parseInt(removeThousandSeparator(inputPpnAmount.value)) : 0;
        let totalBill = 0;
        
        totalBill = (calc_subtotal - calc_discount) + calc_ppn;
        inputTotalAmount.value = formatCurrency(totalBill);
    }
    
    function applyPpn(param){
        if(param === 'A'){
            inputPpnAmount.value = formatCurrency( parseFloat( (removeThousandSeparator(inputSubtotal.value) * inputPpn.value) / 100 ) );    
        }else{
            inputPpnAmount.value = null;
        }

        updateTotalTagihan();
    }

    function formatCurrency(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).formatToParts(number)
                        .map(part => part.type === 'currency' ? '' : part.value)
                        .join('');
    }

    function removeThousandSeparator(inputString) {
        return inputString.replace(/\./g, '');
    }

    function save(){
        let btnSave = document.getElementById('btnSave');
        $.ajax({
            type: "POST",
            url: "{{ route('transaksi.cash-reservasi.store') }}",
            data: $('#form_data').serialize(),
            beforeSend: function(){
                // small_loader_open('form_data');
                btnSave.disabled = true;
            },
            success: function (s) {
                // console.log(s);
                // sw_success_redirect(s, "{{ route('transaksi.cash-inventory.index') }}");
                sw_success(s);
                openReceipt(s.trans_id);

                @if ($withParams === true)
                    sw_success_redirect(s, "{{ route('transaksi.cash-reservasi.create') }}");
                @endif

                document.getElementById('toggle_coupon').checked = false;
                document.getElementById('toggle_ppn').checked = false;
                var event = new Event('change');
                document.getElementById('toggle_coupon').dispatchEvent(event);
                document.getElementById('toggle_ppn').dispatchEvent(event);
                $('#coupon_id').val(null).trigger('change');
                $('#eo_id').val(null).trigger('change');
                
                document.getElementById('form_data').reset();
                $('#payment_method').val('cash').trigger('change');
                $('#split_pay').html('');
                $('#room_id').empty();
                $('#room_id').append('<option value="">-- Tenda --</option>');
                
                $('#wahana_id').empty();
                $('#wahana_id').append('<option value="">-- Pilih Wahana --</option>');

            },
            error: function(e){
                sw_multi_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                // small_loader_close('form_data');
                btnSave.disabled = false;
            }
        });
    }

    function openReceipt(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 7;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('transaksi.reservasi.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }
</script>
@endsection