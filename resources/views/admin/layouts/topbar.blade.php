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
                        <span>{{Auth::user()->name}}</span>
                    </div>
                    <div>
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                            @if(ucfirst(Auth::user()->role) == 1){{ __('super admin') }}
                            @elseif(ucfirst(Auth::user()->role) == 2){{ __('admin')}}
                            @else {{__('editor')}}
                            @endif</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </div>
                </div>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{route('changeProfile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">{{ __('My Profile')}}</span></a>
                <a class="dropdown-item d-block" href="{{route('change_password')}}"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">{{ __('Change Password')}}</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">{{ __('Logout')}}</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="arc_show" value="{{__('SHOW')}}">
<input type="hidden" class="arc_search" id="arc_search" value="{{__('SEARCH')}}">
<input type="hidden" id="arc_entries" value="{{__('Entries')}}">
<input type="hidden" id="arc_next" value="{{__('Next')}}">
<input type="hidden" id="arc_previous" value="{{__('Previous')}}">
<input type="hidden" id="arc_showing" value="{{__('Showing')}}">
<input type="hidden" id="arc_to" value="{{__('to')}}">
<input type="hidden" id="arc_of" value="{{__('of')}}">
<input type="hidden" id="arc_showing" value="{{__('Showing')}}">
<input type="hidden" id="arc_nodata" value="{{__('No data')}}">
<input type="hidden" id="arc_norecord" value="{{__('No records available')}}">
<input type="hidden" id="arc_filterfrom" value="{{__('filtered from')}}">
<input type="hidden" id="arc_totalrecord" value="{{__('total records')}}">
<input type="hidden" id="arc_completed" value="{{__('COMPLETED')}}">
<input type="hidden" id="arc_canceled" value="{{__('CANCELED')}}">
<input type="hidden" id="arc_total" value="{{__('TOTAL')}}">
<input type="hidden" id="arc_sun" value="{{__('SUN')}}">
<input type="hidden" id="arc_mon" value="{{__('MON')}}">
<input type="hidden" id="arc_tue" value="{{__('TUE')}}">
<input type="hidden" id="arc_wed" value="{{__('WED')}}">
<input type="hidden" id="arc_thu" value="{{__('THU')}}">
<input type="hidden" id="arc_fri" value="{{__('FRI')}}">
<input type="hidden" id="arc_sat" value="{{__('SAT')}}">
<input type="hidden" id="arc_thousand" value="{{__('thousands')}}">
<input type="hidden" id="arc_success" value="{{__('success')}}">
<input type="hidden" id="arc_client_inactive" value="{{__('client_inactive')}}">
<input type="hidden" id="arc_trip_inactive" value="{{__('trip_inactive')}}">
<input type="hidden" id="arc_driver_inactive" value="{{__('driver_inactive')}}">
<input type="hidden" id="arc_bus_inactive" value="{{__('bus_inactive')}}">
<input type="hidden" id="arc_close_message" value="{{__('close_message')}}">
<input type="hidden" id="arc_crash_message" value="{{__('crash_message')}}">
</header>
