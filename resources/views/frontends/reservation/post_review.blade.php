@extends('layouts.frontend')

@section('page_resources')
    <script src="{{ asset('assets/fe/js/plugins/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection

@section('page_css')
    <link href="{{ asset('assets/fe/css/additional.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
@endsection

@section('subtitle')
    | {{ $title }}
@endsection

@section('meta_data')
@endsection

@section('content')
    <div class="mil-banner-sm">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; top: 0; right: -35%; transform: rotate(190deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; bottom: -12%; left: -30%; transform: rotate(40deg)" alt="shape">
        <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 110%; top: -5%; left: -30%; opacity: .3" alt="shape">
        <div class="container">
            <div class="mil-banner-img-4">
                <img src="{{ asset('assets/fe/img/shapes/1.png') }}" alt="object" class="mil-figure mil-1">
                <img src="{{ asset('assets/fe/img/shapes/2.png') }}" alt="object" class="mil-figure mil-2">
                <img src="{{ asset('assets/fe/img/shapes/3.png') }}" alt="object" class="mil-figure mil-3">
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8">

                    <div class="mil-banner-content-frame">
                        <div class="mil-banner-content mil-text-center">
                            <h1 class="mil-mb-40">Review dari kamu sangat berarti🤗</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="mil-content-pad mil-p-100-100 mil-mb-40">
        <div class="container">
            <form id="form_data">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mil-field-frame mil-mb-20 align-items-center justify-content-center">
                            <h2 class="mil-mb-20">{{ ucwords(strtolower($wahana->name)) }}</h2>
                            <h2 class="mil-mb-20">Bintang</h2>
                            <div class="mil-icon mil-mb-20">
                                <i class="icon-star-empty3 icon-2x"></i>
                                <i class="icon-star-empty3 icon-2x"></i>
                                <i class="icon-star-empty3 icon-2x"></i>
                                <i class="icon-star-empty3 icon-2x"></i>
                                <i class="icon-star-empty3 icon-2x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="mil-field-frame mil-mb-20 align-items-center justify-content-center">
                            <h2 class="mil-mb-20">Review</h2>
                            <input type="hidden" name="wahana_id" id="wahana_id" value="{{ $wahana->id }}" readonly>
                            <input type="hidden" name="reservation_id" id="reservation_id" value="{{ $reservation->id }}" readonly>
                            <input type="hidden" name="name" id="name" value="{{ $reservation->name }}" readonly>
                            <input type="hidden" name="star" id="star_input" readonly>
                            <textarea placeholder="Bagaimana menurutmu pengalaman berkemah di Taman Langit?" name="review"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="offset-7 col-lg-5">
                        <div class="mil-desctop-right mil-fade-up">
                            <button type="button" class="mil-button" onclick="save()">
                                <span>Kirim</span>
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
    function mouseoverBintang(index) {
        const allStars = document.querySelectorAll('.mil-icon i');
        for (let i = 0; i <= index; i++) {
            allStars[i].classList.remove("icon-star-empty3");
            allStars[i].classList.add("icon-star-full2", "star-review");
        }

        for (let i = index + 1; i < allStars.length; i++) {
            allStars[i].classList.remove("icon-star-full2", "star-review");
            allStars[i].classList.add("icon-star-empty3");
        }
    }

    function mouseoutBintang(index) {
        const allStars = document.querySelectorAll('.mil-icon i');
        for (let i = index + 1; i < allStars.length; i++) {
            allStars[i].classList.remove("icon-star-empty3");
            allStars[i].classList.add("icon-star-full2", "star-review");
        }
    }

    function klikBintang(index) {
        const allStars = document.querySelectorAll('.mil-icon i');

        for (let i = 0; i <= index; i++) {
            allStars[i].classList.remove("icon-star-empty3");
            allStars[i].classList.add("icon-star-full2", "star-review");
        }
    }

    function save(){
            $.ajax({
                type: "POST",
                url: "{{ route('review.submit') }}",
                data: $('#form_data').serialize(),
                success: function (s) {
                    let redirectUrl = "{{ route('home') }}";
                    sw_success_redirect(s, redirectUrl);
                },
                error: function(e){
                    sw_multi_error(e);
                },
                complete: function(){
                }
            });
        }

    document.addEventListener("DOMContentLoaded", function() {
        const allStars = document.querySelectorAll('.mil-icon i');
        let clickedStarIndex = -1;

        function updateStars(index) {
            allStars.forEach((star, i) => {
                if (i <= index) {
                    star.classList.remove("icon-star-empty3");
                    star.classList.add("icon-star-full2", "star-review");
                } else {
                    star.classList.remove("icon-star-full2", "star-review");
                    star.classList.add("icon-star-empty3");
                }
            });
        }

        function setNilai(index) {
            const nilai = index + 1;
            let starInput = document.getElementById('star_input');
            starInput.value = nilai;
            console.log("Nilai: ", nilai);
        }

        allStars.forEach((star, index) => {
            star.addEventListener('mouseover', () => {
                updateStars(index);
            });

            star.addEventListener('mouseout', () => {
                if (clickedStarIndex === -1) {
                    updateStars(-1);
                } else {
                    updateStars(clickedStarIndex);
                }
            });

            star.addEventListener('click', () => {
                clickedStarIndex = index;
                updateStars(index);
                setNilai(index);
            });
        });
    });



</script>
@endsection