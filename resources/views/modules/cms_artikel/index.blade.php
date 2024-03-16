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
                @can('cms-blog-artikel-create')
                    <a href="{{ route('cms.artikel.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
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
            <table class="table datatable-basic table-hover" id="tableData">
                <thead>
                    <tr class="table-border-double table-xs bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th width="20%">Judul</th>
                        <th>Kategori</th>
                        <th width="30%">Konten</th>
                        <th>Status</th>
                        <th>Keywords</th>
                        <th>URL</th>
                        <th>Views</th>
                        <th>Creator</th>
                        <th width="10%" class="text-center">Actions</th>
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
                url: "{{ route('cms.artikel.index') }}",
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', orderable: false, searchable: false, sortable: false },
                { data: 'title', name: 'title', orderable: true, searchable: true, sortable: true },
                { data: 'category', name: 'category', orderable: true, searchable: true, sortable: true },
                { data: 'content_', name: 'content_', orderable: true, searchable: true, sortable: true },
                { data: 'status', name: 'status', orderable: true, searchable: true, sortable: true },
                { data: 'keywords', name: 'keywords', orderable: true, searchable: true, sortable: true },
                { data: 'url', name: 'url', orderable: true, searchable: true, sortable: true },
                { data: 'count_views', name: 'count_views', orderable: true, searchable: true, sortable: true },
                { data: 'creator', name: 'creator', orderable: true, searchable: true, sortable: true },
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
            "{{ route('cms.artikel.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('cms.artikel.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableData",
            tableData
        );
    }
</script>
@endsection