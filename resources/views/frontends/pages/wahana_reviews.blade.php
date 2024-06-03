<div class="mil-rooms mil-p-100-100">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 110%; bottom: 15%; left: -30%; opacity: .2" alt="shape">
    <div class="container">
        <div class="row justify-content-between align-items-end mil-mb-100">
            <div class="col-lg-7">
                <h2 class="mil-fade-up">Mari Dengar Apa Kata Mereka😎</h2>
            </div>
            <div class="col-lg-5">
                <div class="mil-desctop-right mil-fade-up">

                    <div class="mil-slider-nav mil-recommendation-nav mil-fade-up">
                        <div class="mil-slider-arrow mil-prev mil-reco-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                        <div class="mil-slider-arrow mil-reco-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="swiper-container mil-reco-slider mil-mb-40">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    @forelse ($reviews as $review)
                        <div class="mil-card mil-mb-40-adapt mil-fade-up">
                            <div class="mil-descr">
                                <h3 class="mil-mb-20">Coastal Retreat</h3>
                                <div class="mil-icon mil-mb-20">
                                    @php
                                        $greyStars = 5;
                                        $greyStars = $greyStars - $review->star;
                                    @endphp
                                    @for ($i = 0; $i < $review->star; $i++)
                                        <i class="icon-star-full2 star-review"></i>
                                    @endfor

                                    @if ($greyStars > 0)
                                        @for ($i = 0; $i < $greyStars; $i++)
                                            <i class="icon-star-full2"></i>
                                        @endfor
                                    @endif
                                </div>
                                <p class="mil-mb-40">{{ $review->testimonial }}</p>
                            </div>
                        </div>
                    @empty
                        Belum ada review
                    @endforelse
                </div>

            </div>
        </div>

    </div>
</div>