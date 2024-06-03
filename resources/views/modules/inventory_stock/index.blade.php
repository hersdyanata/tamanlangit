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
                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start" onclick="reload_table(tableData)">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-arrows-counter-clockwise"></i>
                    </span>
                    Reload
                </button>
            </div>
        </div>

        <div class="card-body">
            <table class="table datatable-basic table-hover table-xs" id="tableData">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Jenis Inventory</th>
                        <th>Quantity</th>
                        <th>Pengingat</th>
                        <th>Harga Jual/Sewa</th>
                        <th>Pembelian Terakhir</th>
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
    sidebar_collapsed();
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
                url: "{{ route('inventory.stock.index') }}",
                data: function (d) {
                    d.param = 'stock'; // Ganti 'your_stock_value' dengan nilai yang sesuai
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                { data: 'product.code', orderable: true, searchable: true, sortable: true },
                { data: 'product.name', orderable: true, searchable: true, sortable: true },
                { data: 'product.category.name', orderable: true, searchable: true, sortable: true },
                {
                    data: 'product.inventory_type',
                    class: 'text-center',
                    render: function(data, type, row) {
                        return (data == 'loan') ? '<span class="badge bg-success text-success bg-opacity-20">Disewa</span>' : '<span class="badge bg-warning text-warning bg-opacity-20">Dijual</span>';
                    }
                },
                {
                    data: 'quantity',
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row) {
                        return (row.quantity <= row.min_stock_reminder) ? '<span class="text-danger">'+data+'</span>' : '<span class="text-success">'+data+'</span>';
                    }
                },
                {
                    data: 'min_stock_reminder',
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row) {
                        return (data == null) ? '<span class="text-danger">Belum ada</span>' : 'Min: ' + data;
                    }
                },
                {
                    data: 'price',
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row) {
                        return (data == null) ? '<span class="text-danger">Belum ada</span>' : new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                    }
                },
                {
                    data: 'last_purchase',
                    class: 'text-center',
                    searchable: false,
                    sortable: false,
                    orderable: false,
                    render: function(data, type, row){
                        return moment(data).format('DD.MM.YYYY HH:mm');
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
            "{{ route('inventory.stock.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('inventory.stock.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableData",
            tableData
        );
    }

    function set_(i, param){
        $.ajax({
            url: "{{ route('inventory.stock.edit', ':id') }}".replace(':id', i),
            type: "GET",
            data: {
                _token : "{{ csrf_token() }}",
                id : i
            },
            beforeSend: function(){
                // small_loader_open(selector);
            },
            success: function(s){
                swalInit.fire({
                    title: (param == 'notif') ? 'Set Pengingat Minimum Quantity' : 'Set Harga Jual/Sewa',
                    html: (param == 'notif') ? 'Jika stock produk ' + s.msg_body + ' sudah mencapai quantity ini maka akan mendapatkan pemberitahuan.' : 'Silahkan tentukan harga jual untuk stock produk ' + s.msg_body + '.',
                    input: 'number',
                    icon: 'info',
                    inputPlaceholder: (param == 'notif') ? 'Set quantity...' : 'Set harga...',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    inputValidator: function(value) {
                        return !value && 'Silahkan diisi!'
                    }
                }).then(function(result) {
                    if(result.value) {
                        $.ajax({
                            type: "PUT",
                            url: "{{ route('inventory.stock.update', ':id') }}".replace(':id', i),
                            data: {
                                _token : "{{ csrf_token() }}",
                                _set: param,
                                _value: result.value,
                            },
                            success: function (s) {
                                swalInit.fire({
                                    html: s.msg_body,
                                    type: 'success',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top',
                                    timer: 5000,
                                    showConfirmButton: false,
                                });
                                reload_table(tableData);
                            },
                            error: function(e){
                                sw_multi_error(e);
                            },
                        });
                    }
                });
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }
</script>
@endsection