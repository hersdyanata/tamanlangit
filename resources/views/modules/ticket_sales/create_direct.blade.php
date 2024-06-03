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
                        <a href="{{ route('tiket.sales.presale.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                    <div class="row p-4">
                        @foreach ($tickets as $t)
                        <div class="row col-lg-12 mb-3">
                            <div class="col-lg-4">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="check_ticket[]" class="form-check-input toggleTicket" id="toggle_ticket_{{ $t->id }}" data-id="{{ $t->id }}" data-price="{{ $t->price }}">
                                    <label class="form-check-label h6" for="toggle_ticket_{{ $t->id }}">
                                        {{ $t->category_->name }} 
                                        ( {{ number_format($t->price) }} )
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <input class="ticket_id" type="hidden" name="ticket_id[]" id="ticket_id_{{ $t->id }}" readonly>
                                <input class="price" type="hidden" name="price[]" id="price_{{ $t->id }}" readonly>
                                <input type="number" class="form-control quantity" name="quantity[]" id="quantity_{{ $t->id }}" autocomplete="off" min="1" placeholder="Quantity...">
                            </div>

                            <div class="col-lg-4">
                                <input type="hidden" class="form-control subtotal" name="subtotal[]" id="subtotal_{{ $t->id }}" readonly>
                                <label class="h6">
                                    Subtotal: <span class="cl_display_subtotal" id="display_subtotal_{{ $t->id }}"></span>
                                </label>
                            </div>
                        </div>
                        @endforeach

                        <input type="hidden" name="total_billing" id="total_billing" readonly>
                        
                        <div class="row p-2 mb-2">
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
                            <div class="row col-lg-6 mt-2 loader" id="loader">
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
                <h2 class="mb-4" id="totalBill"></h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    $('#loader').hide();
    $('.ticket_id').prop('disabled', true);
    $('.price').prop('disabled', true);
    $('.quantity').prop('disabled', true);
    $('.subtotal').prop('disabled', true);
    let displayTotalBill = document.getElementById('totalBill');
    let inputTotalBill = document.getElementById('total_billing');
    let toggleTickets = document.getElementsByClassName('toggleTicket');
    let clSubtotal = document.getElementsByClassName('subtotal');

    for (let i = 0; i < toggleTickets.length; i++) {
        toggleTickets[i].addEventListener('change', function() {
            let id = this.getAttribute('data-id');
            let price = this.getAttribute('data-price');

            let inputTicketId = document.getElementById('ticket_id_'+id);
            let inputQuantity = document.getElementById('quantity_'+id);
            let inputPrice = document.getElementById('price_'+id);
            let inputSubtotal = document.getElementById('subtotal_'+id);
            let displaySubtotal = document.getElementById('display_subtotal_'+id);

            if (this.checked) {
                inputTicketId.disabled = false;
                inputPrice.disabled = false;
                inputQuantity.disabled = false;
                inputSubtotal.disabled = false;

                inputTicketId.value = id;
                inputQuantity.value = 1;
                inputPrice.value = price;
                let subtotal = price * inputQuantity.value;

                inputSubtotal.value = subtotal;
                displaySubtotal.innerHTML = formatCurrency(subtotal);
                inputQuantity.focus();

                calculateBilling();
            } else {
                inputTicketId.value = null;
                inputQuantity.value = null;
                inputPrice.value = null;
                inputSubtotal.value = null;
                displaySubtotal.innerHTML = null;

                inputTicketId.disabled = true;
                inputPrice.disabled = true;
                inputQuantity.disabled = true;
                inputSubtotal.disabled = true;
                calculateBilling();
            }

            inputQuantity.addEventListener('change', function() {
                inputSubtotal.value = this.value * price;
                displaySubtotal.innerHTML = formatCurrency(this.value * price);
                calculateBilling();
            });
        });
    }

    function calculateBilling(){
        let total = 0;
        for (let i = 0; i < clSubtotal.length; i++) {
            if(!clSubtotal[i].disabled){
                total += parseInt(clSubtotal[i].value);
            }
        }

        displayTotalBill.innerHTML = formatCurrency(total);
        inputTotalBill.value = total;
    }

    function save(){
        if(inputTotalBill.value == null || inputTotalBill.value == '' || inputTotalBill.value == 0){
            sw_error({'msg_body': 'Tidak ada tiket yang dipilih'});
            return;
        }
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.sales.direct.store') }}",
            data: $('#form_data').serialize(),
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (s) {
                sw_success(s);
                openReceipt(s.ticket);
            },
            error: function(e){
                sw_multi_error(e);
                $('#loader').hide();
            },
            complete: function(){
                $('#loader').hide();
                $('#form_data')[0].reset();
                
                $('.ticket_id').prop('disabled', true);
                $('.price').prop('disabled', true);
                $('.quantity').prop('disabled', true);
                $('.subtotal').prop('disabled', true);

                $('.cl_display_subtotal').html('');
                displayTotalBill.innerHTML = null;
            }
        });
    }

    function openReceipt(i){
        var inchesToPixels = 96;
        var widthInInches = 5;
        var heightInInches = 4;

        var widthInPixels = widthInInches * inchesToPixels;
        var heightInPixels = heightInInches * inchesToPixels;
        var xUrl = "{{ route('tiket.sales.direct.receipt', ':id') }}".replace(':id', i);

        // Open a new window with the specified size and navigate to a URL
        var newWindow = window.open(xUrl, '_blank', 'width=' + widthInPixels + ', height=' + heightInPixels, 'resizable=no');

        // Optionally, you can set content or perform other actions in the new window
        // newWindow.document.write('<h1>Hello, New Window!</h1>');
    }
</script>
@endsection