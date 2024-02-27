@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime.js') }}"></script>
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> Pengguna Dengan Role {{ $role->name }}</h6>
            <div class="ms-sm-auto my-sm-auto">
                <div class="ms-sm-auto my-sm-auto">
                    <a href="{{ route('acl.usergroup.index') }}" class="btn btn-warning btn-labeled btn-labeled-start">
                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                            <i class="ph-arrow-left"></i>
                        </span>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table datatable-basic table-hover table-bordered" id="tableData">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 0; @endphp
                    @forelse ($users as $r)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no }}</td>
                            <td>{{ $r->name }}</td>
                        </tr>                        
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Belum ada user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
        </div>

        <div class="card-body">
            <table class="table datatable-basic table-hover table-bordered" id="tableData">
                <thead>
                    <tr class="table-border-double bg-teal bg-opacity-20">
                        <th class="text-center">#</th>
                        <th>Permission</th>
                        <th>Guard</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 0; @endphp
                    @foreach ($permissions as $r)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page_js')
@endsection