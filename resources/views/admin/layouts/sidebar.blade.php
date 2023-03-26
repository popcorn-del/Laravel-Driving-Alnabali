<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="border-radius: 0px 20px 0px 0px;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('root')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset ('/images/admin/logo-sm.png') }}" alt="" width="100%">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset ('/images/admin/logo-large.png') }}" alt="" width="101%">
            </span>
        </a>
    </div>
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('root')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>{{__('dashboard')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.client.index')}}" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span>{{__('clients')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.driver.index')}}" class="waves-effect">
                        <i class="bx bxs-ship"></i>
                        <span>{{__('drivers')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.bus.index')}}" class="waves-effect">
                        <i class="bx bxs-bus"></i>
                        <span>{{__('buses')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.trip.index')}}" class="waves-effect">
                        <i class="bx bx-aperture"></i>
                        <span>{{__('trips')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.trip_bus.index')}}" class="waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span>{{__('trips buses')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.daily_trip.index')}}" class="waves-effect">
                        <i class="bx bxs-eraser"></i>
                        <span>{{__('daily trips')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.notification.index')}}" class="waves-effect">
                        <i class="bx bx-alarm"></i>
                        <span>{{__('notification')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.transaction.index')}}" class="waves-effect">
                        <i class="bx bx-book-content"></i>
                        <span>{{__('transaction')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.maintenance.index')}}" class="waves-effect" style="white-space: nowrap;">
                        <i class="bx bxs-wrench"></i>
                        <span style="white-space: nowrap;">{{(__('maintenance records'))}}</span>
                    </a>
                </li>
                <li style="display: block;background: transparent  !important;">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" style="margin: unset; padding-left: 2rem;">
                        <i class="bx bx-tone" style="padding-left: 10px;"></i>
                        <span key="t-layouts" style="    padding-left: 7px;">{{__('miscellaneous')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('admin.miscellaneous.city.index')}}"
                                key="t-light-sidebar">{{__('cities')}}</a></li>
                        <li><a href="{{route('admin.miscellaneous.area.index')}}"
                                key="t-compact-sidebar">{{__('areas')}}</a></li>
                        <li><a href="{{route('admin.miscellaneous.bus_type.index')}}"
                                key="t-icon-sidebar">{{__('bus types')}}</a></li>
                        <li><a href="{{route('admin.miscellaneous.bus_model.index')}}" key="t-boxed-width">{{__("bus models")}}</a>
                        </li>
                        <li><a href="{{route('admin.miscellaneous.bus_size.index')}}" key="t-preloader">{{__('bus sizes')}}</a>
                        </li>
                        <li><a href="{{route('admin.miscellaneous.client_type.index')}}"
                                key="t-colored-sidebar">{{__("client types")}}</a></li>
                        <li><a href="{{route('admin.miscellaneous.contract_type.index')}}" key="t-scrollable">{{__('contract types')}}</a></li>
                        <li><a href="{{route('admin.miscellaneous.bus_maintenance.index')}}" key="t-scrollable">{{__('maintenance types')}}</a></li>
                        <li><a href="#" key="t-scrollable"></a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.super_visor.index')}}" class="waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span>{{__('app supervisors')}}</span>
                    </a>
                </li>

                <?php if(Auth::user()->role < 3) { ?>
                    <li>
                        <a href="{{route('admin.user.index')}}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span>{{__('users')}}</span>
                        </a>
                    </li>
                    <li style="display: block;background: transparent  !important;">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" style="margin: unset; padding-left: 2rem;">
                        <i class="bx bx bx-file" style="padding-left: 10px;"></i>
                        <span style="    padding-left: 7px;">{{__('reports')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        <li><a href="{{route('admin.reports.trips_client.index')}}"
                                key="t-light-sidebar">{{__('trips by client')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_bus.index')}}"
                                key="t-compact-sidebar">{{__('trips by bus')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_type.index')}}"
                                key="t-compact-sidebar">{{__('trips by trip type')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_driver.index')}}"
                                key="t-compact-sidebar"> {{__('trips by driver')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_bus_size.index')}}"
                                key="t-compact-sidebar"> {{__('trips by bus size')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_client_type.index')}}"
                                key="t-compact-sidebar"> {{__('trips by client type')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_contract_type.index')}}"
                                key="t-compact-sidebar"> {{__('trips by contract type')}}</a>
                        </li>
                        <li>
                            <a href="{{route('admin.reports.trips_owership.index')}}"
                                key="t-compact-sidebar"> {{__('trips by ownership type')}}</a>
                        </li>
                        <li>
                            <a href="#"
                                key="t-compact-sidebar"></a>
                        </li>
                        <li>
                            <a href="#"
                                key="t-compact-sidebar"></a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li>
                    <a href="{{route('cronjob')}}" class="waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span>{{__('cronjob')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
