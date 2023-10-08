<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{'/'}}">
                <i class="bi bi-grid"></i>
                <span>Manage</span>
            </a>
        </li>

    @forelse(\App\Enums\RoutingEnum::NAME as $item)
        <li class="nav-item">
            <a class="nav-link collapsed " data-bs-target="#{{$item}}" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span class="{{request()->segment(1) == strtolower($item) ? 'chosen' : '' }}">{{$item}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
                @forelse(\App\Enums\RoutingEnum::VALUE as $key=>$value)
            <ul  id="{{$item}}" class="nav-content collapse {{ request()->segment(1) == strtolower($item) ? 'show ' : 'collapse' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route(strtolower($item).'.'.$value)}}" class="{{ request()->segment(2) == $value && request()->segment(1) == strtolower($item) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>{{$key}}</span>
                    </a>
                </li>
            </ul>
           @empty
           @endforelse
        </li>
        @empty
        @endforelse
    </ul>

</aside>