<div class="sidebar">
    <div class="sidebar-inner">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{ route('panel') }}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img src="{{ asset('images/logo-small.png') }}" alt="logo pumpmykins" style="margin: 10px;">
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">PumpMyKins</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ### $Sidebar Menu ### -->
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 active">
                <a class="sidebar-link" href="{{ route('panel.dashboard') }}">
                <span class="icon-holder">
                  <i class="c-{{ Route::current()->getName() == 'panel.dashboard' ? 'deep-' : ''}}orange-500 ti-home"></i>
                </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class='sidebar-link' href="{{ route('panel.servers') }}">
                <span class="icon-holder">
                  <i class="c-{{ Route::current()->getName() == 'panel.servers' ? 'deep-' : ''}}orange-500 ti-server"></i>
                </span>
                    <span class="title">{{ __('Servers') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class='sidebar-link' href="{{ route('panel.infos') }}">
                <span class="icon-holder">
                  <i class="c-{{ Route::current()->getName() == 'panel.infos' ? 'deep-' : ''}}orange-500 ti-info"></i>
                </span>
                    <span class="title">{{ __('Info') }}</span>
                </a>
            </li>
            @auth
                <li class="nav-item">
                    <a class='sidebar-link' href="{{ route('panel.api') }}">
                    <span class="icon-holder">
                      <i class="c-{{ Route::current()->getName() == 'panel.api' ? 'deep-' : ''}}orange-500 ti-comment-alt"></i>
                    </span>
                        <span class="title">{{ __('Api') }}</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</div>