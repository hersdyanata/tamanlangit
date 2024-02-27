@extends('layouts.app')
@section('page_resources')

@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('content')
<div class="card">
    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
        <h6 class="py-sm-3 mb-sm-auto"><i class="ph-list-bullets"></i> {{ $title }}</h6>
        <div class="ms-sm-auto my-sm-auto">
            @can('cms-faq-create')
                <a href="{{ route('cms.faq.create') }}" class="btn btn-primary btn-labeled btn-labeled-start">
                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                        <i class="ph-note-pencil"></i>
                    </span>
                    Buat Baru
                </a> 
            @endcan
            
            <button type="button" class="btn btn-warning btn-labeled btn-labeled-start" onclick="reload_table(tableData)">
                <span class="btn-labeled-icon bg-black bg-opacity-20">
                    <i class="ph-arrows-counter-clockwise"></i>
                </span>
                Reload
            </button>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-3">Agar website lebih informatif, jika manajemen sering mendapatkan pertanyaan-pertanyaan yang sering diajukan oleh pelanggan silahkan masukkan pertanyaan dan jawabannya disini.</p>
        <div class="accordion" id="accordion_collapsed">
            @forelse ($faqs as $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="faq{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion_collapsed">
                        <div class="accordion-body">
                            {!! $faq->answer !!}

                            <div class="mt-3">

                                <ul class="nav">
                                    @can('cms-faq-edit')
                                        <li class="nav-item ms-md-1">
                                            <a href="{{ route('cms.faq.edit', $faq->id) }}" class="navbar-nav-link navbar-nav-link-icon text-success bg-success bg-opacity-10 fw-semibold rounded">
                                                <div class="d-flex align-items-center mx-md-1">
                                                    <i class="ph-note-pencil"></i>
                                                    <span class="d-none d-md-inline-block ms-2">Edit</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('cms-faq-delete')
                                        <li class="nav-item ms-md-1">
                                            <a href="#" onclick="preaction({{ $faq->id }})" class="navbar-nav-link navbar-nav-link-icon text-danger bg-danger bg-opacity-10 fw-semibold rounded">
                                                <div class="d-flex align-items-center mx-md-1">
                                                    <i class="ph-trash"></i>
                                                    <span class="d-none d-md-inline-block ms-2">Hapus</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card text-center" style="min-height: 350px;">
                    <div class="card-body">
                        <i class="ph-circle-wavy-question ph-4x text-success border border-width-3 border-success rounded-pill p-2 mb-3"></i>
                        <h5 class="card-title">Belum ada FAQ</h5>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    function preaction(i){
        $.ajax({
            url: "{{ route('cms.faq.show', ':id') }}".replace(':id', i),
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
                    // small_loader_close(selector);
                }else{
                    swalInit.fire({
                        title: s.msg_title,
                        html: s.msg_body,
                        type: 'warning',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Iya, tolong hapus!',
                        cancelButtonText: 'Tidak, tolong batalkan!',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        allowOutsideClick: false
                    }).then(function(result) {
                        if(result.value) {
        
                            $.ajax({
                                url: "{{ route('cms.faq.destroy', ':id') }}".replace(':id', i),
                                type: "DELETE",
                                data: {
                                    _token : "{{ csrf_token() }}",
                                    id : s.id
                                },
                                beforeSend: function(){
                                    // small_loader_open(selector);
                                },
                                success: function(d){
                                    swalInit.fire({
                                        title: d.msg_title,
                                        html: d.msg_body,
                                        type: 'success',
                                        icon: 'success',
                                        confirmButtonClass: 'btn btn-success',
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);
                                },
                                complete: function(){
                                    // small_loader_close(selector);
                                }
                            });
                        }
                        else if(result.dismiss === swalInit.DismissReason.cancel) {
                            swalInit.fire({
                                title: 'Dibatalkan',
                                html: 'Data Anda aman 😉',
                                type: 'success',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-success',
                                allowOutsideClick: false
                            });
                            // small_loader_close(selector);
                        }
                    });
                }
            },
            complete: function(){
                // small_loader_close('section_divider');
            }
        });
    }
</script>
@endsection