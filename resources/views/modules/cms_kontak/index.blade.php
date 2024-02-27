@extends('layouts.app')
@section('page_resources')

@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<form id="form_data">
    @csrf
    <div class="d-flex justify-content-between bd-highlight mb-3">
        <h5 class="mb-sm-auto p-2"><i class="ph-note-pencil"></i> {{ $title }}</h5>
        
        <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()">
            <span class="btn-labeled-icon bg-black bg-opacity-20">
                <i class="ph-floppy-disk"></i>
            </span>
            Simpan
        </button>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Social Media</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Facebook URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-facebook-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Profile Facebook..." name="facebook_url" id="facebook_url" value="{{ $kontak->facebook_url }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Instagram URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-instagram-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Profile Instagram..." name="instagram_url" id="instagram_url" value="{{ $kontak->instagram_url }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Youtube URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-youtube-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Channel Youtube..." name="youtube_url" id="youtube_url" value="{{ $kontak->youtube_url }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Twitter URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-twitter-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Profile Twitter..." name="youtube_url" id="youtube_url" value="{{ $kontak->youtube_url }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Pinterest URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-pinterest-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Profile Pinterest..." name="pinterest_url" id="pinterest_url" value="{{ $kontak->pinterest_url }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">TikTok URL</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-tiktok-logo"></i></span>
                                <input type="text" class="form-control" placeholder="URL Profile TikTok..." name="tiktok_url" id="tiktok_url" value="{{ $kontak->tiktok_url }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Direct</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Nomor Telepon</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-phone"></i></span>
                                <input type="text" class="form-control" placeholder="Nomor Telepon..." name="phone_number" id="phone_number" value="{{ $kontak->phone_number }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Nomor Handphone (WA)</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-whatsapp-logo"></i></span>
                                <input type="text" class="form-control" placeholder="Nomor Handphone Yang Terhubung Ke Whatsapp..." name="mobile_number" id="mobile_number" value="{{ $kontak->mobile_number }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-4">Email</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ph-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="Email..." name="email" id="email" value="{{ $kontak->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('page_js')
<script>
    $(document).ready(function() {

    });

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('cms.kontak.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, location.reload());
                // sw_success(s);
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