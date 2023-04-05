@extends('admin.layouts.master')
@section('title') Dashboard @endsection
@section('page-title') {{__('dashboard')}} @endsection
@section('css')
    <!-- <link href="{{ URL::asset('/assets/admin/pages/vehicle/style.css') }}" rel="stylesheet" type="text/css" /> -->
@endsection
@section('content')
    <div class="content-warpper">
        <!-- widged area -->
        <div class="row">
            <div class="col">
                <div class="card mini-stats-wid">
                    <div class="card-bg card-bg-color-1">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">{{__('clients')}}</p>
                                    <h4 class="mb-0">{{$client}}</h4>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                    <span class="avatar-title">
                                        <i class="bx bxs-user-detail font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mini-stats-wid">
                    <div class="card-bg card-bg-color-2">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">{{__('drivers')}}</p>
                                    <h4 class="mb-0">{{$driver}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-ship font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mini-stats-wid">
                    <div class="card-bg card-bg-color-3">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">{{__('buses')}}</p>
                                    <h4 class="mb-0">{{$bus}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-bus font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mini-stats-wid">
                    <div class="card-bg card-bg-color-4">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">{{__('trips')}}</p>
                                    <h4 class="mb-0">{{$trip}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-briefcase-alt-2 font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mini-stats-wid">
                    <div class="card-bg card-bg-color-5">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted fw-medium">{{__('daily trips')}}</p>
                                    <h4 class="mb-0">{{$dailytrip}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bxs-eraser font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- chart area -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-chart">
                            <h4 class="card-title mb-4">{{__('daily trips')}}</h4>
                            <div class="chart-dropdown">
                                <select class="form-select" id="chart-select">
                                    <option selected="">{{__('last 7 days')}}</option>
                                    <option value="1">{{__('one')}}</option>
                                    <option value="2">{{__('two')}}</option>
                                    <option value="3">{{__('three')}}</option>
                                </select>
                            </div>
                        </div>

                        <div id="line_chart_dashed" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{__('daily trips')}}</h4>

                        <div id="column_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/apexcharts.init.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

@endsection
