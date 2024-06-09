@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
            <div class="ms-sm-auto my-sm-auto">
                <div class="ms-sm-auto my-sm-auto">
                    <a href="{{ route('transaksi.cash-reservasi.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-arrow-left"></i>
                        </span>
                        Kembali
                    </a>
                    <button type="button" class="btn btn-primary btn-labeled btn-labeled-start" onclick="printDiv()">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-printer"></i>
                        </span>
                        Cetak
                    </button>
                    <button type="button" class="btn btn-danger btn-labeled btn-labeled-start" onclick="cancel()" {{ $data->reservation_status == 'cancel' ? 'disabled' : '' }}>
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-prohibit-inset"></i>
                        </span>
                        Batalkan
                    </button>
                    @can('kasir-reservasi-delete')
                        <button type="button" class="btn btn-danger btn-labeled btn-labeled-start" onclick="hapus()">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-trash"></i>
                            </span>
                            Hapus
                        </button>
                    @endcan
                    @if ($data->payment_status === 'pending' && $data->trans_via === 'onsite')
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-start" data-bs-toggle="modal" data-bs-target="#payment">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-money"></i>
                            </span>
                            Pembayaran
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body" id="divToPrint">
            <table class="table datatable-basic table-xs">
                <tr>
                    <td colspan="2">
                        <h3 class="mb-0 fw-medium">
                            Bukti Reservasi<br>
                        </h3>
                    </td>
                </tr>
                <tr><td class="fw-bold" width="30%">Nomor. Transaksi</td><td>#{{ $data->trans_num }}</td></tr>
                <tr><td class="fw-bold" width="30%">Tanggal Reservasi</td><td>{{ date('d.m.Y H:i', strtotime($data->created_at)) }}</td></tr>
                <tr><td class="fw-bold" width="30%">Melalui</td><td>{{ ucfirst($data->trans_via) }}</td></tr>
                <tr><td class="fw-bold" width="30%">
                    Reservasi Untuk</td><td>{{ date('d.m.Y', strtotime($data->start_date)) }} - {{ date('d.m.Y', strtotime($data->end_date)) }}
                </td></tr>
                <tr><td class="fw-bold" width="30%">Check-In</td><td>{{ $data->checkin_date != null ? date('d.m.Y H:i:s', strtotime($data->checkin_date)) : '-' }}</td></tr>
                <tr><td class="fw-bold" width="30%">Check-Out</td><td>{{ $data->checkout_date != null ? date('d.m.Y H:i:s', strtotime($data->checkout_date)) : '-' }}</td></tr>
                <tr><td class="fw-bold" width="30%">Pemesan</td><td>{{ $data->name }}</td></tr>
                <tr><td class="fw-bold" width="30%">No. Hanphone</td><td>{{ $data->wa_number }}</td></tr>
                <tr><td class="fw-bold" width="30%">Alamat Email</td><td>{{ $data->email }}</td></tr>
                <tr><td class="fw-bold" width="30%">Wahana</td><td>{{ ucwords(strtolower($data->wahana->name)) }} / Tenda {{ $data->room->name }} / Peserta: {{ $data->persons }} Orang</td></tr>
                <tr><td class="fw-bold" width="30%">Harga</td><td>IDR {{ number_format($data->price) }}</td></tr>
                <tr><td class="fw-bold" width="30%">Durasi</td><td>{{ $data->night_count }} Malam</td></tr>
                <tr><td class="fw-bold" width="30%">Subtotal</td><td>IDR {{ number_format($data->subtotal) }}</td></tr>
                <tr>
                    <td class="fw-bold" width="30%">Kupon</td>
                    <td>{{ ($data->coupon_id != null) ? $data->coupon->code : '-' }}</td>
                </tr>
                <tr>
                    <td class="fw-bold" width="30%">Diskon</td>
                    <td>
                        @if ($data->discount_amount != null)
                            @if ($data->discount_type == 'persentase')
                                {{ $data->discount }}% / -{{ number_format($data->discount_amount) }}
                            @else
                                {{ number_format($data->discount_amount) }}
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold" width="30%">PPn</td>
                    <td>
                        @if ($data->ppn != null)
                            {{ $data->ppn }}% / +{{ number_format($data->ppn_amount) }}
                        @else
                            {{ number_format($data->discount_amount) }}
                        @endif
                    </td>
                </tr>
                <tr><td class="fw-bold" width="30%">Total Tagihan</td><td>IDR {{ number_format($data->total_amount) }}</td></tr>
                <tr>
                    <td class="fw-bold" width="30%">Layanan Tambahan</td>
                    <td>
                        {{ ($data->extra_bill !== null) ? 'IDR '.number_format($data->extra_bill) : '-' }}<br>
                        @if ($data->extra_bill !== null)
                            <ul class="list mb-0" id="facilities">
                                @foreach ($data->extras as $ex)
                                    @if ($ex->type == 'person')
                                        <li class="fw-semibold">
                                            +Anggota
                                            [{{ $ex->quantity. ' x '. number_format($ex->price) }} = {{ number_format($ex->subtotal) }}]
                                        </li>
                                    @else
                                        <li class="fw-semibold">
                                            {{ ($ex->stock->product->inventory_type == 'loan') ? 'Sewa ' : 'Beli ' }}
                                            {{ $ex->stock->product->name }}
                                            [{{ $ex->quantity. ' x '. number_format($ex->price) }} = {{ number_format($ex->subtotal) }}]
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold" width="30%">Metode Pembayaran</td>
                    <td>
                        @if ($data->payments->count() > 1)
                            @foreach ($data->payments as $key => $pay)
                                {{ $pay->method }}: IDR {{ number_format($pay->amount) }}
                                @if (!$loop->last)
                                    / 
                                @endif
                            @endforeach
                        @else
                            @foreach ($data->payments as $key => $pay)
                                {{ $pay->method }}
                            @endforeach
                        @endif

                    </td>
                </tr>
                <tr><td class="fw-bold" width="30%">Status Reservasi</td><td>{{ $data->reservation_status }} {{ $data->reservation_status == 'cancel' ? ' / Alasan: '.$data->cancel_reason : '' }}</td></tr>
                <tr><td class="fw-bold" width="30%">Status Pembayaran</td><td>{{ $data->payment_status }}</td></tr>
                <tr><td class="fw-bold" width="30%">Status Pembayaran</td><td>{{ $data->payment_status }}</td></tr>
                <tr>
                    <td class="fw-bold" width="30%">Event Organizer</td>
                    <td>
                        @if ($data->eo_id == null)
                            -
                        @else
                            {{ $data->eo->name }} / Komisi: {{ $data->eo_commission }}% ({{ number_format($data->total_amount * $data->eo_commission / 100) }})
                        @endif
                    </td>
                </tr>

                @if ($data->refund != null)
                    <tr><td class="fw-bold" width="30%">Refund</td><td>{{ number_format($data->refund) }}</td></tr>
                    <tr><td class="fw-bold" width="30%">Refund Status</td><td>{{ ($data->refund_status == null) ? 'Belum Dibayar' : 'Selesai' }}</td></tr>
                    <tr><td class="fw-bold" width="30%">Tgl. Refund</td><td>{{ ($data->refund_date == null) ? '-' : date('d.m.Y H:i:s', strtotime($data->refund_date)) }}</td></tr>
                @endif
            </table>
        </div>
    </div>

    @php
        $currentDate = new DateTime(date('Y-m-d'));
        $reservedDate = new DateTime($data->start_date);

        $interval = $currentDate->diff($reservedDate);
        $daysDifference = $interval->days;

        $refund = 0;
        $refundInfo = '';
        if ($data->payment_status === 'paid') {
            if ($currentDate < $reservedDate) {
                if ($daysDifference >= 3) {
                    $rule = $cancelRules->where('parameter', 'more_than_3')->first();
                    $refund = $data->total_amount * ($rule->value / 100);
                    $refundInfo = 'Pembatalan ini dilakukan lebih dari H-3, refund kepada customer adalah sebesar 70% dari IDR ' . number_format($data->total_amount) . '. Yaitu IDR ' . number_format($refund);
                } else {
                    $rule = $cancelRules->where('parameter', 'less_than_3')->first();
                    $refund = 0;
                    $refundInfo = 'Pembatalan ini dilakukan kurang dari H-3, sehingga tidak ada refund kepada customer.';
                }
            } else {
                $refundInfo = 'Tanggal reservasi sudah lewat, tidak ada refund kepada customer.';
            }
        }
    @endphp
    <input type="hidden" name="refund" id="refund" value = "{{ $refund }}" readonly>
    <input type="hidden" name="refundInfo" id="refundInfo" value = "{{ $refundInfo }}" readonly>
    <input type="hidden" name="omzet" id="omzet" value = "{{ $data->total_amount - $refund }}" readonly>


    <div id="payment" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="paymentForm" method="POST" action="{{ route('transaksi.reservasi.pay_onsite', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-success text-white border-0">
                        <h5 class="modal-title">Total Tagihan: IDR {{ number_format($data->total_amount) }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}" readonly>
                        <input type="hidden" name="total_amount" id="total_amount" value="{{ $data->total_amount }}" readonly>
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
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
<script>
    $('.select').each(function(){
        $(this).select2();
    });

    $('.select2-selection').addClass('border-success');

    $('#payment_method').on('change', function() {
        let split_pay_div = document.getElementById('split_pay');
        let inputTotalAmount = document.getElementById('total_amount');
        if(this.value == 'split'){
            split_pay_div.innerHTML = '<div class="row mb-3"><div class="col-lg-10 offset-1">\
                                            <div class="row mb-1">\
                                                <label class="col-form-label col-lg-3 fw-bold fst-italic">- Cash</label>\
                                                <div class="col-lg-8">\
                                                    <input type="text" class="form-control border-success" name="pay[cash]" id="pay_cash" placeholder="Pembayaran Cash...">\
                                                </div>\
                                            </div>\
                                            <div class="row mb-1">\
                                                <label class="col-form-label col-lg-3 fw-bold fst-italic">- Transfer</label>\
                                                <div class="col-lg-8">\
                                                    <input type="text" class="form-control border-success" name="pay[transfer]" id="pay_transfer" placeholder="Pembayaran via Transfer..." readonly>\
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
                    let pay_transfer = inputTotalAmount.value - this.value;
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

    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var paymentMethod = document.getElementById('payment_method').value;

        if (paymentMethod === 'split') {
            var splitAmountCash = parseInt(removeDotSeparator(document.getElementById('pay_cash').value) || 0);
            var splitAmountTransfer = parseInt(removeDotSeparator(document.getElementById('pay_transfer').value) || 0);
            var totalAmount = parseInt(document.getElementById('total_amount').value);

            if ((splitAmountCash + splitAmountTransfer) !== totalAmount) {
                swalInit.fire({
                    title: 'Gagal',
                    html: 'Total pembayaran split harus sama dengan total tagihan.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-success',
                    allowOutsideClick: false
                });
                return;
            }
        }
        event.target.submit();
    });

    function cancel(){
        let refundAmount = $('#refund').val();
        let refundInfo = $('#refundInfo').val();
        let newOmzet = $('#omzet').val();
        swalInit.fire({
                title: 'Konfirmasi',
                html: 'Apakah Anda yakin akan membatalkan data reservasi ini? '+refundInfo,
                type: 'warning',
                icon: 'warning',
                input: 'text',
                inputPlaceholder: 'Beri alasan...',
                showCancelButton: true,
                confirmButtonText: 'Iya, tolong batalkan!',
                cancelButtonText: 'Tidak, biarkan saja!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                allowOutsideClick: false,
                inputValidator: function(value) {
                    return !value && 'Silahkan diisi!'
                }
        }).then(function(result) {
            if(result.value) {

                $.ajax({
                    url: "{{ route('transaksi.cash-reservasi.update', $data->id) }}",
                    type: "PUT",
                    data: {
                        _token : "{{ csrf_token() }}",
                        id: {{ $data->id }},
                        _to: 'cancel',
                        _reason: result.value,
                        _refund: refundAmount,
                        _omzet: newOmzet,
                    },
                    beforeSend: function(){
                        // small_loader_open(selector);
                    },
                    success: function(d){
                        swalInit.fire({
                            title: d.msg_title,
                            html: d.msg_body,
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    complete: function(){
                        // small_loader_close(selector);
                    }
                });

            }else if(result.dismiss === swalInit.DismissReason.cancel) {
                swalInit.fire({
                    title: 'Tidak Jadi',
                    html: 'Data reservasi ini aman 😉',
                    type: 'success',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    allowOutsideClick: false
                });
            }
        });
    }
    
    function hapus(){
        swalInit.fire({
                title: 'Konfirmasi',
                html: 'Apakah Anda yakin akan menghapus data reservasi ini? ',
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, tolong hapus!',
                cancelButtonText: 'Tidak, biarkan saja!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                allowOutsideClick: false,
        }).then(function(result) {
            if(result.value) {

                $.ajax({
                    url: "{{ route('transaksi.cash-reservasi.destroy', $data->id) }}",
                    type: "DELETE",
                    data: {
                        _token : "{{ csrf_token() }}",
                        id: {{ $data->id }},
                    },
                    beforeSend: function(){
                        // small_loader_open(selector);
                    },
                    success: function(d){
                        swalInit.fire({
                            title: d.msg_title,
                            html: d.msg_body,
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                        });
                    },
                    complete: function(){
                        // setTimeout(function() {
                            window.location = "{{ route('transaksi.cash-reservasi.index') }}";
                        // }, 3000);
                    }
                });

            }else if(result.dismiss === swalInit.DismissReason.cancel) {
                swalInit.fire({
                    title: 'Tidak Jadi',
                    html: 'Data reservasi ini aman 😉',
                    type: 'success',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    allowOutsideClick: false
                });
            }
        });
    }

    function printDiv() {
        // Create a new window/tab
        var newWindow = window.open('', '_blank');

        // Get the content of the div you want to print
        var content = $('#divToPrint').html();

        // Set the content of the new window/tab to the div content
        newWindow.document.write('<html><head><title>Print</title>');
        
        // Create a link element for the CSS and set onload event
        var cssLink = newWindow.document.createElement('link');
        cssLink.href = "{{ asset('assets/css/ltr/all.min.css') }}"; // Replace with the actual path to your CSS file
        cssLink.rel = 'stylesheet';
        cssLink.type = 'text/css';
        cssLink.onload = function () {
            // CSS has been loaded, now add the content and print
            newWindow.document.write('<body>' + content + '</body></html>');
            
            // Set the paper size to A4
            newWindow.document.head.innerHTML += '<style>@page { size: A4; }</style>';
            
            // Print the content
            newWindow.print();
            
            // Close the new window/tab after printing
            newWindow.onafterprint = function () {
                newWindow.close();
            };
        };

        // Append the link element to the head
        newWindow.document.head.appendChild(cssLink);
    }
</script>
@endsection