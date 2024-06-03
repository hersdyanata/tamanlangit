@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
            <div class="ms-sm-auto my-sm-auto">
                @can('tiket-sales-create')
                    <a href="{{ route('tiket.sales.presale.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-note-pencil"></i>
                        </span>
                        Penjualan Tiket Presale
                    </a> 
                    <a href="{{ route('tiket.sales.direct.create') }}" class="btn btn-indigo btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-squares-four"></i>
                        </span>
                        Penjualan Tiket Langsung
                    </a> 
                @endcan
            </div>
        </div>

        <div class="card-body">
            <div class="text-center">
                <ul class="nav nav-pills d-inline-flex border rounded-pill p-1 mb-2">
                    <li class="nav-item" role="presentation">
                        <a href="#presale" data-bs-toggle="tab" onclick="buildTablePresale()" aria-expanded="false" class="nav-link rounded-pill active" aria-selected="false" role="tab" tabindex="-1">
                            <span class="d-none d-md-block">Tiket Pre-Sale</span>
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a href="#directsale" data-bs-toggle="tab" onclick="buildTableDirect()" aria-expanded="true" class="nav-link rounded-pill" aria-selected="false" role="tab" tabindex="-1">
                            <span class="d-none d-md-block">Tiket Direct Sale</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane p-1 active show" id="presale" role="tabpanel">
                    <table class="table datatable-basic table-xs table-hover" id="tableTicketPresale">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kode Presale / Nomor Seri</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                
                <div class="tab-pane p-1" id="directsale" role="tabpanel">
                    <table class="table datatable-basic table-xs table-hover" id="tableTicketDirect">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Nomor Tiket</th>
                                <th>Kategori</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Tanggal</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    var tablePresale;
    var tableDirect;
    $(document).ready(function() {
        buildTablePresale();
    });

    function buildTablePresale(){
        if ( ! $.fn.DataTable.isDataTable('#tableTicketPresale') ) {
            tablePresale = $('#tableTicketPresale').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('tiket.sales.presale.index') }}",
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                    { data: 'batch_code_sn', orderable: true, searchable: true, sortable: true },
                    { data: 'category.name', orderable: true, searchable: true, sortable: true },
                    {
                        data: 'price',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
                    },
                    {
                        data: 'sold_date',
                        class: 'text-center',
                        searchable: false,
                        sortable: false,
                        orderable: false,
                        render: function(data, type, row){
                            return moment(data).format('DD.MM.YYYY H:m:s');
                        },
                    },
                    { data: 'actions', className: 'text-center', name: 'actions', orderable: false, searchable: false, sortable: false },
                ],
                order: [[0, 'asc']],
                drawCallback: function (setting) {
                    $('.tooltiped').tooltip({
                        "html": true,
                        trigger: 'hover',
                        placement: 'top',
                    });
                },
            });
        }

        $('.dataTables_filter input').unbind();
        $('.dataTables_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                tablePresale.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            tablePresale.draw();
        });
    }

    function buildTableDirect(){
        if ( ! $.fn.DataTable.isDataTable('#tableTicketDirect') ) {
            tableDirect = $('#tableTicketDirect').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('tiket.sales.direct.index') }}",
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                    { data: 'parent.trans_num', class: 'text-center', orderable: true, searchable: true, sortable: true },
                    { data: 'ticket.category_.name', orderable: true, searchable: true, sortable: true },
                    { data: 'quantity', class: 'text-center', orderable: true, searchable: true, sortable: true },
                    {
                        data: 'price',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
                    },
                    {
                        data: 'subtotal',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
                    },
                    {
                        data: 'trans_date',
                        class: 'text-center',
                        searchable: false,
                        sortable: false,
                        orderable: false,
                        render: function(data, type, row){
                            return moment(data).format('DD.MM.YYYY H:m:s');
                        },
                    },
                    { data: 'actions', className: 'text-center', name: 'actions', orderable: false, searchable: false, sortable: false },
                ],
                order: [[0, 'asc']],
                drawCallback: function (setting) {
                    $('.tooltiped').tooltip({
                        "html": true,
                        trigger: 'hover',
                        placement: 'top',
                    });
                },
            });
        }

        $('.dataTables_filter input').unbind();
        $('.dataTables_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                tableDirect.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            tableDirect.draw();
        });
    }

    function preaction_presale(i){
        sw_delete_validated(
            "{{ route('tiket.sales.presale.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.sales.presale.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tablePresale",
            tablePresale
        );
    }

    function preaction_direct(i){
        sw_delete_validated(
            "{{ route('tiket.sales.direct.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.sales.direct.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableDirect",
            tableDirect
        );
    }

    function receipt_presale(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 2.7;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('tiket.sales.presale.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }

    function receipt_direct(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 4;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('tiket.sales.direct.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }
</script>
@endsection