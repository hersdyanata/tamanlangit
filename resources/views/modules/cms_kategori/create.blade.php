@extends('layouts.app')
@section('page_resources')
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
                        <a href="{{ route('inventory.kategori-produk.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <label class="col-form-label col-lg-2">Judul</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="title" id="title">
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
    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('cms.kategori-artikel.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, "{{ route('cms.kategori-artikel.index') }}");
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