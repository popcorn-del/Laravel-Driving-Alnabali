@extends('admin.layouts.master')
@section('title') View Trip's Bus @endsection
@section('page-title') View Trip's Bus @endsection
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
                                <label>TRIP NAME </label>
                                <select class="form-select" name="trip_name">
                                    <option>Select Trip Name</option>
                                    @foreach($trip as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->trip_name == $row->id ? 'selected' :''}}>
                                            {{app()->getLocale()=='jor'?$row->trip_name_ar:$row->trip_name_en}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>BUS SIZE </label>
                                <select class="form-select" name="bus_size">
                                    <option>Select Bus Size</option>
                                    @foreach($bus_size as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->bus_size == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>DRIVER NAME </label>
                                <select class="form-select" name="driver_name">
                                    <option>Select Driver Name</option>
                                    @foreach($driver as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->driver_name == $row->id ? 'selected' :''}}>{{$row->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">STATUS</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning mb-3">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_1" value = "1" {{$trip_bus->status == 1 ? 'checked' :''}}>
                                            <label class="form-check-label" for="status_1">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_2" value = "0" {{$trip_bus->status == 0 ? 'checked' :''}}>
                                            <label class="form-check-label" for="status_2">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 add-new-form">
                                <label class="form-label"><span class="custom-val-color">*</span> TRIP TYPE </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning mb-3">
                                            <input class="form-check-input" disabled type="radio" checked>
                                            <label class="form-check-label">
                                                Periodic
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-radio-warning">
                                            <input class="form-check-input" disabled type="radio">
                                            <label class="form-check-label">
                                                Non-Periodic
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>BUS NO </label>
                                <select class="form-select" name="bus_no">
                                    <option>Select Bus No</option>
                                    @foreach($bus_no as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->bus_no == $row->id ? 'selected' :''}}>{{$row->bus_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>SUPERVISOR NAME </label>
                                <select class="form-select" name="supervisor_name" id="supervisorname" required>
                                    <option value=''>Select Supervisor Name</option>
                                    @foreach($supervisor as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->supervisor_name == $row->id ? 'selected' :''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-8" style="padding-top: 10vw;">
                    <img src="{{ URL::asset ('/images/admin/add-bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">Back</button>
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
