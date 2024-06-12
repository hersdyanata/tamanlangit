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
                </div>

                <div class="card-body border-bottom border-light">
                    <form id="form_data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $cms->id }}" readonly>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Judul</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="title" id="title" value="{{ $cms->title }}">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-form-label col-lg-2">Konten</label>
                            <div class="col-lg-10">
                                <div class="mb-3">
                                    <textarea name="content" class="form-control" id="ckeditor_classic_prefilled">
                                        {{ $cms->content }}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Keywords</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="keywords" id="keywords" value="{{ $cms->keywords }}">
                            </div>
                        </div>

                        <div class="row">
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
        const editor = ClassicEditor.create(
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
            // editor.ui.view.editable.element.style.height = '600px';

            editor.model.document.on('change:data', () => {
                document.querySelector('#ckeditor_classic_prefilled').value = editor.getData();
                // editor.ui.view.editable.element.style.height = '600px';
            });
        })
        .catch(error => {
            console.error(error);
        });

        // const editorEditable = editor.ui.view.editable;
        // editorEditable.style.height = '500px';

    });

    function save(){
        // if($('#keywords').val() === '' || $('#ckeditor_classic_prefilled').val() === '' || $('#title').val() === ''){
        //     sw_error("'dt':{'msg_body':'Silahkan lengkapi form'}");
        // }
        $.ajax({
            type: "PUT",
            url: "{{ route('cms.update', $cms->id) }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                sw_success_redirect(s, location.reload());
                // sw_success(s);
            },
            error: function(e){
                sw_single_error(e);
                // small_loader_close('form_data');
            },
            complete: function(){
                // small_loader_close('form_data');
            }
        });
    }
</script>
@endsection