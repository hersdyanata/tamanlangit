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
<div class="row col-xl-12">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto"><i class="ph-shopping-cart"></i> Keranjang</h6>
                <div class="ms-sm-auto my-sm-auto">
                    <a href="{{ route('transaksi.cash-inventory.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-arrow-left"></i>
                        </span>
                        Kembali
                    </a> 
                </div>
            </div>
        
            <div class="card-body">
                <form id="form_data">
                    @csrf
                    <div class="row mb-3">
                        <table class="table datatable-basic table-hover table-bordered table-xs" id="table-kasir">
                            <thead>
                                <tr class="table-border-double bg-primary text-white">
                                    <th class="text-center">#</th>
                                    <th width="40%">Produk</th>
                                    <th width="25%" class="text-center">Quantity</th>
                                    <th width="25%" class="text-end">Harga</th>
                                    <th width="20%" class="text-end">Subtotal</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">T O T A L</td>
                                    <td class="text-end fw-bold" id="totalSumFooter"></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="border border-primary rounded p-5">
                        <div class="row mb-2">
                            <div class="col-lg-10 offset-2">
                                <label class="form-check">
                                    <input type="checkbox" name="toggle_ppn" id="toggle_ppn" class="form-check-input form-check-input-primary">
                                    <span class="form-check-label">Gunakan PPn</span>
                                </label>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2 fw-bold">PPn (%)</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control border-primary" name="ppn" id="ppn" placeholder="Persentase PPn....">
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control border-primary" name="ppn_amount" id="ppn_amount" placeholder="Nilai PPn akan diakumulasi otomatis...">
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2 fw-bold">Total Tagihan</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control border-primary" name="total_amount" id="total_amount" placeholder="Total Tagihan..." readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2 fw-bold">Pembayaran</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="payment_method" id="payment_method">
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="split">Split (Transfer + Cash)</option>
                                </select>
                            </div>
                        </div>

                        <div id="split_pay"></div>

                        <div class="row mb-3">
                            <div class="col-lg-10 offset-2">
                                <button type="button" class="btn btn-primary btn-labeled btn-labeled-start" onclick="save()">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-floppy-disk"></i>
                                    </span>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> Stock Inventory</h6>
            </div>
        
            <div class="card-body">
                <table class="table datatable-basic table-hover table-bordered table-xs" id="tableData">
                    <thead>
                        <tr class="table-border-double bg-teal text-white">
                            <th class="text-center">#</th>
                            <th>Produk</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Action</th>
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
    sidebar_collapsed();
    var tableData;
    var tableKasir = $('#table-kasir tbody');
    let calc_ppn = document.getElementById('calc_ppn');
    let ppn_percent = document.getElementById('ppn');
    let ppn_amount = document.getElementById('ppn_amount');
    let headerTotal = document.getElementById('total_amount');
    let totalAfterPpn;

    $(document).ready(function() {
        $('#payment_method').select2();
        $('.select2-selection').addClass('border-primary');

        ppn_percent.disabled = true;
        ppn_amount.disabled = true;


        document.getElementById('toggle_ppn').addEventListener('change', function() {
            if(this.checked) {
                ppn_percent.value = '11';
                ppn_percent.disabled = false;
                ppn_amount.disabled = false;

                if(document.getElementById('payment_method').value == 'split'){
                    $('#payment_method').val('cash').trigger('change');
                }

                applyPpn();
            }else{
                ppn_percent.value = null;
                ppn_amount.value = null;

                ppn_percent.disabled = true;
                ppn_amount.disabled = true;

                updateCartTotal();

                if(document.getElementById('payment_method').value == 'split'){
                    $('#payment_method').val('cash').trigger('change');
                }
            }
        });

        $('#payment_method').on('change', function() {
            let split_pay_div = document.getElementById('split_pay');
            if(this.value == 'split'){
                split_pay_div.innerHTML = '<div class="row mb-3"><div class="col-lg-10 offset-2">\
                                              <div class="row mb-1">\
                                                  <label class="col-form-label col-lg-2 fw-bold fst-italic">- Cash</label>\
                                                  <div class="col-lg-10">\
                                                      <input type="text" class="form-control border-primary" name="pay[cash]" id="pay_cash" placeholder="Pembayaran Cash...">\
                                                  </div>\
                                              </div>\
                                              <div class="row mb-1">\
                                                  <label class="col-form-label col-lg-2 fw-bold fst-italic">- Transfer</label>\
                                                  <div class="col-lg-10">\
                                                      <input type="text" class="form-control border-primary" name="pay[transfer]" id="pay_transfer" placeholder="Pembayaran via Transfer..." readonly>\
                                                  </div>\
                                              </div>\
                                          </div></div>';

                // Set focus after a short delay
                setTimeout(function() {
                    document.getElementById('pay_cash').focus();
                }, 100);

                document.getElementById('pay_cash').addEventListener('change', function() {
                    if(headerTotal.value){
                        let pay_cash = this.value;
                        let pay_transfer = removeThousandSeparator(headerTotal.value) - this.value;
                        document.getElementById('pay_transfer').value = formatCurrency(pay_transfer);
                        document.getElementById('pay_cash').value = formatCurrency(pay_cash);
                    }else{
                        swalInit.fire({
                            title: 'Gagal!',
                            html: 'Tidak ada yang bisa dihitung.',
                            type: 'error',
                            icon: 'error',
                            confirmButtonClass: 'btn btn-danger',
                            allowOutsideClick: false
                        });
                        return;
                    }
                });
            }else{
                split_pay_div.innerHTML = '';
            }
        });

        tableData = $('#tableData').DataTable({
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
                    d.param = 'sales'; // Ganti 'your_stock_value' dengan nilai yang sesuai
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', class: "text-center", orderable: false, searchable: false, sortable: false },
                {
                    data: 'product.name',
                    // name: 'product',
                    searchable: true,
                    orderable: true,
                    sortable: true,
                    render: function(data, type, row) {
                        return '<span class="fw-semibold fst-italic">' + row.product.code + '</span> - ' + row.product.name;
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
                    name: 'price',
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
                        return '<button type="button" class="btn btn-sm bg-teal text-white btn-icon tooltiped" title="Masukkan Keranjang" onclick="addToCart('+row.id+')">\
                                    <i class="ph-plus"></i>\
                                </button>';
                    }
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
    
    function applyPpn(){
        ppn_amount.value = formatCurrency( parseFloat( (removeThousandSeparator(headerTotal.value) * ppn_percent.value) / 100 ) );

        totalAfterPpn = parseInt(removeThousandSeparator(headerTotal.value)) + parseInt(removeThousandSeparator(ppn_amount.value));
        headerTotal.value = formatCurrency(totalAfterPpn);
    }

    function addToCart(stockId) {
        let selectedRow = tableData.row(function (idx, data, node) {
            return data.id === stockId;
        }).data();
        if(selectedRow.quantity < 1){
            swalInit.fire({
                title: 'Gagal!',
                html: 'Stock produk ini sudah habis.',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;
        }

        var existingRow = tableKasir.find('tr[data-product-id="' + stockId + '"]');

        let productName = '<span class="fw-semibold fst-italic">' + selectedRow.product.code + '</span> - ' + selectedRow.product.name;
        let price = selectedRow.price;

        if (existingRow.length > 0) {
            swalInit.fire({
                title: 'Gagal!',
                html: 'Produk ini sudah dipilih.',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;
        } else {
            var newRow = $('<tr data-product-id="' + stockId + '">').appendTo(tableKasir);
            newRow.append('<td class="text-center">' + stockId + '</td>');
            newRow.append('<td>' + productName + '</td>');
            newRow.append('<td class="text-center quantity-control">\
                            <input type="hidden" class="available_quantity" id="available_quantity_'+stockId+'" value="'+selectedRow.quantity+'" readonly>\
                            <input type="hidden" name="stock_id[]" value="'+stockId+'" readonly>\
                            <input type="hidden" name="product_id[]" value="'+selectedRow.product_id+'" readonly>\
                            <div class="input-group">' +
                                '<div class="input-group-prepend">' +
                                    '<button class="btn btn-outline-warning decrease" type="button" onmousedown="decreaseQuantity(this)">-</button>' +
                                '</div>' +
                                '<input type="number" class="form-control text-center quantity border-success rounded" name="quantity[]" value="1" id="quantity_'+ stockId +'" data-product-id="'+stockId+'" readonly>' +
                                '<div class="input-group-append">' +
                                    '<button class="btn btn-outline-success increase" type="button" onmousedown="increaseQuantity(this, '+stockId+')">+</button>' +
                                '</div>' +
                            '</div></td>');
            newRow.append('<td class="text-end">\
                            <input type="hidden" name="old_price[]" id="old_price_' + stockId + '" value="' + price + '" readonly>\
                            <input onchange="updateSubtotalManual('+stockId+')" type="text" class="text-end border-primary form-control price" name="price[]" id="price_' + stockId + '" value="'+ formatCurrency(price) +'">\
                          </td>');
            newRow.append('<td class="text-end subtotal" id="subtotal_'+ stockId +'"></td>');
            newRow.append('<td class="text-center"><button class="btn btn-danger btn-sm" onclick="removeFromCart(' + stockId + ')">Batal</button></td>');

            updateSubtotal(newRow);
            updateCartTotal();
        }
    }

    function decreaseQuantity(element) {
        var input = $(element).closest('.input-group').find('input');
        var quantity = parseInt(input.val());

        if (quantity > 1) {
            input.val(quantity - 1);
            updateSubtotal($(element).closest('tr'));
            updateCartTotal();
        }
    }

    function increaseQuantity(element, product_id) {
        var input = $(element).closest('.input-group').find('input');
        var quantity = parseInt(input.val());

        let available_quantity = parseInt($('#available_quantity_'+product_id).val());
        let buy_quantity = parseInt($('#quantity_'+product_id).val());
        if(buy_quantity >= available_quantity){
            console.log('masuk sini');
            swalInit.fire({
                title: 'Gagal!',
                html: 'Tidak bisa menambah melebihi stock tersedia: <strong>' + available_quantity + '</strong>',
                type: 'error',
                icon: 'error',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: false
            });
            return;
        }else{
            input.val(quantity + 1);
            updateSubtotal($(element).closest('tr'));
            updateCartTotal();
        }
    }

    function updateSubtotalManual(product_id){
        var quantity = $('#quantity_'+product_id).val();
        var price = $('#price_'+product_id).val();
        var subtotal = quantity * price;

        $('#subtotal_'+product_id).text(formatCurrency(subtotal));
        $('#price_'+product_id).val(formatCurrency(price));
    }
    
    function updateSubtotal(row) {
        var quantity = parseInt(row.find('.quantity').val());
        var price = parseFloat(removeThousandSeparator(row.find('.price').val()));
        var subtotal = quantity * price;
        row.find('.subtotal').text(formatCurrency(subtotal));
    }

    function updateCartTotal() {
        var total = 0;
        tableKasir.find('.subtotal').each(function () {
            total += parseFloat($(this).text().replace(/\./g,""));
        });

        // Display the total somewhere in your UI
        $('#totalSumFooter').text(formatCurrency(total));
        $('#total_amount').val(formatCurrency(total));
    }

    function removeFromCart(productId) {
        // Remove the row from table-kasir
        tableKasir.find('tr[data-product-id="' + productId + '"]').remove();

        // Update the cart total
        updateCartTotal();
    }

    function formatCurrency(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).formatToParts(number)
                        .map(part => part.type === 'currency' ? '' : part.value)
                        .join('');
    }

    function updateQuantity(element) {
        var input = $(element);
        var quantity = parseInt(input.val());

        if (quantity < 1 || isNaN(quantity)) {
            input.val(1);
        }

        updateSubtotal(input.closest('tr'));
        updateCartTotal();
    }

    function removeThousandSeparator(inputString) {
        return inputString.replace(/\./g, '');
    }

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('transaksi.cash-inventory.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                console.log(s);
                // sw_success_redirect(s, "{{ route('transaksi.cash-inventory.index') }}");
                sw_success(s);
                reload_table(tableData);
                openReceipt(s.trans_id);
            },
            error: function(e){
                sw_multi_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                // small_loader_close('form_data');
                tableKasir.empty();
                $('#totalSumFooter').empty();
                document.getElementById('form_data').reset();
                $('#payment_method').val('cash').trigger('change');
                $('#split_pay').html('');
            }
        });
    }

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