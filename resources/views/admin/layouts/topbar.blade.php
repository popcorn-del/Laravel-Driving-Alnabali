<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="dropdown">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('jor')
                            <img src="{{ URL::asset('/assets/images/flags/jordan.png')}}" alt="Header Language" height="16">
                        @break
                        @default
                            <img src="{{ URL::asset('/assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-start custom-language">

                    <!-- item-->
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="{{ URL::asset ('/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12">
                    </a>
                    <!-- item-->
                    <a href="{{ url('index/jor') }}" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="{{ URL::asset ('/assets/images/flags/jordan.png') }}" alt="user-image" class="me-1" height="12">
                    </a>
                </div>
            </div>
    </div>
    <h4 class="mt-3 text-uppercase">@yield('page-title')</h4>
    <div class="d-flex">
        <div class="dropdown d-none d-lg-inline-block ms-1">
        </div>
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div style="display: inline-block">
                    <img style="display: flex" class="rounded-circle header-profile-user" src="{{ isset(Auth::user()->avatar) ? asset('/uploads/user/' . Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                        alt="Header Avatar">
                </div>
                <div style="display: inline-block">
                    <div>
                        <span>SUFIAN ABU ALABBAN</span>
                    </div>
                    <div>
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->name)}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </div>

                </div>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{route('changeProfile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">My Profile</span></a>
                <a class="dropdown-item d-block" href="{{route('change_password')}}"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Change Password</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
</header>
