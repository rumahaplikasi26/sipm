<div class="container-fluid">
    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
        <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav">
                @foreach ($menus as $menu)
                    @if (!isset($menu['menus']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $menu['url'] }}" key="t-{{ Str::slug($menu['name']) }}">
                                <i class="{{ $menu['icon'] }} me-2"></i>
                                <span>{{ $menu['name'] }}</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#"
                                id="menu-{{ Str::slug($menu['name']) }}" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="{{ $menu['icon'] }} me-2"></i>
                                <span key="t-{{ Str::slug($menu['name']) }}">{{ $menu['name'] }}</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="menu-{{ Str::slug($menu['name']) }}">
                                @foreach ($menu['menus'] as $subMenu)
                                    <div class="dropdown">
                                        @if (isset($subMenu['menus']))
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#">
                                                {{ $subMenu['name'] }}
                                                <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu">
                                                @foreach ($subMenu['menus'] as $subSubMenu)
                                                    <a class="dropdown-item" href="{{ $subSubMenu['url'] }}">
                                                        <i class="{{ $subSubMenu['icon'] }} me-2"></i>
                                                        {{ $subSubMenu['name'] }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <a class="dropdown-item" href="{{ $subMenu['url'] }}">
                                                {{ $subMenu['name'] }}
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</div>
