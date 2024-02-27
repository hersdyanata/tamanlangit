<div class="mil-banner">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 70%; top: 0; right: -12%; transform: rotate(180deg)" alt="shape">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 80%; bottom: -12%; right: -22%; transform: rotate(0deg) scaleX(-1);" alt="shape">
    <img src="{{ asset('assets/fe/img/shapes/4.png') }}" class="mil-shape" style="width: 110%; top: -5%; left: -30%; opacity: .2" alt="shape">
    <div class="container">
        <div class="mil-banner-img-1">
            <img src="{{ asset('assets/fe/img/images/1.png') }}" alt="banner">
            <img src="{{ asset('assets/fe/img/shapes/1.png') }}" alt="object" class="mil-figure mil-1">
            <img src="{{ asset('assets/fe/img/shapes/2.png') }}" alt="object" class="mil-figure mil-2">
            <img src="{{ asset('assets/fe/img/shapes/3.png') }}" alt="object" class="mil-figure mil-3">
        </div>
        <div class="row align-items-center">
            <div class="col-xl-10">

                <div class="mil-banner-content-frame">
                    <div class="mil-banner-content">
                        <div class="mil-suptitle mil-mb-40">Hi Guys!</div>
                        <h1 class="mil-mb-40">Lebih dekat dengan alam <br>itu menyehatkan.</h1>
                        <div class="mil-search-panel mil-mb-20">
                            <form>
                                <div class="mil-form-grid">
                                    <div class="mil-col-5 mil-field-frame">
                                        {{-- <label>Check-in</label> --}}
                                        <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Pilih tanggal" autocomplete="off" readonly="readonly">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div class="mil-col-5 mil-field-frame">
                                        {{-- <label>Check-out</label> --}}
                                        <input type="text" class="datepicker-here" data-position="bottom left" placeholder="Pilih tanggal" autocomplete="off" readonly="readonly">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div class="mil-col-2 mil-field-frame">
                                        {{-- <label>Orang</label> --}}
                                        <input type="text" placeholder="Enter quantity" value="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <span>Search</span>
                                </button>
                            </form>
                        </div>
                        <p><span class="mil-accent-2">*</span>Ayo rencanakan berkemah bersama keluarga dan orang-orang tercinta.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>