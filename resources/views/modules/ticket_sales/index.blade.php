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
                    <a href="{{ route('tiket.data.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
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
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Masa Berlaku</th>
                        <th>Quantity (Nomor Seri)</th>
                        <th>Status</th>
                        <th>Harga</th>
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
                url: "{{ route('tiket.data.index') }}"
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                { data: 'a_code', orderable: true, searchable: true, sortable: true },
                { data: 'description', orderable: true, searchable: true, sortable: true },
                { data: 'category', orderable: true, searchable: true, sortable: true },
                {
                    data: 'valid_from',
                    searchable: false,
                    sortable: false,
                    orderable: false,
                    render: function(data, type, row){
                        return moment(data).format('DD.MM.YYYY') + ' - ' + moment(row.valid_to).format('DD.MM.YYYY');
                    },
                },
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

    function preaction(i){
        sw_delete_validated(
            "{{ route('tiket.data.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.data.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableData",
            tableData
        );
    }
</script>
@endsection