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
                        <a href="{{ route('wahana.kupon.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <label class="col-form-label col-lg-2">Kode</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="code" id="code" placeholder="Misalnya: #LiburanIED">
                                <code>Tidak menggunakan spasi atau karakter selain # (HASH)</code>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Deskripsi</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control upps" name="description" id="description">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Tgl. Berlaku</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control daterange-basic" name="periode" id="periode"> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Berlaku Untuk Reservasi</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="valid_for" id="valid_for">
                                    <option value="">-- Pilih Jenis Reservasi --</option>
                                    <option value="online">Online</option>
                                    <option value="onsite">Onsite</option>
                                    <option value="both">Online & Onsite</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Berlaku Untuk Wahana</label>
                            <div class="col-lg-10">
                                <select class="form-control multiselect" name="wahana[]" id="wahana" multiple="multiple" data-include-select-all-option="true">
                                    @foreach ($wahanas as $wahana)
                                        <option value="{{ $wahana->id }}">{{ ucwords(strtolower($wahana->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Jenis</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="discount_type" id="discount_type">
                                    <option value="">-- Pilih Jenis Diskon --</option>
                                    <option value="persentase">Persentase</option>
                                    <option value="nominal">Nominal</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Diskon</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="discount" id="discount">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Set Quantity</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="quantity" id="quantity">
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

        $('.multiselect').multiselect();

        $('.daterange-basic').daterangepicker({
            parentEl: '.content-inner',
            locale: {
                format: 'YYYY-MM-DD', // Set the date format
                cancelLabel: 'Clear',
            },
        });

        $('#code').on('input', function() {
            var inputValue = $(this).val();

            // Define a regular expression for allowed characters
            var allowedRegex = /^[a-zA-Z0-9#]*$/;

            if (!allowedRegex.test(inputValue)) {
                // If input contains disallowed characters, remove them
                $(this).val(inputValue.replace(/[^a-zA-Z0-9#]/g, ''));
            }
        });
    });

    function remove_facility(id){
        $('#facility_'+id).remove();
    }

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('wahana.kupon.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, "{{ route('wahana.kupon.index') }}");
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