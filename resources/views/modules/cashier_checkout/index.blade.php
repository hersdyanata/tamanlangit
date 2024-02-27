@extends('layouts.app')
@section('page_resources')
    {{-- <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
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
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-calendar-check"></i> {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <span class="text-info fw-semibold">Tanggal: {{ date('d.m.Y') }}</span>
                    </div>
                </div>
            
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="tiket" id="tiket" placeholder="Masukkan Nomor Tiket. Contoh: 2402QSY0 lalu tekan enter..." autofocus autocomplete="off"> 
                        </div>

                        <div class="col-lg-2">
                            <button type="button" class="btn btn-success btn-labeled btn-labeled-start" id="btn_cfm" onclick="confirm()" disabled>
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-check"></i>
                                </span>
                                Konfirmasi
                            </button>
                        </div>
                    </div>

                    <div class="row mb-2" id="loader">
                        <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                    </div>

                    <input type="hidden" name="id" id="id" readonly>

                    <table class="table datatable-basic table-bordered table-xs">
                        <tr>
                            <td class="fw-bold" colspan="3" width="30%"><span class="fw-bold text-danger">DATA RESERVASI</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Nomor Tiket</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="trans_num"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Reservasi Via</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="trans_via"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Tanggal Reservasi</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Nama Pemesan</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Kontak</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="contact"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Reservasi Untuk Tanggal</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="period"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Check-In Tanggal</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="checkin_date"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Durasi</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="duration"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Wahana</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="wahana"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Jumlah Peserta</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="persons"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Status Pembayaran</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="payment_status"></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-airplay"></i> Fasilitas</h6>
                </div>

                <div class="card-body">
                    <div class="border rounded p-3">
                        <ul class="list mb-0" id="facilities">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page_js')
<script>
    $('#loader').hide();
    let inputTicket = document.getElementById('tiket');
    let btnConfirm = document.getElementById('btn_cfm');

    let dataId = document.getElementById('id');
    let transNum = document.getElementById('trans_num');
    let transVia = document.getElementById('trans_via');
    let transDate = document.getElementById('created_at');
    let checkInDate = document.getElementById('checkin_date');
    let name = document.getElementById('name');
    let contact = document.getElementById('contact');
    let period = document.getElementById('period');
    let duration = document.getElementById('duration');
    let wahana = document.getElementById('wahana');
    let persons = document.getElementById('persons');
    let paymentStatus = document.getElementById('payment_status');
    let divFacilities = document.getElementById('facilities');

    inputTicket.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (this.value !== '') {
                getData(this.value);
            }
        }
    });

    $(function() {
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });

    function getData(ticketNumber){
        $.ajax({
            type: "GET",
            url: "{{ route('transaksi.cash-checkout.show', ':id') }}".replace(':id', ticketNumber),
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                sw_success(s);
                divFacilities.innerHTML = null;
                if(s.isFound == true){
                    dataId.value = s.data.id;
                    transNum.textContent = '#' + s.data.trans_num;
                    transVia.textContent = ucwords(s.data.trans_via);
                    transDate.textContent = moment(s.data.created_at).format('DD.MM.YYYY H:m');
                    checkInDate.textContent = moment(s.data.checkin_date).format('DD.MM.YYYY H:m');
                    name.textContent = ucwords(s.data.name);
                    contact.textContent = 'WA: ' + s.data.wa_number + ' / Email: ' + s.data.email;
                    period.textContent = moment(s.data.start_date).format('DD.MM.YYYY') + ' sd. ' + moment(s.data.end_date).format('DD.MM.YYYY');
                    duration.textContent = s.data.night_count + ' malam';
                    wahana.textContent = ucwords(s.data.wahana.name) + ' / Tenda: ' + s.data.room.name;
                    persons.textContent = s.data.persons + ' orang';
                    paymentStatus.textContent = ucwords(s.data.payment_status);
    
                    const facilities = s.data.wahana.facilities;
                    for(const obj of facilities){
                        divFacilities.innerHTML += '<li class="text-success fw-semibold">'+ ucwords(obj.name) +'</li>';
                    }

                    btnConfirm.disabled = false;
                    btnConfirm.focus();
                }else{
                    sw_error(s);
                }
                
            },
            complete: function(){
                $('#loader').hide();
                inputTicket.value = null;
            }
        });
    }

    function ucwords(str) {
        return str.toLowerCase().replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });
    }

    function confirm(){
        $.ajax({
            type: "PUT",
            url: "{{ route('transaksi.cash-checkout.update', ':id') }}".replace(':id', dataId.value),
            data: {
                _token: "{{ csrf_token() }}",
                ticket: dataId.value
            },
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                sw_success(s);
            },
            error: function(e){
                sw_single_error(e);
            },
            complete: function(){
                $('#loader').hide();
                dataId.value = null;
                transNum.textContent = null;
                transVia.textContent = null;
                transDate.textContent = null;
                checkInDate.textContent = null;
                name.textContent = null;
                contact.textContent = null;
                period.textContent = null;
                duration.textContent = null;
                wahana.textContent = null;
                persons.textContent = null;
                paymentStatus.textContent = null;
                divFacilities.innerHTML = null;
                btnConfirm.disabled = true;
                inputTicket.focus();
            }
        });
    }
</script>
@endsection