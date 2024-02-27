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
                @can('cms-blog-kategori-create')
                    <a href="{{ route('transaksi.cash-inventory.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-note-pencil"></i>
                        </span>
                        Buat Baru
                    </a> 
                @endcan

                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start" onclick="reload_table(tableData)">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-arrows-counter-clockwise"></i>
                    </span>
                    Reload
                </button>
            </div>
        </div>

        <div class="card-body">
            <table class="table datatable-basic table-xs table-hover" id="tableData">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>No. Transaksi</th>
                        <th>Tanggal</th>
                        <th>Amount</th>
                        <th>PPn</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    var tableData;
    $(document).ready(function() {
        tableData = $('.datatable-basic').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Ketik untuk mencari...',
                lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('transaksi.cash-inventory.index') }}",
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                {
                    data: 'trans_num',
                    name: 'trans_num',
                    searchable: true,
                    render: function(data, type, row){
                        return '#'+data;
                    },
                },
                {
                    data: 'trans_date',
                    name: 'trans_date',
                    searchable: true,
                    render: function(data, type, row){
                        return moment(data).format('DD.MM.YYYY HH:mm');
                    },
                },
                {
                    data: 'amount',
                    class: 'text-end',
                    render: function(data, type, row) {
                        return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                    }
                },
                {
                    data: 'ppn',
                    class: 'text-end',
                    render: function(data, type, row) {
                        return (data != null ) ? data + '% / ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.ppn_amount) : '<code>-</code>';
                    }
                },
                {
                    data: 'total_amount',
                    class: 'text-end',
                    render: function(data, type, row) {
                        return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                    }
                },
                {
                    data: 'payment_status',
                    class: 'text-center',
                    render: function(data, type, row) {
                        let bg = '';
                        if(data == 'paid') {
                            bg = 'success';
                        }else{
                            bg = 'danger';
                        }
                        return '<span class="badge bg-'+bg+' text-'+bg+' bg-opacity-20">'+data+'</span>';
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

        $('.dataTables_filter input').unbind();
        $('.dataTables_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                tableData.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            tableData.draw();
        });

    });

    function openReceipt(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 7;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('transaksi.sales-inventory.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }
</script>
@endsection