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
                <div class="ms-sm-auto my-sm-auto">
                    <a href="{{ route('tiket.data.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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

        <table class="table table-bordered table-xs mb-2">
            <tr>
                <td colspan="2" class="text-center">
                    <h3 class="mb-0 fw-medium">
                        Tiket Bulk<br>
                    </h3>
                </td>
            </tr>
            <tr>
                <td width="50%">Kode</td>
                <td>#{{ $data->code }}</td>
            </tr>
            <tr>
                <td width="50%">Deskripsi</td>
                <td>{{ $data->description }}</td>
            </tr>
            <tr>
                <td width="50%">Kategori</td>
                <td>{{ $data->category }}</td>
            </tr>
            {{-- <tr>
                <td width="50%">Masa Berlaku</td>
                <td>{{ date('d.m.Y', strtotime($data->valid_from)) }} s/d {{ date('d.m.Y', strtotime($data->valid_to)) }}</td>
            </tr> --}}
            <tr>
                <td width="50%">Quantity</td>
                <td>{{ number_format($data->quantity) }}</td>
            </tr>
            <tr>
                <td width="50%">Status</td>
                <td>{{ $data->status }}</td>
            </tr>
            <tr>
                <td width="50%">Harga</td>
                <td>{{ number_format($data->price,0) }}</td>
            </tr>
            <tr>
                <td width="50%">Dibuat Oleh</td>
                <td>{{ $data->creator->name }} / {{ date('Y.m.d H:i', strtotime($data->created_at)) }}</td>
            </tr>
        </table>
    </div>

    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> Nomor Seri</h6>
        </div>

        <table class="table table-bordered table-xs" id="tableData">
            <thead>
                <tr class="table-border-double bg-teal bg-opacity-20">
                    <th class="text-center">#</th>
                    <th>Nomor Seri</th>
                    <th>Status</th>
                    <th>Tgl. Terjual</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('page_js')
<script>
    var tableData;
    $(document).ready(function() {
        tableData = $('#tableData').DataTable({
            serverSide: true,
            processing: true,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Ketik untuk mencari...',
                lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('tiket.data.detail', $data->id) }}"
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    class: 'text-center',
                    searchable: false,
                    sortable: false,
                    orderable: false,
                    render: function(data, type, row){
                        return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(data);
                    },
                },
                { data: 'serial_number', orderable: true, searchable: true, sortable: true },
                { data: 'status', orderable: true, searchable: true, sortable: true },
                {
                    data: 'sold_date',
                    searchable: false,
                    sortable: false,
                    orderable: false,
                    render: function(data, type, row){
                        return (data != null) ? moment(data).format('DD.MM.YYYY') : '-';
                    },
                },
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
</script>
@endsection