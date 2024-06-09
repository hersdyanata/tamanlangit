<footer>
    {{-- <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape mil-fade-up" style="width: 85%; top: -15%; left: -40%; z-index:-9999; transform: rotate(-50deg)" alt="shape"> --}}
    <div class="mil-footer-content mil-fade-up">
        <div class="container">
            <div class="row justify-content-between mil-p-100-40">
                <div class="col-md-4 col-lg-5 mil-mb-60">
                    <a href="{{ route('home') }}" class="mil-logo mil-mb-20">
                        <img src="{{ asset('assets/fe/img/logo-tl.png') }}" alt="aquarelle">
                    </a>

                    <img src="{{ asset('assets/fe/img/payment.png') }}" alt="payment" width="50%"><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="{{ asset('assets/fe/img/chse.png') }}" alt="secure_transaction" width="30%"> &nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="{{ asset('assets/fe/img/secure_trans.png') }}" alt="secure_transaction" width="18%">

                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-7 mil-mb-60">

                            <nav class="mil-footer-menu">
                                <ul>
                                    <li class="{{ (Request::segment(1) == null) ? 'mil-active' : '' }}">
                                        <a href="{{ route('home') }}">Beranda</a>
                                    </li>
                                    <li class="{{ (Request::segment(1) == 'tentang-kami') ? 'mil-active' : '' }}">
                                        <a href="{{ route('about') }}">Tentang Kami</a>
                                    </li>
                                    <li class="{{ (Request::segment(1) == 'kontak') ? 'mil-active' : '' }}">
                                        <a href="{{ route('contact') }}">Kontak</a>
                                    </li>
                                    <li class="{{ (Request::segment(1) == 'faq') ? 'mil-active' : '' }}">
                                        <a href="{{ route('faq') }}">FAQ</a>
                                    </li>
                                    <li class="{{ (Request::segment(1) == 'paket-wisata') ? 'mil-active' : '' }}">
                                        <a href="{{ route('wahana') }}">Paket Wisata</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                        <div class="col-md-6 col-lg-5 mil-mb-60">

                            <ul class="mil-menu-list">
                                <li><a href="{{ route('privacy_policy') }}" class="mil-light-soft">Privacy Policy</a></li>
                                <li><a href="{{ route('syarat_ketentuan') }}" class="mil-light-soft">Syarat & Ketentuan</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mil-divider"></div>

            <div class="row justify-content-between flex-sm-row-reverse mil-p-100-40">
                {{-- address --}}
                <div class="col-md-7 col-lg-6">
                    <div class="row justify-content-between">

                        {{-- <div class="col-md-6 col-lg-5 mil-mb-40">

                            <h5 class="mil-mb-20">Spain</h5>
                            <p>71 South Los Carneros Road, California +51 174 705 812</p>

                        </div> --}}
                        <div class="col-md-7 offset-5 col-lg-7 mil-mb-40">

                            <h5 class="mil-mb-20">Bandung</h5>
                            <p>Kp. Puncak Mulya, Jl. Cukul, Sukaluyu. Pangalengan, Kab. Bandung. Jawa Barat</p>
                        </div>
                    </div>
                </div>
                {{-- address --}}

                {{-- contact --}}
                <div class="col-md-4 col-lg-6 mil-mb-60">
                    @php
                        $urls = getContact();
                    @endphp
                    <div class="mil-mb-20">
                        <ul class="mil-social-icons">
                            <li>
                                <a href="{{ $urls->facebook_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $urls->instagram_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $urls->twitter_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $urls->youtube_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube">
                                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $urls->tiktok_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000" stroke="currontColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256">
                                        <path d="M224,72a48.05,48.05,0,0,1-48-48,8,8,0,0,0-8-8H128a8,8,0,0,0-8,8V156a20,20,0,1,1-28.57-18.08A8,8,0,0,0,96,130.69V88a8,8,0,0,0-9.4-7.88C50.91,86.48,24,119.1,24,156a76,76,0,0,0,152,0V116.29A103.25,103.25,0,0,0,224,128a8,8,0,0,0,8-8V80A8,8,0,0,0,224,72Zm-8,39.64a87.19,87.19,0,0,1-43.33-16.15A8,8,0,0,0,160,102v54a60,60,0,0,1-120,0c0-25.9,16.64-49.13,40-57.6v27.67A36,36,0,1,0,136,156V32h24.5A64.14,64.14,0,0,0,216,87.5Z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $urls->pinterest_url }}" target="_blank" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000" stroke="currontColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256">
                                        <path d="M216,112c0,22.57-7.9,43.2-22.23,58.11C180.39,184,162.25,192,144,192c-17.88,0-29.82-5.86-37.43-12L95.79,225.83A8,8,0,0,1,88,232a8.24,8.24,0,0,1-1.84-.21,8,8,0,0,1-6-9.62l32-136a8,8,0,0,1,15.58,3.66l-16.9,71.8C114,166,123.3,176,144,176c27.53,0,56-23.94,56-64A72,72,0,1,0,65.63,148a8,8,0,0,1-13.85,8A88,88,0,1,1,216,112Z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p class="mil-light-soft">© Copyright 2024 - {{ ENV('APP_NAME') }}. All Rights Reserved.</p>
                </div>
                {{-- contact --}}
            </div>
        </div>
    </div>
</footer>