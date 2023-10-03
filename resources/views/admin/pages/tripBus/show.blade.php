@extends('admin.layouts.master')
@section('title') View Trip's Bus @endsection
@section('page-title') {{__("View Trip's Bus")}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><span class="custom-val-color"></span> {{__('Client')}}
                                </label>
                                <input type="text" class="form-control" id="client" value="{{app()->getLocale()=='jor'?$client_name[0]->name_ar:$client_name[0]->name_en}}" disabled>
                            </div>
                            <div class="mb-3 add-new-form">
                                <label class="form-label">{{__('trip type')}} </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning mb-3">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" disabled type="radio" checked>
                                            <label class="form-check-label text-capitalize">
                                            {{__('periodic')}}
                                            </label>
                                            @else
                                            <input class="form-check-input radioRight" disabled type="radio" checked>
                                            <label class="form-check-label labelRight text-capitalize">
                                            {{__('periodic')}}
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" disabled type="radio">
                                            <label class="form-check-label text-capitalize">
                                            {{__('non-periodic')}}
                                            </label>
                                            @else
                                            <input class="form-check-input radioRight" disabled type="radio">
                                            <label class="form-check-label text-capitalize">
                                            {{__('non-periodic')}}
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>{{__('bus size')}}</label>
                                <select class="form-select" name="bus_size">
                                    <option>Select Bus Size</option>
                                    @foreach($bus_size as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->bus_size == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>{{__('driver name')}}</label>
                                <select class="form-select" name="driver_name">
                                    <option>Select Driver Name</option>
                                    @foreach($driver as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->driver_name == $row->id ? 'selected' :''}}>{{$row->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color"></span>     {{__('trip frequancy')}}
                                    <span class = "font-size-10 mb-1" >[{{__('only for periodic trip')}}]</span></label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            {{__('choose one or more')}}
                                        </div>
                                        <div class = "col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_1" name = "trip_frequancy[]"
                                                    value = "1" checked>
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_1">
                                                    {{__('sunday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_2" name = "trip_frequancy[]"
                                                     value = "2" >
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_2">
                                                    {{__('monday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_3" name = "trip_frequancy[]"
                                                    value = "3">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_3">
                                                    {{__('tuesday')}}
                                                </label>
                                            </div>

                                        </div>
                                        <div class = "col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_4" name = "trip_frequancy[]"
                                                    value = "4">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_4">
                                                    {{__('wednesday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_5" name = "trip_frequancy[]"
                                                    value = "5">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_5">
                                                    {{__('thursday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_6" name = "trip_frequancy[]"
                                                    value = "6">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_6">
                                                    {{__('friday')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_7" name = "trip_frequancy[]"
                                                    value = "7">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_7">
                                                    {{__('saturday')}}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>{{__('trip name')}} </label>
                                <select class="form-select" name="trip_name">
                                    <option>Select Trip Name</option>
                                    @foreach($trip as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->trip_name == $row->id ? 'selected' :''}}>
                                            {{app()->getLocale()=='jor'?$row->trip_name_ar:$row->trip_name_en}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 add-new-form">
                                <label class="form-label"><span class="custom-val-color"></span> {{__('is fake')}} </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning mb-3">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" type="radio" name="fake"
                                                id="fake_1" value = "1">
                                            <label class="form-check-label text-capitalize" for="fake_1">
                                                {{__('yes')}}
                                            </label>
                                            @else
                                            <input class="form-check-input radioRight" type="radio" name="fake"
                                                id="fake_1" value = "1">
                                            <label class="form-check-label labelRight text-capitalize" for="fake_1">
                                                {{__('yes')}}
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" type="radio" name="fake"
                                                id="fake_2" value = "0" checked>
                                            <label class="form-check-label text-capitalize" for="fake_2">
                                                {{__('no')}}
                                            </label>
                                            @else
                                            <input class="form-check-input radioRight" type="radio" name="fake"
                                                id="fake_2" value = "0" checked>
                                            <label class="form-check-label labelRight text-capitalize" for="fake_2">
                                                {{__('no')}}
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><span class="custom-val-color"></span> {{__('bus no.')}} </label>
                                <select class="form-select" name="bus_no" id="busno" required>
                                    <option value="">{{__('Select bus no.')}}</option>
                                    @foreach($bus_no as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->bus_no == $row->id ? 'selected' :''}}>{{$row->bus_no}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class = "mb-3 add-new-form">
                                <label class="form-label"><span class="custom-val-color"></span> {{__('supervisor')}}
                                </label>
                                <div class = "row border rounded border-secondary daysofweek">
                                    <div class = "trip-frequency-check">
                                        {{__('Choose One or More')}}
                                    </div>
                                    <div class = "col-md-12">
                                        @foreach($supervisor as $row)
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                    value = "{{$row->id}}">
                                                <label class="form-check-label" for="supervisor_{{$row->id}}">
                                                    {{$row->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('status')}}</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning mb-3">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_1" value = "1" {{$trip_bus->status == 1 ? 'checked' :''}}>
                                            <label class="form-check-label text-capitalize" for="status_1">
                                            {{__('active')}}
                                            </label>
                                            @else
                                            <input class="form-check-input radioRight" type="radio" name="status"
                                                id="status_1" value = "1" {{$trip_bus->status == 1 ? 'checked' :''}}>
                                            <label class="form-check-label labelRight text-capitalize" for="status_1">
                                            {{__('active')}}
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning">
                                            @if(Session::get('lang') != 'jor')
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_2" value = "0" {{$trip_bus->status == 0 ? 'checked' :''}}>
                                            <label class="form-check-label text-capitalize" for="status_2">
                                            {{__('inactive')}}
                                            @else
                                            <input class="form-check-input radioRight" type="radio" name="status"
                                                id="status_2" value = "0" {{$trip_bus->status == 0 ? 'checked' :''}}>
                                            <label class="form-check-label labelRight text-capitalize" for="status_2">
                                            {{__('inactive')}}
                                            @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-8" style="padding-top: 10vw;">
                    <img src="{{ URL::asset ('/images/admin/add-bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<!-- <script src="{{ URL::asset('/assets/admin/tripBus/edit.js') }}"></script> -->
<script>
    $(document).ready(function(){
        store = "{{route('admin.trip_bus.update', ['trip_bu' => $trip_bus->id])}}";
        list_url = "{{route('admin.trip_bus.index')}}";


        // disable element
        var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }
            // end disable element

            var backbtn = document.getElementById("backbtn");
        backbtn.disabled = false;

        $("#backbtn").click(function() {
            history.back();
        })
    });
</script>
@endsection
