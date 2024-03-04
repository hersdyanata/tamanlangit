@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col col-lg-8">
        <div class="card">
            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
                <div class="ms-sm-auto my-sm-auto">
                    @can('cms-blog-kategori-create')
                        <a href="{{ route('tiket.terjual.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                            <span class="btn-labeled-icon bg-black bg-opacity-20 text-white">
                                <i class="ph-arrow-left"></i>
                            </span>
                            Kembali
                        </a> 
                    @endcan
                </div>
            </div>
        
            <div class="card-body">
                <form id="form_data">
                    @csrf
                    <div class="row">
                        <div class="row mb-2">
                            <label class="col-form-label col-lg-2">Harga</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="price" id="price" autocomplete="off" value="{{ number_format($price) }}" readonly>
                            </div>
                        </div>
            
                        <div class="row mb-2">
                            <label class="col-form-label col-lg-2">Quantity</label>
                            <div class="col-lg-6">
                                <input type="hidden" class="form-control" name="category" id="category" value="{{ $category }}" readonly>
                                <input type="number" class="form-control" name="quantity" id="quantity" autocomplete="off" value="1" min="1">
                            </div>
                        </div>
            
                        <div class="row mb-2">
                            <label class="col-form-label col-lg-2"></label>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()" id="saveButton">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-floppy-disk"></i>
                                    </span>
                                    Simpan
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="row col-lg-6 offset-2 mt-2 loader" id="loader">
                                <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col col-lg-4">
        <div class="card">
            <div class="card-body text-center border border-success rounded">
                <i class="ph-money ph-4x text-success mb-1 mt-1"></i>
                <h4 class="mb-1">TOTAL TAGIHAN</h4>
                <h2 class="mb-4" id="subtotal"></h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('#loader').hide();

    let inputPrice = document.getElementById('price');
    let inputQuantity = document.getElementById('quantity');
    let btnSave = document.getElementById('saveButton');
    let displaySubtotal = document.getElementById('subtotal');
    let total = 0;
    inputQuantity.focus();
    // btnSave.disabled = true;

    calculate();
    inputQuantity.addEventListener('keydown', function (event) {
        calculate();
    });

    inputQuantity.addEventListener('keyup', function (event) {
        calculate();
    });

    inputQuantity.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            btnSave.focus();
        }
    });

    function calculate(){
        total = parseInt(removeComaSeparator(inputPrice.value)) * parseInt(inputQuantity.value);
        displaySubtotal.innerHTML = formatCurrency(total);
    }

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.terjual.store_direct') }}",
            data: $('#form_data').serialize(),
            beforeSend: function(){
                $('#loader').show();
                // btnSave.disabled = true;
            },
            success: function (s) {
                sw_success(s);
                if (s.tickets && s.tickets.length > 0) {
                    for (let i = 0; i < s.tickets.length; i++) {
                        openReceipt(s.tickets[i]);
                    }
                }
            },
            error: function(e){
                sw_multi_error(e);
            },
            complete: function(){
                $('#loader').hide();
                inputQuantity.value = 1;
                calculate();
                inputQuantity.focus();
                // btnSave.disabled = false;
            }
        });
    }

    function openReceipt(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 2.5;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('tiket.terjual.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }
</script>
@endsection