@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>
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
                        <a href="{{ route('cms.artikel.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <label class="col-form-label col-lg-2">Kategori</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="category_id" id="category_id">
                                    <option value="">-- Pilih Kategori Artikel --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Konten</label>
                            <div class="col-lg-10">
                                <textarea name="content" class="form-control" id="ckeditor_classic_prefilled"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Status</label>
                            <div class="col-lg-10">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="status" id="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="draft">Draft</option>
                                    <option value="published">Publish</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Tags</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control mb-1" name="tags" id="tags">
                                <span class="text-muted">Dipisahkan dengan <code>koma (,)</code> dan tanpa spasi</span>
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
    });

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('cms.artikel.store') }}",
            data: $('#form_data').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                // console.log(s);
                sw_success_redirect(s, "{{ route('cms.artikel.index') }}");
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