@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime.js') }}"></script>
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
                                <input type="text" class="form-control" name="name" id="name" value="{{ $wahana->name }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Deskripsi</label>
                            <div class="col-lg-10">
                                <div class="mb-3">
                                    <textarea name="description" class="form-control" id="ckeditor_classic_prefilled">{{ $wahana->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Max. Jumlah Orang</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="max_person" id="max_person" value="{{ $wahana->max_person }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Luas Kamar/Tenda (m2)</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="room_wide" id="room_wide" value="{{ $wahana->room_wide }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Harga /malam</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="price" id="price" value="{{ $wahana->price }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Jumlah Kamar/Tenda</label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="room_available" id="room_available" value="{{ $wahana->room_available }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Kamar/Tenda Bisa Dipilih?</label>
                            <div class="col-lg-10">
                                <label class="form-check">
                                    <input type="checkbox" name="user_choose_room" class="form-check-input form-check-input-primary" {{ ($wahana->user_choose_room == 'Y') ? 'checked' : '' }}>
                                    <span class="form-check-label"><code>Jika dipilih maka pengunjung dapat memilih kamar/tenda di halaman reservasi</code></span>
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2">Nama Unik Kamar/Tenda</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="room_name" id="room_name" value="{{ $wahana->room_name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"></label>
                            <div class="col-lg-10">
                                <button type="button" class="btn btn-success btn-labeled btn-labeled-start" onclick="saveEdit()">
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

    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-gear"></i> Pengaturan Kamar/Tenda Lebih Lanjut</h6>
                </div>

                <div class="card-body border-bottom border-light">
                    <div class="col-lg-12 mb-1">
                        <form id="form_rooms">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="wahana_id" id="wahana_id" value="{{ $wahana->id }}" readonly>
                                <input type="hidden" name="room_name" id="room_name" value="{{ $wahana->room_name }}" readonly>
                                <input type="number" name="new_rooms" id="new_rooms" class="form-control" placeholder="Berapa kamar/tenda baru yang akan ditambah...?" required>
                                <button class="btn btn-purple" type="button" onclick="saveRooms()">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                    <table class="table datatable-basic table-xs table-hover" id="tableRooms">
                        <thead>
                            <tr class="table-border-double bg-primary bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th class="text-center">Check-In Terakhir</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto"><i class="ph-gear"></i> Pengaturan Fasilitas Lebih Lanjut</h6>
                </div>

                <div class="card-body border-bottom border-light">
                    <form id="form_facilities">
                        @csrf
                        <div class="col-lg-12 mb-1">
                            <div class="input-group">
                                <input type="hidden" name="wahana_id" id="wahana_id" value="{{ $wahana->id }}" readonly>
                                <input type="hidden" name="action" id="action" readonly>
                                <input type="hidden" name="id" id="id" readonly>
                                <input type="text" name="facility_name" id="facility_name" class="form-control" placeholder="Tambah/Ubah Fasilitas..." required>
                                <button class="btn btn-purple" type="button" onclick="save_facility()">Simpan</button>
                            </div>
                        </div>
                    </form>
                    <table class="table datatable-basic table-xs table-hover" id="tableFacilities">
                        <thead>
                            <tr class="table-border-double bg-primary bg-opacity-20">
                                <th class="text-center">#</th>
                                <th>Fasilitas</th>
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
    var tableRooms;
    var tableFacilities;
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

        document.getElementById('form_rooms').addEventListener('submit', function(event) {
            event.preventDefault();
        });

        document.getElementById('form_facilities').addEventListener('submit', function(event) {
            event.preventDefault();
        });

        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });

        tableRooms = $('#tableRooms').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('wahana.rooms.index') }}",
                data: {
                    _token : "{{ csrf_token() }}",
                    id : {{ $wahana->id }}
                }
            },
            serverSide: true,
            processing: true,
            searching: false,
            lengthChange: false,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
                { data: 'name', name: 'name', orderable: true, searchable: true, sortable: false },
                {
                    data: 'status',
                    name: 'status',
                    searchable: true,
                    render: function(data, type, row){
                        let disp_status = '';
                        if(data == 'A'){
                            disp_status = '<span class="badge bg-success text-success bg-opacity-20">Tersedia</span>';
                        }else if(data == 'RV'){
                            disp_status = '<span class="badge bg-primary text-primary bg-opacity-20">Booked</span>';
                        }else{
                            disp_status = '<span class="badge bg-danger text-danger bg-opacity-20">Tidak Aktif</span>';
                        }

                        return disp_status;
                    },
                },
                {
                    data: 'last_checkin',
                    name: 'last_checkin',
                    class: 'text-center',
                    searchable: false,
                    render: function(data, type, row){
                        return (data != null) ? moment(data).format('DD.MM.YYYY') : '<code>-</code>';
                    },
                },
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

        tableFacilities = $('#tableFacilities').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            },
            ajax: {
                url: "{{ route('wahana.facilities.index') }}",
                data: {
                    _token : "{{ csrf_token() }}",
                    id : {{ $wahana->id }}
                }
            },
            serverSide: true,
            processing: true,
            searching: false,
            lengthChange: false,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
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

    function saveEdit(){
        $.ajax({
            type: "PUT",
            url: "{{ route('wahana.paket.update', $wahana->id) }}",
            data: $('#form_data').serialize(),
            success: function (s) {
                sw_success(s);
                // sw_success_redirect(s, "{{ route('wahana.paket.index') }}");
            },
            error: function(e){
                sw_multi_error(e);
            },
        });
    }

    function saveRooms(){
        $.ajax({
            type: "POST",
            url: "{{ route('wahana.rooms.store') }}",
            data: $('#form_rooms').serialize(),
            // beforeSend: function(){
            //     small_loader_open('form_data');
            // },
            success: function (s) {
                reload_table(tableRooms);
                $('#new_rooms').val('');
                $('#new_rooms').focus();
                sw_success(s);
            },
            error: function(e){
                sw_single_error(e);
            },
            complete: function(){
                // small_loader_close('form_data');
            }
        });
    }

    function hapus_room(i){
        sw_delete_validated(
            "{{ route('wahana.rooms.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('wahana.rooms.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableRooms",
            tableRooms
        );
    }

    function ubah_status_room(i){
        $.ajax({
            url: "{{ route('wahana.rooms.edit', ':id') }}".replace(':id', i),
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
                }else{
                    swalInit.fire({
                        title: s.msg_title,
                        html: s.msg_body,
                        input: 'select',
                        icon: 'info',
                        inputOptions: {
                            '': '',
                            'A': 'Tersedia',
                            'NA': 'Tidak Tersedia',
                        },
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-light',
                            denyButton: 'btn btn-light',
                            input: 'form-control select-single'
                        },
                        showCancelButton: true,
                        allowOutsideClick: false,
                        inputValidator: function(value) {
                            return new Promise(function(resolve) {
                                if(value === '') {
                                    resolve('Silahkan pilih status atau cancel');
                                }else{
                                    resolve();
                                }
                            });
                        },
                        inputAttributes: {
                            'data-placeholder': 'Pilih status...'
                        },
                        didOpen: function() {
                            $('.swal2-select.select-single').select2({
                                minimumResultsForSearch: Infinity
                            });
                        }
                    }).then(function(result) {
                        if(result.value) {
                            $.ajax({
                                type: "PUT",
                                url: "{{ route('wahana.rooms.update', ':id') }}".replace(':id', i),
                                data: {
                                    _token : "{{ csrf_token() }}",
                                    new_status: result.value
                                },
                                success: function (s) {
                                    swalInit.fire({
                                        html: s.msg_body,
                                        type: 'success',
                                        icon: 'success',
                                        toast: true,
                                        position: 'top',
                                        timer: 3000,
                                        showConfirmButton: false,
                                    });
                                    reload_table(tableRooms);
                                },
                                error: function(e){
                                    sw_multi_error(e);
                                },
                            });
                        }
                    });
                }
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }

    function edit_facility(i){
        $.ajax({
            url: "{{ route('wahana.facilities.edit', ':id') }}".replace(':id', i),
            type: "GET",
            data: {
                _token : "{{ csrf_token() }}",
                id : i,
            },
            beforeSend: function(){
                // small_loader_open(selector);
            },
            success: function(s){
                $('#form_facilities #action').val('edit');
                $('#form_facilities #id').val(s.id);
                $('#facility_name').val(s.name);
                $('#facility_name').focus();
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }

    function save_facility(){
        let xMethod;
        if($('#form_facilities #action').val() === 'edit'){
            xMethod = 'edit';
        }else{
            xMethod = 'save';
        }
        let xhr = null;
        if(xMethod == 'edit'){
            xhr = $.ajax({
                type: "PUT",
                url: "{{ route('wahana.facilities.update', ':id') }}".replace(':id', $('#form_facilities #id').val()),
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#form_facilities #id').val(),
                    wahana_id: {{ $wahana->id }},
                    facility_name: $('#form_facilities #facility_name').val()
                },
                success: function (s) {
                    reload_table(tableFacilities);
                    sw_success(s);
                    $('#form_facilities')[0].reset();
                    $('#facility_name').focus();
                },
                error: function(e){
                    sw_multi_error(e);
                },
                complete: function(){
                    xhr = null;
                }
            });
        }else if(xMethod === 'save'){
            if($('#form_facilities #facility_name').val() == ''){
                swalInit.fire({
                    html: 'Silahkan tambahkan fasilitas',
                    type: 'error',
                    icon: 'error',
                    toast: true,
                    position: 'top',
                    timer: 3000,
                    showConfirmButton: false,
                });
            }else{
                xhr = $.ajax({
                    type: "POST",
                    url: "{{ route('wahana.facilities.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#form_facilities #id').val(),
                        wahana_id: {{ $wahana->id }},
                        facility_name: $('#form_facilities #facility_name').val()
                    },
                    // beforeSend: function(){
                    //     small_loader_open('form_data');
                    // },
                    success: function (s) {
                        sw_success(s);
                        reload_table(tableFacilities);
                        $('#form_facilities')[0].reset();
                        $('#facility_name').focus();
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

    function hapus_facility(i){
        sw_delete_validated(
            "{{ route('wahana.facilities.show', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            i,
            "{{ route('wahana.facilities.destroy', ':id') }}".replace(':id', i),
            "{{ csrf_token() }}",
            "tableFacilities",
            tableFacilities
        );
    }
</script>
@endsection