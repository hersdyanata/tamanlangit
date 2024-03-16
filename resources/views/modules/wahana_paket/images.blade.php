@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> Upload {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <a href="{{ route('wahana.paket.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                            <span class="btn-labeled-icon bg-black bg-opacity-20">
                                <i class="ph-arrow-left"></i>
                            </span>
                            Kembali
                        </a> 
                    </div>
                </div>

                <div class="card-body border-bottom border-light">
                    <p class="mb-3">
                        - Pastikan format file <code>jpg, jpeg, png</code><br>
                        - Ukuran tidak lebih dari <code>2MB</code><br>
                        - Anda dapat melakukan upload sekaligus maksimal <code>5 File</code><br>
                        - Gambar yang lebar lebih bagus
                    </p>
                    <p class="fw-semibold">Pilih beberapa file sekaligus:</p>
                    <form enctype="multipart/form-data" class="dropzone" id="dropzone_remove">
                        @csrf
                        <input type="hidden" class="form-control" name="id" id="id" value="{{ $wahana->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-12">
            <div class="mb-3">
                <h6 class="mb-0">{{ $title }}</h6>
                <span class="text-muted">File yang sudah ter-upload.</span>
            </div>

            <div class="row" id="thumbnails"></div>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {
        load_images();
        let dropzoneRemove = new Dropzone("#dropzone_remove", {
            url: "{{ route('wahana.paket.images.upload', $wahana->id) }}",
            paramName: "file", // The name that will be used to transfer the file
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize: 2, // MB
            maxFile: 5,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            // acceptedFiles: '.jpeg,.jpg,.png',
            init: function() {
                this.on("success", function (file, response) {
                    // Handle success
                    console.log(response);
                    load_images();
                });
                this.on("error", function (file, response) {
                    // Handle error
                    console.log(response);
                });
            }
        });
    });

    function load_images(){
        $.ajax({
            type: "GET",
            url: "{{ route('wahana.paket.images.load', $wahana->id) }}",
            data: $('#form_data').serialize(),
            success: function (s) {
                // console.log(s);
                $('#thumbnails').html(s.images);
            },
            complete: function(){
                const lightbox = GLightbox({
                    selector: '[data-bs-popup="lightbox"]',
                    loop: true,
                    svg: {
                        next: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
                        prev: document.dir == "rtl" ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
                    }
                });

                $('.tooltiped').tooltip({
                    "html": true,
                    trigger: 'hover',
                    placement: 'top',
                });
            }
            // error: function(e){
            //     sw_multi_error(e);
            // },
        });
    }

    function markAsMap(wahanaId, imageId){
        $.ajax({
            type: "PUT",
            url: "{{ route('wahana.paket.image.map', ':id') }}".replace(':id', imageId),
            data: {
                _token: "{{ csrf_token() }}",
                wahana_id: wahanaId,
                id: imageId
            },
            success: function (s) {
                sw_success(s);
            },
            complete: function(){
                load_images();
            }
            // error: function(e){
            //     sw_multi_error(e);
            // },
        });
    }

    function preaction(i){
        $.ajax({
            url: "{{ route('wahana.paket.image.show', ':id') }}".replace(':id', i),
            type: "GET",
            data: {
                _token : "{{ csrf_token() }}",
                id : i
            },
            beforeSend: function(){
                // small_loader_open(selector);
            },
            success: function(s){
                if(s.permission === 'F'){
                    swalInit.fire({
                        title: s.msg_title,
                        html: s.msg_body,
                        type: 'error',
                        icon: 'error',
                        confirmButtonClass: 'btn btn-danger',
                        allowOutsideClick: false
                    });
                    // small_loader_close(selector);
                }else{
                    swalInit.fire({
                        title: s.msg_title,
                        html: s.msg_body,
                        type: 'warning',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Iya, tolong hapus!',
                        cancelButtonText: 'Tidak, tolong batalkan!',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        allowOutsideClick: false
                    }).then(function(result) {
                        if(result.value) {
        
                            $.ajax({
                                url: "{{ route('wahana.paket.image.destroy', ':id') }}".replace(':id', i),
                                type: "DELETE",
                                data: {
                                    _token : "{{ csrf_token() }}",
                                    id : s.id
                                },
                                beforeSend: function(){
                                    // small_loader_open(selector);
                                },
                                success: function(d){
                                    swalInit.fire({
                                        title: d.msg_title,
                                        html: d.msg_body,
                                        type: 'success',
                                        icon: 'success',
                                        confirmButtonClass: 'btn btn-success',
                                    });
                                    load_images();
                                },
                                complete: function(){
                                    // small_loader_close(selector);
                                }
                            });
                        }
                        else if(result.dismiss === swalInit.DismissReason.cancel) {
                            swalInit.fire({
                                title: 'Dibatalkan',
                                html: 'Data Anda aman 😉',
                                type: 'success',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-success',
                                allowOutsideClick: false
                            });
                            // small_loader_close(selector);
                        }
                    });
                }
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }
</script>
@endsection