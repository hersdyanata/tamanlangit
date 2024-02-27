@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>
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
                        <a href="{{ route('wahana.paket.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <label class="col-form-label col-lg-2">Nama Wahana</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Deskripsi</label>
                            <div class="col-lg-10">
                                <div class="mb-3">
                                    <textarea name="description" class="form-control" id="ckeditor_classic_prefilled"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Max. Jumlah Orang</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="max_person" id="max_person">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Luas Kamar/Tenda (m2)</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="room_wide" id="room_wide">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Harga /malam</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="price" id="price">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Jumlah Kamar/Tenda</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="room_available" id="room_available">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Kamar/Tenda Bisa Dipilih?</label>
                            <div class="col-lg-10">
                                <label class="form-check">
                                    <input type="checkbox" name="user_choose_room" class="form-check-input form-check-input-primary">
                                    <span class="form-check-label"><code>Jika dipilih maka pengunjung dapat memilih kamar/tenda di halaman reservasi</code></span>
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Nama Unik Kamar/Tenda</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="room_name" id="room_name">
                            </div>
                        </div>

                        <div class="offset-md-2 col-lg-10">
                            <div class="fw-bold border-bottom pb-2 mb-3">Fasilitas</div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-md-2 col-lg-4">
                                <button class="btn btn-indigo" type="button" id="btn_facility">
                                    <i class="icon-plus2"></i>
                                </button>
                            </div>
                        </div>

                        <div id="div_facility"></div>
                        
                        <div class="offset-md-2 col-lg-10"><hr></div>

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

        ClassicEditor.create(
            document.querySelector('#ckeditor_classic_prefilled'), {
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
                    ],
                },
                removePlugins: ['ImageUpload', 'ImageToolbar', 'EasyImage'],
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                document.querySelector('#ckeditor_classic_prefilled').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });

        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });

        let count = 0;
        let btn_facility = document.getElementById("btn_facility");
        btn_facility.onclick = function() {
            count++;
            $('#div_facility').append('<div class="row mb-3" id="facility_'+count+'"><div class="offset-md-2 col-lg-4"><input type="text" class="form-control nama_fasilitas" name="fasilitas[]"></div><div class="col-lg-2"><button class="btn btn-danger" type="button" onclick="remove_facility('+count+')"><i class="icon-cross2"></i></button></div></div>');
        }
    });

    function remove_facility(id){
        $('#facility_'+id).remove();
    }

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('wahana.paket.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                // console.log(s);
                sw_success_redirect(s, "{{ route('wahana.paket.index') }}");
            },
            error: function(e){
                // sw_multi_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                // small_loader_close('form_data');
            }
        });
    }

</script>
@endsection