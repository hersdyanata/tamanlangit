@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
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
                        <a href="{{ route('wahana.eo.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                        <input type="hidden" readonly name="id" id="id" value="{{ $data->id }}">
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Nama</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Jenis Komisi</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="commission_type" id="commission_type">
                                    <option value="">Pilih Jenis Komisi</option>
                                    <option value="persentase" {{ ($data->commission_type == 'persentase' ? 'selected' : '') }}>Persentase</option>
                                    <option value="nominal" {{ ($data->commission_type == 'nominal' ? 'selected' : '') }}>Nominal</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Komisi</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="commission" id="commission" value="{{ $data->commission }}">
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
        $('#commission_type').select2();
    });

    function save(){
        $.ajax({
            type: "PUT",
            url: "{{ route('wahana.eo.update', $data->id) }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, "{{ route('wahana.eo.index') }}");
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