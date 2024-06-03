@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
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

                    <button type="button" class="btn btn-primary btn-labeled btn-labeled-start" data-bs-toggle="modal" data-bs-target="#preprint">
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
                <td>{{ $data->category->name }}</td>
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
                    <th>Tgl. Cetak</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div id="preprint" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white border-0">
					<h6 class="modal-title">Cetak Tiket Presale #{{ $data->code }}</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
				</div>

                <form id="form_data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning alert-icon-start alert-dismissible fade show">
                            <span class="alert-icon bg-warning text-white">
                                <i class="ph-warning-circle"></i>
                            </span>
                            <span class="fw-semibold">Perhatian!</span> Pastikan kertas cukup sebelum mencetak.
                        </div>

                        <div class="row mb-2">
                            <label class="col-form-label col-lg-3 fw-bold">Cetak</label>
                            <div class="col-lg-9">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="printMethod" id="printMethod">
                                    <option value="full">Cetak Semua</option>
                                    <option value="partial">Cetak Parsial</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-form-label col-lg-3 fw-bold">Quantity</label>
                            <div class="col-lg-9">
                                <input type="hidden" class="form-control" name="id" id="id" value="{{ $data->id }}" readonly>
                                <input type="text" class="form-control" name="quantity" id="quantity"> 
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="cetak()">Cetak</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
<script>
    var tableData;
    $(document).ready(function() {
        $('.select').each(function(){
            $(this).select2();
        });

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
                {
                    data: 'print_date',
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

        let printQuantity = document.getElementById('quantity');
        printQuantity.disabled = true;

        $('#printMethod').on('change', function(){
            if(this.value === 'partial') {
                printQuantity.disabled = false;
                printQuantity.focus();
            } else {
                printQuantity.value = null;
                printQuantity.disabled = true;
            }
        });
    });

    function cetak(){
        if($('#printMethod').val() === 'partial' && $('#quantity').val() === ''){
            sw_error({'msg_body':'Silahkan isi quantity tiket yang akan dicetak!'});
            return;
        }

        if($('#printMethod').val() === 'partial' && $('#quantity').val() > {{ $data->quantity }}){
            sw_error({'msg_body':'Melebihi quantity tiket yang ada!'});
            return;
        }

        var newWindow = window.open('', '_blank');
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.data.presale_print') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                newWindow.document.write(s);
                newWindow.document.close();
            },
            error: function(e){
                sw_multi_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                setTimeout(() => {
                    reload_table(tableData);
                }, 5000);
                $('#preprint').modal('hide');
                // small_loader_close('form_data');
            }
        });
    }
</script>
@endsection