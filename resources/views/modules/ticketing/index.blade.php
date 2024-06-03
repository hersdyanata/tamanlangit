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
                    <div class="text-center mt-2">
                        @can('tiket-create')
                            <a href="{{ route('tiket.data.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-note-pencil"></i>
                                </span>
                                Buat Tiket Pre-Sale Baru
                            </a> 
                        @endcan
                    </div>

                    <table class="table datatable-basic table-xs table-hover" id="tableTicketPresale">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Quantity (Nomor Seri)</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                
                <div class="tab-pane p-1" id="directsale" role="tabpanel">
                    <div class="text-center mt-2">
                        @can('tiket-create')
                            <a href="{{ route('tiket.data.create_direct') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-note-pencil"></i>
                                </span>
                                Buat Direct Tiket Baru
                            </a> 
                        @endcan
                    </div>

                    <table class="table datatable-basic table-xs table-hover" id="tableTicketDirect">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kategori</th>
                                <th>Harga</th>
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
    var tableTicketPresale;
    var tableTicketDirect;

    $(document).ready(function() {
        buildTablePresale();
    });

    function buildTablePresale(){
        if ( ! $.fn.DataTable.isDataTable('#tableTicketPresale') ) {
            tableTicketPresale = $('#tableTicketPresale').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('tiket.data.index') }}",
                    data: {
                        'category': 'presale',
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                    { data: 'a_code', orderable: true, searchable: true, sortable: true },
                    { data: 'description', orderable: true, searchable: true, sortable: true },
                    { data: 'category.name', orderable: true, searchable: true, sortable: true },
                    {
                        data: 'quantity',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
                    },
                    {
                        data: 'status',
                        class: 'text-center',
                        searchable: false,
                        render: function(data, type, row) {
                            let bgStatus = 'success';
                            if(data === 'selesai'){
                                bgStatus = 'danger';
                            }
                            return '<div class="badge bg-'+ bgStatus +' bg-success bg-opacity-75">'+ data +'</div>';
                        }
                    },
                    {
                        data: 'price',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
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
                tableTicketPresale.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            tableTicketPresale.draw();
        });
    }

    function buildTableDirect(){
        if ( ! $.fn.DataTable.isDataTable('#tableTicketDirect') ) {
            tableTicketDirect = $('#tableTicketDirect').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('tiket.data.index') }}",
                    data: {
                        'category': 'direct',
                    }
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                    { data: 'category_.name', orderable: true, searchable: true, sortable: true },
                    {
                        data: 'price',
                        class: 'text-end',
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        }
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
                tableTicketDirect.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            tableTicketDirect.draw();
        });
    }

    function preaction_presale(i){
        sw_delete_validated(
            "{{ route('tiket.data.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.data.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableTicketPresale",
            tableTicketPresale
        );
    }

    function preaction_direct(i){
        sw_delete_validated(
            "{{ route('tiket.data.show_direct', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.data.destroy_direct', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableTicketDirect",
            tableTicketDirect
        );
    }

    function updateTicket(par){
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.data.store_direct') }}",
            data: {
                _token: "{{ csrf_token() }}",
                category: (par === 'parkir') ? $('#category_1').val() : $('#category_2').val(),
                price: (par === 'parkir') ? $('#price_1').val() : $('#price_2').val(),
            },
            // beforeSend: function(){
            //     $('.loader').show();
            //     $('#saveButton').prop('disabled', true);
            // },
            success: function (s) {
                sw_success(s);
                // setTimeout(function() {
                //     window.location.href = "{{ route('tiket.data.index') }}";
                // }, 3000);
            },
            error: function(e){
                sw_multi_error(e);
            },
            // complete: function(){
            //     $('.loader').hide();
            //     // $('#saveButton').prop('disabled', false);
            // }
        });
    }
</script>
@endsection