@foreach ($images as $r)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-img-actions mx-1 mt-1">
                <img class="card-img img-fluid" src="{{ asset($r->image_path) }}" alt="">
                <div class="card-img-actions-overlay card-img">
                    <a href="{{ asset($r->image_path) }}" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
                        <i class="ph-magnifying-glass-plus"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="d-flex align-item-center flex-wrap">
                    <div>
                        <div class="fw-semibold me-2">{{ ($r->is_map == 'Y') ? 'peta' : '' }}</div>
                        {{-- <span class="fs-sm text-muted">Size: 432kb</span> --}}
                    </div>

                    <div class="d-inline-flex">
                        <a href="#" class="text-body align-item-center tooltiped" onclick="preaction({{ $r->id }})" title="Hapus">
                            <i class="ph-trash" style="font-size: 32px"></i>
                        </a>
                        <a href="#" class="text-body align-item-center tooltiped" onclick="markAsMap({{ $r->wahana_id }},{{ $r->id }})" title="Tandai sebagai peta">
                            <i class="ph-map-trifold" style="font-size: 32px"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach