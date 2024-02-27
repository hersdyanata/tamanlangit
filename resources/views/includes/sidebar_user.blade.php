@foreach ($divider as $div)
    <li class="nav-item-header pt-0">
        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">{{ $div->title }}</div>
        <i class="ph-dots-three sidebar-resize-show"></i>
    </li>
    
    @foreach ($menus as $menu)
        @if ($menu->divider_id == $div->id)
            @if (count($menu->children) > 0)
                <li class="nav-item nav-item-submenu" id="parent_{{ $menu->id }}">
                    <a href="#" class="nav-link">
                        <i class="{{ $menu->icon }}"></i><span>{{ $menu->title }}</span></a>
                    </a>

                    <ul class="nav-group-sub collapse" id="navigate_{{ $menu->id }}">
                        @foreach ($menu->children as $child)
                            @php
                                $exploded_route = explode('.',$child->route);
                                unset($exploded_route[2]);
                                $route_db = implode('/', $exploded_route);
                                $current_url = Request::segment(1).'/'.Request::segment(2);
                                $child_active = ($current_url == $route_db) ? 'active' : '';
                            @endphp
                            @if ($child_active != '')
                                <script>
                                    let parent = document.getElementById('parent_{{ $child->parent_id }}');
                                    let navigate = document.getElementById('navigate_{{ $child->parent_id }}');

                                    parent.classList.add('nav-item-expanded');
                                    parent.classList.add('nav-item-open');
                                    navigate.classList.add('show');
                                </script>
                            @endif
                            <li class="nav-item nav-item">
                                <a href="{{ route($child->route) }}" class="nav-link {{ $child_active }}">
                                    <i class="{{ $child->icon }}"></i><span>{{ $child->title }}</span></a>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>                        
            @else
                <li class="nav-item nav-item">
                    @php
                        $exploded_route = explode('.',$menu->route);
                        unset($exploded_route[2]);
                        $route_db = implode('/', $exploded_route);
                        $current_url = Request::segment(1).'/'.Request::segment(2);
                        $menu_active = ($current_url == $route_db) ? 'active' : '';
                    @endphp
                    <a href="{{ route($menu->route) }}" class="nav-link {{ $menu_active }}">
                        <i class="{{ $menu->icon }}"></i><span>{{ $menu->title }}</span></a>
                    </a>
                </li>
            @endif                            
        @endif
    @endforeach

@endforeach
