@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
                    <div class="ms-sm-auto my-sm-auto">
                        <a href="{{ route('tiket.data.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <label class="col-form-label col-lg-3">Kategori</label>
                            <div class="col-lg-9">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="category" id="category">
                                    <option value="">-- Kategori --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Harga</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="price" id="price" autocomplete="off" value="{{ $data->price }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-9 offset-3">
                                <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="save()" id="saveButton">
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

        <div class="col-xl-5">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-circle-wavy-warning"></i> Kategori</h6>
                </div>

                <div class="card-body border-bottom border-light">
                    
                    <form id="form_category">
                        @csrf
                        <input type="hidden" name="action" id="action" readonly>
                        <input type="hidden" name="id" id="id" readonly>
                        <div class="col-lg-12 mb-2">
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Tambah Kategori..." required autocomplete="off">
                                <button class="btn btn-purple" type="button" onclick="save_category()">Simpan</button>
                            </div>
                        </div>
                    </form>

                    <table class="table datatable-basic table-xs table-hover" id="tableCategory">
                        <thead>
                            <tr class="table-border-double bg-teal bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Kategori</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
<script>
    let tableCategory
    get_categories();
    $(document).ready(function() {
        $('.select').each(function(){
            $(this).select2();
        });

        tableCategory = $('#tableCategory').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('tiket.data.create_direct') }}",
            },
            serverSide: true,
            processing: true,
            searching: false,
            lengthChange: false,
            columns: [
                { data: 'DT_RowIndex', class: 'text-center', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                { data: 'name', name: 'name', orderable: true, searchable: true, sortable: false },
                { data: 'actions', className: 'text-center', name: 'actions', orderable: false, searchable: false, sortable: false },
            ],
            order: [[0, 'asc']],
            drawCallback: function (setting) {
                $('.tooltiped').tooltip({
                    "html": true,
                    trigger: 'hover',
                    placement: 'top',
                });
            },
        });
    });

    function get_categories(){
        $.ajax({
            url: "{{ route('tiket.data.categories') }}",
            type: "GET",
            beforeSend: function(){
                // small_loader_open(selector);
            },
            success: function(s){
                $('#form_data #category').html('<option value="">-- Kategori --</option>');
                s.forEach(data => {
                    let selected;
                    if(data.id == {{ $data->id }}){
                        selected = 'selected';
                    }

                    $('#form_data #category').append('<option value="'+ data.id +'" '+ selected +'>'+ data.name +'</option>');
                });
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }

    function edit_category(i){
        $.ajax({
            url: "{{ route('tiket.data.category.edit', ':id') }}".replace(':id', i),
            type: "GET",
            beforeSend: function(){
                // small_loader_open(selector);
            },
            success: function(s){
                $('#form_category #action').val('edit');
                $('#form_category #id').val(s.id);
                $('#form_category #name').val(s.name);
                $('#form_category #name').focus();
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }

    function save_category(){
        let xMethod;
        let xUrl;
        let xhr = null;

        if($('#form_category #action').val() === 'edit'){
            xMethod = 'edit';
            xUrl = "{{ route('tiket.data.update_category', ':id') }}".replace(':id', $('#form_category #id').val());
        }else{
            xMethod = 'save';
            xUrl = "{{ route('tiket.data.store_category') }}";
        }
        
        if(xMethod == 'edit'){
            xhr = $.ajax({
                type: "PUT",
                url: xUrl,
                data: $('#form_category').serialize(),
                success: function (s) {
                    reload_table(tableCategory);
                    get_categories();
                    sw_success(s);
                    $('#form_category')[0].reset();
                    $('#form_category #name').focus();
                },
                error: function(e){
                    sw_multi_error(e);
                },
                complete: function(){
                    xhr = null;
                }
            });
        }else if(xMethod === 'save'){
            if($('#form_category #name').val() == ''){
                swalInit.fire({
                    html: 'Silahkan berikan nama kategori',
                    type: 'error',
                    icon: 'error',
                    toast: true,
                    position: 'top',
                    timer: 3000,
                    showConfirmButton: false,
                });
                $('#form_category #name').focus();
            }else{
                xhr = $.ajax({
                    type: "POST",
                    url: "{{ route('tiket.data.store_category') }}",
                    data: $('#form_category').serialize(),
                    // beforeSend: function(){
                    //     small_loader_open('form_data');
                    // },
                    success: function (s) {
                        sw_success(s);
                        reload_table(tableCategory);
                        get_categories();
                        $('#form_category')[0].reset();
                    },
                    // error: function(e){
                    //     sw_multi_error(e);
                    //     small_loader_close('form_data');
                    // },
                    complete: function(){
                        // small_loader_close('form_data');
                        xhr = null;
                    }
                });
            }
        }
    }

    function hapus_category(i){
        sw_delete_validated(
            "{{ route('tiket.data.category.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('tiket.data.category.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableCategory",
            tableCategory
        );

        setTimeout(() => {
            get_categories();
        }, 5000);
    }

    function save(){
        $.ajax({
            type: "PUT",
            url: "{{ route('tiket.data.update_direct', $data->id) }}",
            data: $('#form_data').serialize(),
            beforeSend: function(){
                // $('.loader').show();
                // $('#saveButton').prop('disabled', true);
            },
            success: function (s) {
                sw_success(s);
                setTimeout(function() {
                    window.location.href = "{{ route('tiket.data.index') }}";
                }, 3000);
            },
            error: function(e){
                sw_multi_error(e);
            },
            complete: function(){
                // $('.loader').hide();
                // $('#saveButton').prop('disabled', false);
            }
        });
    }

</script>
@endsection