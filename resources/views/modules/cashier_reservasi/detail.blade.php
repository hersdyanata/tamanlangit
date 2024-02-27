@extends('layouts.app')
@section('page_resources')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                    <button type="button" class="btn btn-danger btn-labeled btn-labeled-start" onclick="cancel()" {{ $data->cancel_flag == 'Y' ? 'disabled' : '' }}>
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-prohibit-inset"></i>
                        </span>
                        Batalkan
                    </button>
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
                <tr><td class="fw-bold" width="30%">Harga</td><td>{{ number_format($data->price) }}</td></tr>
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
                <tr><td class="fw-bold" width="30%">Status</td><td class="text-{{ ($data->cancel_flag != null) ? 'danger' : '' }}">{{ $data->payment_status }} {{ $data->cancel_flag == 'Y' ? ' / Alasan: '.$data->cancel_reason : '' }}</td></tr>
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
            </table>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    function printDiv() {
        // Create a new window/tab
        var newWindow = window.open('', '_blank');

        // Get the content of the div you want to print
        var content = $('#divToPrint').html();

        // Set the content of the new window/tab to the div content
        newWindow.document.write('<html><head><title>Print</title>');
        
        // Create a link element for the CSS and set onload event
        var cssLink = newWindow.document.createElement('link');
        cssLink.href = '{{ asset('assets/css/ltr/all.min.css') }}'; // Replace with the actual path to your CSS file
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

    function cancel(){
        swalInit.fire({
                title: 'Konfirmasi',
                html: 'Apakah Anda yakin akan membatalkan data reservasi ini? Jika ya, silahkan berikan alasan',
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
</script>
@endsection