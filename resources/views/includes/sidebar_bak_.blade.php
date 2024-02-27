<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex" title="right">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>

                @foreach (getDivider() as $div)
                    <li class="nav-item-header pt-0">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">{{ $div->title }}</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>

                    @foreach (getSidebar() as $menu)
                        @if ($menu->divider_id == $div->id)
                            @if (count($menu->children) > 0)
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="{{ $menu->icon }}"></i><span>{{ $menu->title }}</span></a>
                                    </a>

                                    <ul class="nav-group-sub collapse">
                                        @foreach ($menu->children as $child)
                                            <li class="nav-item nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="{{ $child->icon }}"></i><span>{{ $child->title }}</span></a>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    
                                </li>                        
                            @else
                                <li class="nav-item nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="{{ $menu->icon }}"></i><span>{{ $menu->title }}</span></a>
                                    </a>
                                </li>
                            @endif                            
                        @endif
                    @endforeach
                @endforeach

                {{-- <li class="nav-item">
                    <a href="index.html" class="nav-link active">
                        <i class="ph-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li> --}}

                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="ph-arrow-elbow-down-right"></i> <span>Menu levels</span></a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="#" class="nav-link">Second level</a></li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link">Second level with child</a>
                            <ul class="nav-group-sub collapse">
                                <li class="nav-item"><a href="#" class="nav-link">Third level</a></li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">Third level with child</a>
                                    <ul class="nav-group-sub collapse">
                                        <li class="nav-item"><a href="#" class="nav-link">Fourth level</a></li>
                                        <li class="nav-item"><a href="#" class="nav-link">Fourth level</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="#" class="nav-link">Third level</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">Second level</a></li>
                    </ul>
                </li> --}}
                <!-- /layout -->
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->