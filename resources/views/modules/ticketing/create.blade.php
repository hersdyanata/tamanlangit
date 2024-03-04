@extends('layouts.app')
@section('page_resources')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script> --}}
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
                    <form id="form_batch">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Deskripsi</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="description" id="description" autocomplete="off">
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Berlaku Untuk</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="tanggal" id="tanggal">
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Quantity Nomor Seri</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="quantity" id="quantity" autocomplete="off">
                                <div class="badge d-block bg-danger mt-1 bg-pink bg-opacity-25 text-start text-dark">Semakin banyak quantity, semakin lama proses yang akan berjalan.</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Kategori</label>
                            <div class="col-lg-9">
                                <select class="form-control select" data-minimum-results-for-search="Infinity" name="category" id="category">
                                    <option value="">-- Kategori --</option>
                                    <option value="kunjungan">Kunjungan</option>
                                    <option value="parkir">Parkir</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-3">Harga</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="price" id="price" autocomplete="off">
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

                    <div class="d-flex align-items-center">
                        <div class="row col-lg-9 offset-3 mb-2 loader">
                            <span class="fst-italic"><i class="ph-aperture spinner"></i> Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h6 class="py-sm-3 mb-sm-auto text-warning"><i class="ph-circle-wavy-warning"></i> Penting Untuk Diketahui...!!!</h6>
                </div>

                <div class="card-body border-bottom border-light">
                    <div class="border rounded p-3">
                        <span class="text-danger fw-bold">KODE BATCH:</span>
                        <ul class="list mb-4">
                            <li>Kode batch akan di-generate secara otomatis oleh sistem.</li>
                            <li>Komposisi <span class="fw-bold">KODE BATCH</span> tiket terdiri dari:
                                <ul class="list">
                                    <li>2 digit tahun</li>
                                    <li>2 digit bulan</li>
                                    <li>2 digit tanggal pembuatan</li>
                                    <li>2 digit kode batch</li>
                                </ul>
                            </li>
                            <li>Kode batch akan bersifat unik setiap harinya / tidak akan memiliki duplikat.</li>
                            <li>Sebagai contoh: <span class="text-danger">240227ER</span>, berarti tiket dibuat pada <span class="text-danger">tahun 2024, bulan 2, tanggal 27 dengan batch ER.</span></li>
                            <li>Dalam sehari sistem bisa menghasilkan sebanyak <span class="text-danger fw-bold">325 KODE BATCH.</span></li>
                        </ul>

                        <span class="text-danger fw-bold">NOMOR SERI:</span>
                        <ul class="list mb-2">
                            <li>Setiap tiket batch akan memiliki nomor seri.</li>
                            <li>Nomor seri terdiri dari 4 karakter acak <span class="text-danger">A-Z.</span></li>
                            <li>Jumlah nomor seri akan di-generate secara otomatis oleh sistem.</li>
                            <li>Banyaknya nomor seri yang akan di-generate tergantung dari <span class="fw-bold text-danger">QUANTITY</span> yang di-input.</li>
                            <li>Dalam 1 kode batch bisa menghasilkan sebanyak <span class="text-danger fw-bold">175.950 NOMOR SERI.</span></li>
                        </ul>
                    </div>
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

        $('.loader').hide();

        // $('#tanggal').daterangepicker({
        //     parentEl: '.content-inner',
        //     locale: {
        //         format: 'YYYY-MM-DD', // Set the date format
        //         cancelLabel: 'Clear',
        //     },
        //     minDate: moment(),
        // });
    });

    function save(){
        $.ajax({
            type: "POST",
            url: "{{ route('tiket.data.store') }}",
            data: $('#form_batch').serialize(),
            beforeSend: function(){
                $('.loader').show();
                $('#saveButton').prop('disabled', true);
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
                $('.loader').hide();
                // $('#saveButton').prop('disabled', false);
            }
        });
    }

</script>
@endsection