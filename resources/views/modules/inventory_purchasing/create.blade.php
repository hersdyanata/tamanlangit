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
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <a href="{{ route('inventory.purchasing.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-arrow-left"></i>
                            </span>
                            Batal
                        </a> 
                    </div>
                </div>

                <div class="card-body border-bottom border-light">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Supplier</label>
                        <div class="col-lg-10">
                            <select class="form-control select" data-minimum-results-for-search="Infinity" name="supplier_id" id="supplier_id">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-form-label col-lg-2">Menggunakan PPN?</label>
                        <div class="col-lg-10">
                            <label class="form-check">
                                <input type="checkbox" name="toggle_ppn" id="toggle_ppn" class="form-check-input form-check-input-primary">
                                <span class="form-check-label"><code>Jika ada PPn silahkan terapkan setelah selesai penambahan produk</code></span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">PPn (%)</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="ppn" id="ppn" placeholder="Persentase PPn....">
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="ppn_amount" id="ppn_amount" placeholder="Nilai PPn akan diakumulasi otomatis...">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Total Tagihan</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="Tagihan setelah dikenakan PPn..." readonly>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-form-label col-lg-2">Tidak masuk stock</label>
                        <div class="col-lg-10">
                            <label class="form-check">
                                <input type="checkbox" name="toggle_non_stock" id="toggle_non_stock" class="form-check-input form-check-input-primary">
                                <span class="form-check-label"><code>Centang jika pembelian ini tidak akan dimasukkan kedalam stock inventory</code></span>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2"></label>
                        <div class="col-lg-10">
                            <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()">
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-floppy-disk"></i>
                                </span>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body border-bottom border-light">
                    <button type="button" class="btn btn-primary btn-labeled btn-labeled-start mb-3" id="modal_product" data-bs-toggle="modal" data-bs-target="#product">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-plus"></i>
                        </span>
                        Tambahkan Produk
                    </button>

                    <table class="table datatable-basic table-hover table-xs">
                        <thead>
                            <tr class="table-border-double bg-primary bg-opacity-20">
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cartTable"></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end"><strong>T O T A L</strong></td>
                                <td class="text-end" id="totalSumFooter"></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

	<div id="product" class="modal fade" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white border-0">
					<h6 class="modal-title">Daftar Produk</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<table class="table datatable-basic table-hover" id="tableData">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th class="text-center">Action</th>
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
</form>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        $('.select').each(function(){
            $(this).select2();
        });
        
        let calc_ppn = document.getElementById('calc_ppn');
        let ppn_percent = document.getElementById('ppn');
        let ppn_amount = document.getElementById('ppn_amount');
        let productTable;

        ppn_percent.disabled = true;
        ppn_amount.disabled = true;

        let headerTotal = document.getElementById('total_amount');
        let totalAfterPpn;


        document.getElementById('toggle_ppn').addEventListener('change', function() {
            if(this.checked) {
                ppn_percent.value = '11';
                ppn_percent.disabled = false;
                ppn_amount.disabled = false;
                updateFooterTotal();
                applyPpn();
            }else{
                ppn_percent.value = null;
                ppn_amount.value = null;

                ppn_percent.disabled = true;
                ppn_amount.disabled = true;

                // headerTotal.value = formatCurrencyIDR(total);
                updateFooterTotal();
            }
        });

        function applyPpn(){
            ppn_amount.value = formatCurrencyIDR( parseFloat( (removeThousandSeparator(headerTotal.value) * ppn_percent.value) / 100 ) );

            totalAfterPpn = parseInt(removeThousandSeparator(headerTotal.value)) + parseInt(removeThousandSeparator(ppn_amount.value));
            headerTotal.value = formatCurrencyIDR(totalAfterPpn);
            console.log(totalAfterPpn);
        }

        $('#modal_product').on('click', function() {
            // Show the modal
            $('#product').css('display', 'block');

            // Initialize or redraw DataTable when modal is shown
            load_product();
        });

        // At the beginning of your script
        let addedProductIds = new Set();

        // Function to add selected row to the cart
        window.addToCart = function (productId) {
            // Get the selected row data using DataTables API
            let selectedRow = productTable.row(function (idx, data, node) {
                return data.id === productId;
            }).data();

            // Check if the selected product already exists in the cart
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

            // Get the cart table
            let cartTable = document.getElementById('cartTable');

            // Create a new row in the cart table
            let newRow = cartTable.insertRow();

            // Add cells to the new row
            let cell1 = newRow.insertCell(0);
            let cell2 = newRow.insertCell(1);
            let cell3 = newRow.insertCell(2);
            let cell4 = newRow.insertCell(3);
            let cell5 = newRow.insertCell(4);
            let cell6 = newRow.insertCell(5);
            let cell7 = newRow.insertCell(6);

            // Fill cells with data from the selected row
            cell1.innerHTML = selectedRow.code;
            cell2.innerHTML = selectedRow.name;
            cell3.innerHTML = selectedRow.category;
            cell5.innerHTML = '<div class="input-group">' +
                                    '<div class="input-group-prepend">' +
                                        '<button class="btn btn-outline-warning decrease" type="button" onmousedown="decreaseQuantity(this)" onmouseup="stopDecrease()">-</button>' +
                                    '</div>' +
                                    '<input type="text" class="form-control quantity" name="quantity[]" value="1" data-product-id="'+selectedRow.id+'" readonly>' +
                                    '<div class="input-group-append">' +
                                        '<button class="btn btn-outline-success increase" type="button" onmousedown="increaseQuantity(this)" onmouseup="stopIncrease()">+</button>' +
                                    '</div>' +
                                '</div>';
            cell4.innerHTML = '<input type="text" class="form-control" name="price[]" id="price_' + selectedRow.id + '">\
                                <input type="hidden" class="form-control" name="product_id[]" value="' + selectedRow.id + '" readonly>';
            cell6.innerHTML = '<input type="text" class="form-control text-end subtotal" name="subtotal[]" id="subtotal_' + selectedRow.id + '" readonly>';
            cell7.innerHTML = '<button class="btn btn-sm btn-danger" onclick="removeFromCart(this, '+ selectedRow.id +')">Hapus</button>';

            // Add the product ID to the set
            addedProductIds.add(selectedRow.id);
        };

        let increaseInterval;
        // Function to increase quantity
        window.increaseQuantity = function (button) {
            let row = button.closest('tr');
            let input = row.querySelector('.quantity');
            let priceInput = row.querySelector('[id^="price_"]');

            if (!validatePrice(priceInput)) {
                return;
            }

            // Initial increase
            increaseQuantityOnce(input);

            // Set interval to repeatedly increase quantity
            increaseInterval = setInterval(function () {
                increaseQuantityOnce(input);
            }, 200); // Adjust the interval duration as needed
        };

        // Function to increase quantity once
        function increaseQuantityOnce(input) {
            input.value = parseInt(input.value) + 1;
            updateSubtotal(input);
            applyPpn();
        }

        // Function to stop increasing when the button is released
        window.stopIncrease = function () {
            clearInterval(increaseInterval);
        };

        let decreaseInterval;
        // Function to decrease quantity
        window.decreaseQuantity = function (button) {
            let row = button.closest('tr');
            let input = row.querySelector('.quantity');
            let priceInput = row.querySelector('[id^="price_"]');

            if (!validatePrice(priceInput)) {
                return;
            }

            // Initial decrease
            decreaseQuantityOnce(input);

            // Set interval to repeatedly decrease quantity
            decreaseInterval = setInterval(function () {
                decreaseQuantityOnce(input);
            }, 200); // Adjust the interval duration as needed
        };

        // Function to decrease quantity once
        function decreaseQuantityOnce(input) {
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateSubtotal(input);
                applyPpn();
            }
        }

        // Function to stop decreasing when the button is released
        window.stopDecrease = function () {
            clearInterval(decreaseInterval);
        };


        // Function to validate price
        function validatePrice(priceInput) {
            let price = priceInput.value.trim();

            if (!price || isNaN(parseFloat(price))) {
                // alert('Please enter a valid price before adjusting quantity.');
                swalInit.fire({
                    title: 'Gagal!',
                    html: 'Silahkan isi harga terlebih dahulu.',
                    type: 'error',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    allowOutsideClick: false
                });
                return false;
            }

            return true;
        }

        // Function to remove item from the cart
        window.removeFromCart = function (removeButton, row_id) {
            let row = removeButton.parentNode.parentNode;
            row.parentNode.removeChild(row);
            addedProductIds.delete(row_id);
            updateFooterTotal();
            applyPpn();
        };

        // Function to update subtotal based on quantity and price
        function updateSubtotal(input) {
            try {
                // Ensure the input is not undefined
                if (!input) {
                    console.error('Error: Input is undefined.');
                    return;
                }

                // Attempt to find the closest row using input.closest
                let row = input.closest('tr');

                // Check if the closest element is a TR or if it's null
                if (!row || !row.tagName || row.tagName.toLowerCase() !== 'tr') {
                    console.error('Error: Could not find the closest row for the input.');
                    return;
                }

                // Find price input
                let priceInput = row.querySelector('[id^="price_"]');
                if (!priceInput) {
                    console.error('Error: Could not find priceInput element.');
                    return;
                }

                // Find subtotal input
                let subtotalInput = row.querySelector('[id^="subtotal_"]');
                if (!subtotalInput) {
                    console.error('Error: Could not find subtotalInput element.');
                    return;
                }

                // Get the quantity value from the input
                let quantityValue = parseInt(input.value);

                // Get the price value from the price input
                let priceValue = parseFloat( removeThousandSeparator(priceInput.value) );

                // Calculate subtotal
                let subtotalValue = quantityValue * priceValue;

                // Set the calculated subtotal value
                subtotalInput.value = formatCurrencyIDR(subtotalValue);

                // Update the footer total after updating the subtotal
                updateFooterTotal();
            } catch (error) {
                console.error('Error in updateSubtotal:', error);
            }
        }

        function removeThousandSeparator(inputString) {
            return inputString.replace(/\./g, '');
        }

        // Function to update the footer total based on subtotal values
        function updateFooterTotal() {
            try {
                // Get all subtotal inputs
                let subtotalInputs = document.querySelectorAll('.subtotal');

                // Initialize total to zero
                let total = 0;

                // Loop through each subtotal input and sum up the values
                subtotalInputs.forEach((subtotalInput) => {
                    let subtotalValue = parseFloat(removeThousandSeparator(subtotalInput.value));
                    // Check if subtotalValue is a valid number
                    if (!isNaN(subtotalValue)) {
                        total += subtotalValue;
                    }
                });

                // Format the total with currency separators
                let formattedTotal = formatCurrencyIDR(total);

                // Update the content of the totalSumFooter element
                let totalSumFooter = document.getElementById('totalSumFooter');
                if (totalSumFooter) {
                    totalSumFooter.innerHTML = '<strong>'+formattedTotal+'</strong>';
                    headerTotal.value = formattedTotal;
                } else {
                    console.error('Error: Could not find the totalSumFooter element.');
                }
            } catch (error) {
                console.error('Error in updateFooterTotal:', error);
            }
        }

        // Function to format currency as IDR
        function formatCurrencyIDR(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).formatToParts(number)
                        .map(part => part.type === 'currency' ? '' : part.value)
                        .join('');
        }

        function load_product(){
            // Check if DataTable is already initialized
            if ($.fn.DataTable.isDataTable('#tableData')) {
                $('#tableData').DataTable().destroy();
            }

            productTable = $('#tableData').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                    searchPlaceholder: 'Ketik untuk mencari...',
                    lengthMenu: '<span class="me-3">Tampilkan:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
                },
                ajax: {
                    url: "{{ route('inventory.produk.index') }}",
                },
                serverSide: true,
                processing: true,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                    { data: 'code', name: 'code', orderable: false, searchable: true, sortable: false },
                    { data: 'name', name: 'name', orderable: false, searchable: true, sortable: false },
                    { data: 'category', name: 'category', orderable: false, searchable: true, sortable: false },
                    {
                        data: null,
                        class: 'text-center',
                        sortable: false,
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-purple btn-icon" onclick="addToCart(' + row.id + ')"><i class="ph-plus"></i></button>';
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
        }
    });


    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('inventory.purchasing.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, "{{ route('inventory.purchasing.index') }}");
            },
            error: function(e){
                sw_multi_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                // small_loader_close('form_data');
            }
        });
    }

</script>
@endsection