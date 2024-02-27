@extends('layouts.app')
@section('page_resources')
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-note-pencil"></i> {{ $title }}</h6>
            <div class="ms-sm-auto my-sm-auto">
                <a href="{{ route('acl.user.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                        <label class="col-form-label col-lg-2">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Email</label>
                        <div class="col-lg-6">
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Role</label>
                        <div class="col-lg-6">
                            <select class="form-select" name="role" id="role">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="password" class="form-control">
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
    $('.select').select2();

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('acl.user.store') }}",
            data: $('#form_data').serialize(),
            success: function (s) {
                console.log(s);
                sw_success_redirect(s, "{{ route('acl.user.index') }}");
            },
            error: function(e){
                sw_multi_error(e);
            },
        });
    }
</script>
@endsection