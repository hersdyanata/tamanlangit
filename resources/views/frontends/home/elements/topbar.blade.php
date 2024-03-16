<div class="mil-top-panel">
    <div class="container">
        <div class="mil-top-panel-content">
            <a href="{{ route('home') }}" class="mil-logo">
                <img src="{{ asset('assets/fe/img/logo-tl.png') }}" alt="taman langit">
            </a>
            <div class="mil-menu-btn">
                <span></span>
            </div>
            <div class="mil-mobile-menu">
                <nav class="mil-menu">
                    <ul>
                        <li class="{{ (Request::segment(1) == null) ? 'mil-current' : '' }}">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'tentang-kami') ? 'mil-current' : '' }}">
                            <a href="{{ route('about') }}">Tentang Kami</a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'kontak') ? 'mil-current' : '' }}">
                            <a href="{{ route('contact') }}">Kontak</a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'faq') ? 'mil-current' : '' }}">
                            <a href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'paket-wisata') ? 'mil-current' : '' }}">
                            <a href="{{ route('wahana') }}">Paket Wisata</a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'blog') ? 'mil-current' : '' }}">
                            <a href="#.">Blog</a>
                            <ul>
                                @foreach (getBlogCategories() as $category)
                                    <li><a href="{{ route('blog_category', $category->url) }}">{{ $category->title }}</a></li>
                                    
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
                <a href="#." class="mil-button mil-open-book-popup mil-top-panel-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>Pesan Sekarang</span>
                </a>
            </div>
        </div>
    </div>
</div>