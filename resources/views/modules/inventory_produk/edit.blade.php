@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <a href="{{ route('inventory.produk.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-arrow-left"></i>
                            </span>
                            Batal
                        </a> 
                    </div>
                </div>

                <div class="card-body border-bottom border-light">
                    <form id="form_data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Nama</label>
                            <div class="col-lg-10">
                                <input type="hidden" name="id" id="id" value="{{ $produk->id }}" readonly>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $produk->name }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Kategori</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="category_id" id="category_id">
                                    <option value="">-- Pilih Kategori Produk --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($produk->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Jenis Inventory</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="inventory_type" id="inventory_type">
                                    <option value="">Pilih Jenis Inventory</option>
                                    <option value="sale" {{ ($produk->inventory_type == 'sale') ? 'selected' : '' }}>Dijual</option>
                                    <option value="loan" {{ ($produk->inventory_type == 'loan') ? 'selected' : '' }}>Disewa</option>
                                </select>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        $('.select').each(function(){
            $(this).select2();
        });
    });

    function save(){
        $.ajax({
            type: "PUT",
            url: "{{ route('inventory.produk.update', $produk->id) }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, "{{ route('inventory.produk.index') }}");
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