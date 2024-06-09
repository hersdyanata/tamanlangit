@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
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
                    <a href="{{ route('transaksi.cash-reservasi.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-note-pencil"></i>
                        </span>
                        Buat Reservasi Onsite
                    </a> 
                @endcan

                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start" onclick="reload_table(tableData)">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-arrows-counter-clockwise"></i>
                    </span>
                    Reload
                </button>

                <button type="button" class="btn btn-indigo btn-labeled btn-labeled-start" data-bs-toggle="modal" data-bs-target="#filter">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-magnifying-glass"></i>
                    </span>
                    Filter
                </button>
            </div>
        </div>

        <div class="card-body">
            Info: 
            <span class="badge bg-danger text-danger bg-opacity-10">Reservasi Dibatalkan</span>
            <span class="badge bg-info text-info bg-opacity-10">Didatangkan Oleh Event Organizer</span>
            <span class="badge bg-teal text-teal bg-opacity-10">PY: Status Pembayaran</span>
            <span class="badge bg-purple text-purple bg-opacity-10">RV: Status Reservasi</span>
            <span class="badge bg-purple text-indigo bg-opacity-10">RF: Status Refund</span>

            <table class="table datatable-basic table-xs table-hover" id="tableData">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>Reservasi</th>
                        <th>Tgl. Booking</th>
                        <th>Pemesan</th>
                        <th>Paket</th>
                        <th>Tagihan</th>
                        <th>Omzet</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="filter" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-indigo text-white border-0">
					<h6 class="modal-title">Filter Data Reservasi</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<div class="row mb-2">
                        <label class="col-form-label col-lg-4 fw-bold">Periode</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control daterange-basic" name="tanggal" id="tanggal"> 
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-4">Reservasi Via</label>
                        <div class="col-lg-8">
                            <select class="form-control multiselect" name="trans_via[]" id="trans_via" multiple="multiple" data-include-select-all-option="true">
                                <option value="onsite">Onsite</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-form-label col-lg-4">Status Reservasi</label>
                        <div class="col-lg-8">
                            <select class="form-control multiselect" name="reservation_status[]" id="reservation_status" multiple="multiple" data-include-select-all-option="true">
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label class="col-form-label col-lg-4">Status Pembayaran</label>
                        <div class="col-lg-8">
                            <select class="form-control multiselect" name="payment_status[]" id="payment_status" tabindex="-1" multiple="multiple" data-include-select-all-option="true">
                                <option value="ditinjau">Ditinjau</option>
                                <option value="paid">Paid</option>
                                <option value="cancel">Cancel</option>
                                <option value="expire">Kadaluarsa</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label class="col-form-label col-lg-4">Status Refund</label>
                        <div class="col-lg-8">
                            <select class="form-control multiselect" name="refund_status[]" id="refund_status" tabindex="-1" multiple="multiple" data-include-select-all-option="true">
                                <option value="paid">Selesai</option>
                                <option value="unpaid">Belum Selesai</option>
                            </select>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-indigo" onclick="setFilter()">Tampilkan</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
<script>
    sidebar_collapsed();
    var tableData;
    let filterActive = document.getElementById('filterActive');

    $(document).ready(function() {
        $('.daterange-basic').daterangepicker({
                parentEl: '.content-inner',
            locale: {
                format: 'YYYY-MM-DD', // Set the date format
                cancelLabel: 'Clear',
            }
        });

        $('.multiselect').multiselect();

        initializeTable(false);

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

    function setFilter(){
        if ($.fn.DataTable.isDataTable('.datatable-basic')) {
            tableData.destroy();
        }

        initializeTable(true);
        $('#filter').modal('hide');
    }

    function initializeTable(filter){
        let xFilter;
        if(filter === true){
            console.log(filter);
            xFilter = {
                setFilter: true,
                xPeriod: $('#tanggal').val(),
                xTransVia: $('#trans_via').val(),
                xReservationStatus: $('#reservation_status').val(),
                xPaymentStatus: $('#payment_status').val(),
            }
        }else{
            xFilter = {};
        }

        tableData = $('.datatable-basic').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Ketik untuk mencari...',
                lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('transaksi.cash-reservasi.index') }}",
                data: function(d) {
                    return $.extend({}, d, xFilter);
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', class: 'text-center', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                {
                    data: 'a_tiket',
                    render: function(data, type, row) {
                        return 'Tiket: ' + data + '<br> Tgl Pesan: ' + moment(row.created_at).format('DD.MM.YYYY HH:mm') + '<br> Via: ' + row.trans_via;
                    }
                },
                {
                    data: 'start_date',
                    render: function(data, type, row) {
                        let in_date = (row.checkin_date != null) ? moment(data).format('DD.MM.YYYY HH:mm') : '<code>-</code>';
                        let out_date = (row.checkout_date != null) ? moment(data).format('DD.MM.YYYY HH:mm') : '<code>-</code>';
                        
                        return 'Mulai: ' + moment(data).format('DD.MM.YYYY') + '<br>' + 
                               'Sampai: ' + moment(row.end_date).format('DD.MM.YYYY') + '<br> Check-in: ' + in_date + '<br>' + 'Check-out: ' + out_date;
                    }
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        return 'Nama: ' + data + '<br> WA: ' + row.wa_number + '<br> Email: ' + row.email;
                    }
                },
                {
                    data: 'wahana.name',
                    render: function(data, type, row) {
                        return ucwords(data) + ' / ' + row.room.name + '<br> Harga: ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.price) + ' x ' + row.night_count + ' malam <br> Anggota: ' + row.persons + ' Orang';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    render: function(data, type, row) {
                        let displayPpn = (row.ppn !== 0 ? row.ppn + '% (' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.ppn_amount) + ')' : '<code>-</code>');
                        let displayDiscount = (row.coupon_id !== null ? '-'+ new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.discount_amount) : '<code>-</code>');

                        return 'Subtotal: ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.subtotal) + '<br> PPn: ' + displayPpn + '<br> Diskon: ' + displayDiscount + '<br> Total: ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.total_amount);
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    render: function(data, type, row) {
                        let displayEo = 'EO: ' + (row.eo_id !== null ? '-' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.eo_total_commission) + ' (' + row.eo.name + ')' : '<code>-</code>');
                        let displayRefund = '<br>Refund: ' + (row.refund != null ? '-' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.refund) : '<code>-</code>');

                        return displayEo + displayRefund + '<br> Omzet: ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(row.omzet);
                    }
                },
                {
                    data: null,
                    orderable: false,
                    sortable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        let bgPayment = '';
                        let bgReservasi = '';
                        let refund = '';
                        let refundStatus = '';

                        if(row.payment_status === 'paid') {
                            bgPayment = 'success';
                        }else if(row.payment_status === 'ditinjau'){
                            bgPayment = 'warning';
                        }else{
                            bgPayment = 'danger';
                        }

                        if(row.reservation_status === 'selesai') {
                            bgReservasi = 'success';
                        }else if(row.reservation_status === 'aktif'){
                            bgReservasi = 'info';
                        }else{
                            bgReservasi = 'danger';
                        }

                        if(row.refund !== null){
                            let refundStatus = (row.refund_status === null) ? 'Belum Selesai' : 'Selesai';
                            refund = 'RF: <span class="badge bg-purple text-purple bg-opacity-20">'+refundStatus+'</span>';
                        }

                        return 'PY: <span class="badge bg-'+bgPayment+' text-'+bgPayment+' bg-opacity-20">'+row.payment_status+'</span><br>\
                                RV: <span class="badge bg-'+bgReservasi+' text-'+bgReservasi+' bg-opacity-20">'+row.reservation_status+'</span><br>'+refund;
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
            rowCallback: function(row, data, index) {
                if (data.reservation_status == 'cancel') {
                    $(row).addClass('bg-danger bg-opacity-10 text-danger');
                }
                
                if(data.eo_id != null){
                    $(row).addClass('bg-info bg-opacity-10 text-info');
                }
            }
        });
    }

    function ucwords(str) {
        return str.toLowerCase().replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });
    }

    function openReceipt(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 7;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('transaksi.reservasi.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }

    function finish_refund(id){
        swalInit.fire({
            title: 'Konfirmasi',
            html: 'Apakah Anda yakin sudah menyelesaikan refund ini?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya, tolong selesaikan!',
            cancelButtonText: 'Tidak, tolong batalkan!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            allowOutsideClick: false
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    url: "{{ route('transaksi.reservasi.finish_refund', ':id') }}".replace(':id', id),
                    type: "PUT",
                    data: {
                        _token : "{{ csrf_token() }}",
                        id : id
                    },
                    beforeSend: function(){
                        // small_loader_open(selector);
                    },
                    success: function(d){
                        swalInit.fire({
                            title: d.msg_title,
                            html: d.msg_body,
                            type: 'success',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-success',
                        });
                        reload_table(tableData)
                    },
                    complete: function(){
                        // small_loader_close(selector);
                    }
                });
            }
            else if(result.dismiss === swalInit.DismissReason.cancel) {
                swalInit.fire({
                    title: 'Dibatalkan',
                    html: 'Refund dibatalkan 😉',
                    type: 'success',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                    allowOutsideClick: false
                });
                // small_loader_close(selector);
            }
        });
    }
</script>
@endsection