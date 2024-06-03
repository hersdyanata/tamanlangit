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
<form id="form_data">
    @csrf
    <div class="row col-xl-12">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-calendar-check"></i> {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <span class="text-info fw-semibold">Tanggal: {{ date('d.m.Y') }}</span>
                    </div>
                </div>
            
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="tiket" id="tiket" placeholder="Masukkan Nomor Tiket. Contoh: 2402QSY0 lalu tekan enter..." autofocus autocomplete="off"> 
                        </div>

                        <div class="col-lg-2">
                            <button type="button" class="btn btn-success btn-labeled btn-labeled-start" id="btn_cfm" onclick="confirm()" disabled>
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-check"></i>
                                </span>
                                Konfirmasi
                            </button>
                        </div>
                    </div>

                    <div class="row mb-2" id="loader">
                        <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                    </div>

                    <input type="hidden" name="id" id="id" readonly>

                    <table class="table table-bordered table-xs">
                        <tr>
                            <td class="fw-bold" colspan="3" width="30%"><span class="fw-bold text-danger">DATA RESERVASI</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Nomor Tiket</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="trans_num"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Reservasi Via</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="trans_via"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Tanggal Reservasi</td>
                            <td width="5%" class="text-end fw-bold">:</td>
                            <td id="created_at"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Nama Pemesan</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Kontak</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="contact"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Reservasi Untuk Tanggal</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="period"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Durasi</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="duration"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Wahana</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="wahana"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Jumlah Peserta</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="persons"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="30%">Status Pembayaran</td>
                            <td width="1%" class="text-end fw-bold">:</td>
                            <td id="payment_status"></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-airplay"></i> Fasilitas</h6>
                </div>

                <div class="card-body">
                    <div class="border rounded p-3">
                        <ul class="list mb-0" id="facilities">
                        </ul>
                    </div>

                    <div id="extra_services" hidden>
                        <div class="mt-3 mb-2">
                            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-circles-three-plus"></i> Layanan Tambahan</h6>
                            <span class="badge btn bg-info text-info bg-opacity-10" onclick="addPerson()">Tambah Anggota</span>
                            <span class="badge btn bg-purple text-purple bg-opacity-10" id="btnAddItem" data-bs-toggle="modal" data-bs-target="#product">Tambah Item</span>
                        </div>
    
                        <table class="table table-xs table-hover">
                            <thead>
                                <tr class="table-border-double bg-teal bg-opacity-20">
                                    <th width="30%">Layanan</th>
                                    <th width="25%">Harga</th>
                                    <th width="10%">Quantity</th>
                                    <th width="25%" class="text-end">Subtotal</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableExtraService"></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-semibold">TOTAL</td>
                                    <td class="text-end fw-semibold">
                                        <input type="hidden" readonly name="total_extra_bill" id="total_extra_bill">
                                        <span id="display_total_bill"></span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="product" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white border-0">
                <h6 class="modal-title">Stock Inventory</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table datatable-basic table-hover" id="tableData">
                    <thead>
                        <tr class="table-border-double bg-teal bg-opacity-20">
                            <th class="text-center">#</th>
                            <th>Produk</th>
                            <th>Jenis Inventory</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger close_modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    sidebar_collapsed();
    $('#loader').hide();
    let inputTicket = document.getElementById('tiket');
    let btnConfirm = document.getElementById('btn_cfm');
    let btnExtraService = document.getElementById('btn_extra_service');

    let dataId = document.getElementById('id');
    let transNum = document.getElementById('trans_num');
    let transVia = document.getElementById('trans_via');
    let transDate = document.getElementById('created_at');
    let name = document.getElementById('name');
    let contact = document.getElementById('contact');
    let period = document.getElementById('period');
    let duration = document.getElementById('duration');
    let wahana = document.getElementById('wahana');
    let persons = document.getElementById('persons');
    let paymentStatus = document.getElementById('payment_status');
    let divFacilities = document.getElementById('facilities');
    let btnAddItem = document.getElementById('btnAddItem');
    let stockTable;
    let addedProductIds = new Set();
    let addedPerson = new Set();
    let cartTable = document.getElementById('tableExtraService');
    let extraServices = document.getElementById('extra_services');
    let inputTotalBill = document.getElementById('total_extra_bill');
    let displayTotalBill = document.getElementById('display_total_bill');

    inputTicket.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (this.value !== '') {
                getData(this.value);
            }
        }
    });

    $('#product').on('shown.bs.modal', function() {
        if ($('#tableData').is(":visible") && $('#tableData').parent().is(":visible")) {
            loadStockInventory();
        }
    });

    $(function() {
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });

    function getData(ticketNumber){
        $.ajax({
            type: "GET",
            url: "{{ route('transaksi.cash-checkin.show', ':id') }}".replace(':id', ticketNumber),
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                divFacilities.innerHTML = null;
                if(s.isFound == true){
                    sw_success(s);
                    dataId.value = s.data.id;
                    transNum.textContent = '#' + s.data.trans_num;
                    transVia.textContent = ucwords(s.data.trans_via);
                    transDate.textContent = moment(s.data.created_at).format('DD.MM.YYYY H:m');
                    name.textContent = ucwords(s.data.name);
                    contact.textContent = 'WA: ' + s.data.wa_number + ' / Email: ' + s.data.email;
                    period.textContent = moment(s.data.start_date).format('DD.MM.YYYY') + ' sd. ' + moment(s.data.end_date).format('DD.MM.YYYY');
                    duration.textContent = s.data.night_count + ' malam';
                    wahana.textContent = ucwords(s.data.wahana.name) + ' / Tenda: ' + s.data.room.name;
                    persons.textContent = s.data.persons + ' orang';
                    paymentStatus.textContent = ucwords(s.data.payment_status);
    
                    const facilities = s.data.wahana.facilities;
                    for(const obj of facilities){
                        divFacilities.innerHTML += '<li class="text-success fw-semibold">'+ ucwords(obj.name) +'</li>';
                    }

                    btnConfirm.disabled = false;
                }else{
                    sw_error(s);
                }
            },
            complete: function(){
                $('#loader').hide();
                inputTicket.value = null;
                if (extraServices) {
                    extraServices.removeAttribute('hidden');
                } else {
                    console.error('Element with ID "extraServices" not found.');
                }
            }
        });
    }

    function ucwords(str) {
        return str.toLowerCase().replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });
    }

    function confirm(){
        $.ajax({
            type: "PUT",
            url: "{{ route('transaksi.cash-checkin.update', ':id') }}".replace(':id', dataId.value),
            data: $('#form_data').serialize(),
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                sw_success(s);
            },
            error: function(e){
                sw_single_error(e);
            },
            complete: function(){
                $('#loader').hide();
                dataId.value = null;
                transNum.textContent = null;
                transVia.textContent = null;
                transDate.textContent = null;
                name.textContent = null;
                contact.textContent = null;
                period.textContent = null;
                duration.textContent = null;
                wahana.textContent = null;
                persons.textContent = null;
                paymentStatus.textContent = null;
                divFacilities.innerHTML = null;

                if(inputTotalBill.value > 0){
                    cartTable.innerHTML = null;
                    extraServices.setAttribute('hidden', '');
                    inputTotalBill.value = null;
                    displayTotalBill.innerHTML = null;
                    addedPerson = new Set();
                    addedProductIds = new Set();
                }

                btnConfirm.disabled = true;
                inputTicket.focus();
            }
        });
    }

    function loadStockInventory(){
        if ($.fn.DataTable.isDataTable('#tableData')) {
            $('#tableData').DataTable().destroy();
        }

        stockTable = $('#tableData').DataTable({
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
                    d.param = 'stock';
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                { data: 'product.name', orderable: true, searchable: true, sortable: true },
                {
                    data: 'product.inventory_type',
                    searchable: true,
                    orderable: true,
                    sortable: true,
                    render: function(data, type, row) {
                        return (data == 'loan') ? '<span class="badge bg-success text-success bg-opacity-20">Disewa</span>' : '<span class="badge bg-warning text-warning bg-opacity-20">Dijual</span>';
                    }
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row) {
                        return (row.quantity <= row.min_stock_reminder) ? '<span class="text-danger">'+data+'</span>' : '<span class="text-success">'+data+'</span>';
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
                    data: null,
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-sm bg-teal text-white btn-icon tooltiped" title="Masukkan Keranjang" onclick="addItemToCart('+row.id+')">\
                                    <i class="ph-plus"></i>\
                                </button>';
                    }
                },
            ],
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
                stockTable.search(this.value).draw();
            }
        });

        $('.btn_filter').on('click', function(){
            stockTable.draw();
        });
    }

    function addItemToCart (stockId) {
        let selectedRow = stockTable.row(function (idx, data, node) {
            return data.id === stockId;
        }).data();

        let available_quantity = selectedRow.quantity;

        if(available_quantity < 1){
            swalInit.fire({
                title: 'Gagal!',
                html: 'Quantity tidak tersedia.',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;            
        }

        if (addedProductIds.has(selectedRow.id)) {
            swalInit.fire({
                title: 'Gagal!',
                html: 'Produk ini sudah dipilih.',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;
        }

        addedProductIds.add(selectedRow.id);

        let newRow = cartTable.insertRow();
        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);

        cell1.innerHTML = selectedRow.product.name;
        cell2.innerHTML = formatCurrency(selectedRow.price)+'<input type="hidden" class="form-control" name="price[]" value="'+ selectedRow.price +'" id="price_' + selectedRow.id + '">\
                            <input type="hidden" class="form-control" name="extra_type[]" value="item" readonly>\
                            <input type="hidden" class="form-control" name="stock_id[]" value="' + selectedRow.id + '" readonly>';
        cell3.innerHTML = '<input type="number" class="form-control quantity" name="quantity[]" value="1" min="1" id="quantity_'+selectedRow.id+'">';
        cell4.innerHTML = '<input type="text" class="form-control text-end subtotal" name="subtotal[]" id="subtotal_' + selectedRow.id + '" readonly>';
        cell5.innerHTML = '<button class="btn btn-sm btn-danger" onclick="removeFromCart(this, '+ selectedRow.id +')">Hapus</button>';

        calculateSubtotal(selectedRow.id);
        calculateTotal();

        document.getElementById('quantity_'+selectedRow.id).addEventListener('change', function() {
            if(this.value > available_quantity){
                this.value = this.value -1;
                calculateSubtotal(selectedRow.id);
                calculateTotal();

                swalInit.fire({
                    title: 'Gagal!',
                    html: 'Quantity melebihi ketersediaan yang ada.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                return;
            }
            calculateSubtotal(selectedRow.id);
            calculateTotal();
        });
    };

    function addPerson(){
        if (addedPerson.has('person')){
            swalInit.fire({
                title: 'Gagal!',
                html: 'Penambahan anggota sudah ada. Silahkan tentukan jumlah anggota baru.',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;
        }
        addedPerson.add('person');

        let newRow = cartTable.insertRow();
        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);

        cell1.innerHTML = '+Anggota';
        cell2.innerHTML = '<input type="text" class="form-control" name="price[]" id="price_person">\
                            <input type="hidden" class="form-control" name="extra_type[]" value="person" readonly autocomplete="off">\
                            <input type="hidden" class="form-control" name="stock_id[]" readonly>';
        cell3.innerHTML = '<input type="number" class="form-control quantity" name="quantity[]" value="1" min="1" id="quantity_person" autocomplete="off">';
        cell4.innerHTML = '<input type="text" class="form-control text-end subtotal" name="subtotal[]" id="subtotal_person" readonly>';
        cell5.innerHTML = '<button class="btn btn-sm btn-danger" onclick="removeFromCart(this, \'person\')">Hapus</button>';

        document.getElementById('price_person').addEventListener('change', function(){
            calculateSubtotal('person');
            this.value = formatCurrency(this.value);
            calculateTotal();
        });

        document.getElementById('quantity_person').addEventListener('change', function(){
            calculateSubtotal('person');
            calculateTotal();
        });

    }

    function calculateSubtotal(id){
        if(id !== 'person'){
            let cal_price = document.getElementById('price_'+id);
            let cal_quantity = document.getElementById('quantity_'+id);        
            let subtotal = parseInt(cal_price.value * cal_quantity.value);
            document.getElementById('subtotal_'+id).value = formatCurrency(subtotal);
        }else{
            let cal_price = document.getElementById('price_person');
            let cal_quantity = document.getElementById('quantity_person');
            let subtotal = parseInt(removeDotSeparator(cal_price.value) * cal_quantity.value);
            document.getElementById('subtotal_person').value = formatCurrency(subtotal);
        }
    }

    function calculateTotal(){
        let all_subtotal = document.getElementsByClassName('subtotal');
        let total = 0;
        for (let i = 0; i < all_subtotal.length; i++) {
            total += parseFloat(removeDotSeparator(all_subtotal[i].value));
        }

        inputTotalBill.value = total;
        displayTotalBill.innerHTML = formatCurrency(total);
    }
    
    function removeFromCart(removeButton, row_id) {
        if(row_id !== 'person'){
            let row = removeButton.parentNode.parentNode;
            row.parentNode.removeChild(row);
            addedProductIds.delete(row_id);
            calculateTotal();
        }else{
            let row = removeButton.parentNode.parentNode;
            row.parentNode.removeChild(row);
            addedPerson.delete('person');
            calculateTotal();
        }
    }
</script>
@endsection