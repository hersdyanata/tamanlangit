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
                @can('wahana-create')
                    <a href="{{ route('wahana.paket.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
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
                        <th>Paket</th>
                        <th>Max. Orang</th>
                        <th>Luas Kamar/Tenda</th>
                        <th>Jumlah Kamar/Tenda</th>
                        <th>Pilih Kamar/Tenda</th>
                        <th>Nama Tenda</th>
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
                url: "{{ route('wahana.paket.index') }}",
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', orderable: false, searchable: false, sortable: false },
                { data: 'name', name: 'nama', orderable: false, searchable: false, sortable: false },
                { data: 'max_person', name: 'max_orang', orderable: false, class: 'text-center', searchable: false, sortable: false },
                { 
                    data: 'room_wide',
                    class: 'text-center',
                    render: function(data, type, row) {
                        return data + ' M<sup>2</sup>';
                    }
                },
                { data: 'room_available', name: 'jumlah_kamar', class: 'text-center', orderable: false, searchable: false, sortable: false },
                {
                    data: 'user_choose_room',
                    name: 'user_choose_room',
                    class: 'text-center',
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    render: function(data){
                        return (data == 'Y') ? 'Ya' : 'Tidak';
                    }
                },
                { data: 'room_name', name: 'room_name', class: 'text-center', orderable: false, searchable: false, sortable: false },
                { 
                    data: 'price',
                    class: 'text-end',
                    render: function(data, type, row) {
                        return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                        // return data;
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
            "{{ route('wahana.paket.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('wahana.paket.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableData",
            tableData
        );
    }
</script>
@endsection