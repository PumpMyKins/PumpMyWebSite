<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                    <i class="ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        <img class="w-2r bdrs-50p" src="{{ Auth::check() ? asset(Auth::user()->avatar) : ''}}" alt="">
                    </div>
                    <div class="peer">
                        <span class="fsz-sm c-grey-900">{{ Auth::user() != null ? Auth::user()->name : "Guest" }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    @auth
                        <li>
                            <a href="{{ route('panel.account') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                <i class="ti-user mR-10"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="email.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                <i class="ti-email mR-10"></i>
                                <span>Messages</span>
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti-power-off mR-10"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                <i class="ti-settings mR-10"></i>
                                <span>{{ __("Login") }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                <i class="ti-user mR-10"></i>
                                <span>{{ __("Register") }}</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>
</div>