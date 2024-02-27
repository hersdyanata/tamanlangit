<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill" title="Collapse">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0">
            <div class="d-inline-flex align-items-center">
                <img src="{{ asset('assets/images/logo_icon.svg') }}" alt="">&nbsp;&nbsp;
                <h4 class="page-title mb-0">{{ env('APP_NAME') }} - Backend</h4>
            </div>
        </div>

        <ul class="nav flex-row">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="navbar-nav-link navbar-nav-link-icon rounded ms-1" target="_blank">
                    <div class="d-flex align-items-center mx-md-1">
                    <i class="ph-atom"></i>
                    <span class="d-none d-md-inline-block ms-2">Website Utama</span>
                </div>
                </a>
            </li>
        </ul>

        <ul class="nav flex-row justify-content-end order-1 order-lg-2">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="offcanvas" data-bs-target="#notifications">
                    <i class="ph-bell"></i>
                    {{-- <span class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">2</span> --}}
                </a>
            </li>

            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                    <div class="status-indicator-container">
                        <img src="{{ asset('assets/images/demo/users/face11.jpg') }}" class="w-32px h-32px rounded-pill" alt="">
                        <span class="status-indicator bg-success"></span>
                    </div>
                    <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ph-user-circle me-2"></i>
                        My profile
                    </a>                    

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                    <i class="ph-sign-out me-2"></i>
                                    Logout
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->