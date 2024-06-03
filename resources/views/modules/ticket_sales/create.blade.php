@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<div class="card">
    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
        <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
        <div class="ms-sm-auto my-sm-auto">
            <a href="{{ route('tiket.sales.presale.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                <span class="btn-labeled-icon bg-black bg-opacity-20 text-white">
                    <i class="ph-arrow-left"></i>
                </span>
                Kembali
            </a>
        </div>
    </div>

    <div class="card-body">
        {{-- <div class="row mb-2">
            <div class="col-lg-5">
                <select class="form-control select" data-minimum-results-for-search="Infinity" name="flag" id="flag">
                    <option value="kunjungan">Input Yang Tidak Terjual</option>
                    <option value="parkir">Input Yang Terjual</option>
                </select>
            </div>
        </div> --}}

        <div class="row mb-2">
            <div class="col-lg-5">
                <input type="text" class="form-control setToUpper" name="batch_number" id="batch_number" placeholder="Masukkan Nomor Batch. Contoh: 240227ER lalu tekan enter untuk memuat data..." autofocus autocomplete="off"> 
            </div>

            <div class="col-lg-4 mt-2" id="loader">
                <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
            </div>
        </div>

        <div class="col-lg-5 mb-3">
            <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()" id="saveButton">
                <span class="btn-labeled-icon bg-black bg-opacity-20">
                    <i class="ph-floppy-disk"></i>
                </span>
                Simpan
            </button>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <span class="form-check-label fw-bold text-warning">TIKET PRESALE</span>
                    <input type="hidden" name="category_id" id="category_id" readonly>
            
                    <table class="table mt-2 table-bordered datatable-basic table-xs table-hover">
                        <tr>
                            <td width="30%">Kode</td>
                            <td id="id" hidden></td>
                            <td id="code"></td>
                        </tr>
                        <tr>
                            <td width="30%">Deskripsi</td>
                            <td id="description"></td>
                        </tr>
                        <tr>
                            <td width="30%">Kategori</td>
                            <td id="category"></td>
                        </tr>
                        <tr>
                            <td width="30%">Quantity Nomor Seri</td>
                            <td id="quantity"></td>
                        </tr>
                        <tr>
                            <td width="30%">Harga</td>
                            <td id="price"></td>
                        </tr>
                        <tr>
                            <td width="30%">Status</td>
                            <td id="status"></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-lg-6">
                <span class="form-check-label fw-bold text-warning">TIKET TIDAK TERJUAL</span>

                <input type="hidden" name="sold_out" id="sold_out" value="false" readonly>
                <div class="mt-2 mb-2 form-check form-check-inline form-switch">
                    <input type="checkbox" class="form-check-input" id="sold_out_toggle">
                    <label class="form-check-label" for="sold_out_toggle" id="sold_out_toggle"> Sold Out</label>
                </div>
            
                <input type="text" class="mt-2 form-control setToUpper" name="serial_number" id="serial_number" placeholder="Masukkan nomor seri yang tidak terjual..." autofocus autocomplete="off"> 
                <table class="table mt-2 table-bordered datatable-basic table-xs table-hover">
                    <thead>
                        <tr class="table-border-double bg-teal bg-opacity-20">
                            <th class="text-center" width="10%">#</th>
                            <th>Nomor Seri</th>
                            <th class="text-center" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableSerial"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('#loader').hide();
    $('.select').each(function(){
        $(this).select2();
    });

    $('.setToUpper').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });

    let inputBatchNumber = document.getElementById('batch_number');
    let inputSerialNumber = document.getElementById('serial_number');
    let displayId = document.getElementById('id');
    let displayCode = document.getElementById('code');
    let displayDescription = document.getElementById('description');
    let displayCategory = document.getElementById('category');
    let inputCategoryId = document.getElementById('category_id');
    let displayQuantity = document.getElementById('quantity');
    let displayPrice = document.getElementById('price');
    let displayStatus = document.getElementById('status');
    let tableSerial = document.getElementById('tableSerial');
    let btnSave = document.getElementById('saveButton');
    let soldOutToggle = document.getElementById('sold_out_toggle');
    let soldOut = document.getElementById('sold_out');

    btnSave.disabled = true;
    soldOutToggle.disabled = true;

    let counter = 1;
    let serialNumbers = [];

    let arrSerials = null;
    inputSerialNumber.disabled = true;

    inputBatchNumber.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (this.value !== '') {
                getData(this.value);
            }
        }
    });

    inputSerialNumber.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (this.value !== '') {
                if (isSerialNumberValid(this.value, arrSerials) && !isSerialNumberExists(this.value)) {
                    appendTr(this.value);
                    this.value = '';
                } else {
                    if (!isSerialNumberValid(this.value, arrSerials)) {
                        sw_error({'msg_body': 'Nomor seri tidak ditemukan!'});
                        this.value = '';
                    } else if (isSerialNumberExists(this.value)) {
                        sw_error({'msg_body': 'Nomor seri sudah masuk ke daftar tiket tidak terjual!'});
                        this.value = '';
                    }
                }
            }
        }
    });

    soldOutToggle.addEventListener('change', function(){
        if (this.checked) {
            btnSave.disabled = false;
            inputSerialNumber.disabled = true;
            soldOut.value = true;
            tableSerial.innerHTML = '';
            let serialNumbers = [];
        } else {
            btnSave.disabled = true;
            inputSerialNumber.disabled = false;
            soldOut.value = false;
        }
    });

    function isSerialNumberValid(serialNumber, arrSerials) {
        return arrSerials.some(item => item.serial_number === serialNumber);
    }

    function isSerialNumberExists(serialNumber) {
        let rows = tableSerial.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            if (cells.length > 1 && cells[1].textContent === serialNumber) {
                return true;
            }
        }
        return false;
    }

    function appendTr(serialNumber) {
        // Create a new row
        let newRow = document.createElement('tr');

        // Add 'text-center' class to specific cells
        let cellNumber = document.createElement('td');
        cellNumber.classList.add('text-center');
        cellNumber.textContent = counter++;

        let cellSerialNumber = document.createElement('td');
        cellSerialNumber.textContent = serialNumber;

        let cellAction = document.createElement('td');
        let removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-sm', 'btn-danger', 'text-center');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function () {
            counter--;
            tableSerial.removeChild(newRow);
            inputSerialNumber.focus();
            serialNumbers = serialNumbers.filter(item => item !== serialNumber);

            if(serialNumbers.length < 1){
                btnSave.disabled = true;
            }
        });

        cellAction.appendChild(removeButton);
        newRow.appendChild(cellNumber);
        newRow.appendChild(cellSerialNumber);
        newRow.appendChild(cellAction);

        tableSerial.appendChild(newRow);

        swalInit.fire({
            html: 'Nomor seri sudah ' + serialNumber + ' telah ditambahkan.',
            type: 'success',
            icon: 'success',
            toast: true,
            position: 'center-right',
            timer: 2000,
            showConfirmButton: false,
        });

        serialNumbers.push(serialNumber);
        btnSave.disabled = false;
    }

    function getData(ticketNumber){
        $.ajax({
            type: "GET",
            url: "{{ route('tiket.sales.presale.get_batch', ':id') }}".replace(':id', ticketNumber),
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                arrSerials = null;
                if(s.isFound == true){
                    sw_success(s);
                    displayId.textContent = s.data.id;
                    displayCode.textContent = '#' + s.data.code;
                    displayDescription.textContent = s.data.description;
                    displayCategory.textContent = s.data.category.name;
                    displayQuantity.textContent = new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(s.data.quantity);
                    displayPrice.textContent = new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(s.data.price);
                    displayStatus.textContent = s.data.status;
                    inputCategoryId.value = s.data.category_id;
                    inputSerialNumber.disabled = false;
                    soldOutToggle.disabled = false;
                    inputSerialNumber.focus();

                    arrSerials = s.data.serials;
                }else{
                    sw_error(s);
                    displayId.textContent = null;
                    displayCode.textContent = null;
                    displayDescription.textContent = null;
                    displayCategory.textContent = null;
                    displayQuantity.textContent = null;
                    displayPrice.textContent = null;
                    displayStatus.textContent = null;
                    inputSerialNumber.disabled = true;

                    inputBatchNumber.focus();
                }
                
            },
            complete: function(){
                $('#loader').hide();
                inputBatchNumber.value = null;
            }
        });
    }

    function save(){
        console.log(soldOutToggle.value);
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.sales.presale.store') }}",
            data: {
                _token: "{{ csrf_token() }}",
                ref_id: displayId.textContent,
                sold_out: soldOut.value,
                category_id: inputCategoryId.value,
                price: displayPrice.textContent,
                data: {
                    serials: JSON.stringify(serialNumbers)
                }
            },
            beforeSend: function(){
                $('#loader').show();
                btnSave.disabled = true;
            },
            success: function (s) {
                sw_success(s);
                setTimeout(function() {
                    window.location.href = "{{ route('tiket.sales.presale.index') }}";
                }, 3000);
            },
            error: function(e){
                sw_multi_error(e);
            },
            complete: function(){
                $('#loader').hide();
                btnSave.disabled = false;
            }
        });
    }

</script>
@endsection