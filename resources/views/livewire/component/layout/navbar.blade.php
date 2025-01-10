<div class="container-fluid">
    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
        <div class="collapse navbar-collapse" id="topnav-menu-content">
            <ul class="navbar-nav">
                @foreach ($menus as $menu)
                    @if (!isset($menu['menus']))
                        <!-- Menu tanpa submenu -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $menu['url'] }}" key="t-{{ Str::slug($menu['name']) }}">
                                <i class="{{ $menu['icon'] }} me-2"></i>
                                <span>{{ $menu['name'] }}</span>
                            </a>
                        </li>
                    @else
                        <!-- Menu dengan submenu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="menu-{{ Str::slug($menu['name']) }}"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="{{ $menu['icon'] }} me-2"></i>
                                <span>{{ $menu['name'] }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menu-{{ Str::slug($menu['name']) }}">
                                @foreach ($menu['menus'] as $subMenu)
                                    <li>
                                        @if (isset($subMenu['menus']))
                                            <!-- Submenu dengan sub-submenu -->
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                <i class="{{ $subMenu['icon'] }} me-2"></i>
                                                {{ $subMenu['name'] }}
                                            </a>
                                            <ul class="dropdown-submenu">
                                                @foreach ($subMenu['menus'] as $subSubMenu)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $subSubMenu['url'] }}">
                                                            <i class="{{ $subSubMenu['icon'] }} me-2"></i>
                                                            {{ $subSubMenu['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <!-- Submenu tanpa sub-submenu -->
                                            <a class="dropdown-item" href="{{ $subMenu['url'] }}">
                                                <i class="{{ $subMenu['icon'] }} me-2"></i>
                                                {{ $subMenu['name'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</div>
