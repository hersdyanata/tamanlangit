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
                <a href="{{ route('acl.usergroup.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
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
                            <input type="hidden" name="id" id="id" class="form-control" value="{{ $role->id }}" readonly>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Permissions</label>
                        <div class="col-lg-6">
                            @foreach ($permissions as $permission)
                                <label class="form-check mb-2">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input form-check-input-danger" {{ (in_array($permission->name, $role_permissions)) ? 'checked' : '' }}>
                                    <span class="form-check-label">{{ $permission->name }}</span>
                                </label>
                            @endforeach
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
    function save(){
        $.ajax({
            type: "PUT",
            url: "{{ route('acl.usergroup.update', $role->id) }}",
            data: $('#form_data').serialize(),
            success: function (s) {
                sw_success_redirect(s, "{{ route('acl.usergroup.index') }}");
            },
            error: function(e){
                sw_multi_error(e);
            },
        });
    }
</script>
@endsection