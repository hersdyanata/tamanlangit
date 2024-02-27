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
                    <a href="{{ route('inventory.purchasing.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                </div>
            </div>
        </div>

        <div class="card-body" id="divToPrint">
            <table class="table datatable-basic table-bordered table-xs mb-2">
                <tr>
                    <td colspan="2" class="text-center">
                        <h3 class="mb-0 fw-medium">
                            Bukti Pembelian<br>
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td width="50%">Nomor. Transaksi</td>
                    <td>{{ $purchase->trans_num }}</td>
                </tr>
                <tr>
                    <td width="50%">Tanggal Transaksi</td>
                    <td>{{ date('d.m.Y H:i', strtotime($purchase->trans_date)) }}</td>
                </tr>
                <tr>
                    <td width="50%">Supplier</td>
                    <td>{{ $purchase->supplier->name }}</td>
                </tr>
                <tr>
                    <td width="50%">PPn</td>
                    <td>{{ ($purchase->ppn != null) ? $purchase->ppn.'%'.' / '.number_format($purchase->ppn_amount, 0) : '<code>Tidak ada PPn</code>' }}</td>
                </tr>
                <tr>
                    <td width="50%">Total Tagihan</td>
                    <td>{{ number_format($purchase->total_amount,0) }}</td>
                </tr>
                <tr>
                    <td width="50%">Masuk Stock?</td>
                    <td>{!! ($purchase->non_stock == 'stock') ? '<span class="badge bg-success text-success bg-opacity-20">Masuk Stock</span>' : '<span class="badge bg-warning text-warning bg-opacity-20">Tidak Masuk Stock</span>' !!}</td>
                </tr>
                <tr>
                    <td width="50%">Dibuat Oleh</td>
                    <td>{{ $purchase->creator->name }}</td>
                </tr>
            </table>

            <div class="d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto">Produk yang dibeli</h6>
            </div>

            <table class="table table-bordered table-xs">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>Kode</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-end">Quantity</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                        $total = 0;
                    @endphp
                    @foreach ($purchase->items as $r)
                        @php
                            $no++;
                            $total += $r->subtotal;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no }}</td>
                            <td>{{ $r->product->code }}</td>
                            <td>{{ $r->product->name }}</td>
                            <td>{{ $r->product->category->name }}</td>
                            <td class="text-end">{{ $r->quantity }}</td>
                            <td class="text-end">{{ number_format($r->price) }}</td>
                            <td class="text-end">{{ number_format($r->subtotal) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-end"><strong>T O T A L</strong></td>
                        <td class="text-end">{{ number_format($total) }}</td>
                    </tr>
                </tbody>
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
</script>
@endsection