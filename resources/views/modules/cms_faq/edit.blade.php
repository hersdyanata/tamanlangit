@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
            <div class="ms-sm-auto my-sm-auto">
                <a href="{{ route('cms.faq.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-arrow-left"></i>
                    </span>
                    Batal
                </a> 
            </div>
        </div>

        <div class="card-body">
            <form id="form_data" class="form-inline">
                @csrf
                <div class="mb-4">
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Pertanyaan</label>
                        <div class="col-lg-6">
                            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Jawaban</label>
                        <div class="col-lg-6">
                            <textarea rows="10" cols="3" class="form-control" placeholder="Berikan jawaban yang terperinci disini" name="answer" id="ckeditor_classic_prefilled">{{ $faq->answer }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="offset-lg-2 col-lg-6">
                            <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()">
                                <span class="btn-labeled-icon bg-black bg-opacity-20">
                                    <i class="ph-floppy-disk"></i>
                                </span>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
            editor.model.document.on('change:data', () => {
                document.querySelector('#ckeditor_classic_prefilled').value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
    });

    function save(){
        $.ajax({
            type: "PUT",
            url: "{{ route('cms.faq.update', $faq->id) }}",
            data: $('#form_data').serialize(),
            success: function (s) {
                sw_success_redirect(s, "{{ route('cms.faq.index') }}");
            },
            error: function(e){
                sw_multi_error(e);
            },
        });
    }
</script>
@endsection