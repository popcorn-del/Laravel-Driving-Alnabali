@extends('admin.layouts.master')
@section('title') Edit Trip @endsection
@section('page-title') {{__('edit trip')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/admin/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <input type="hidden" name="id" value="{{$trip->id}}" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (en)')}}</label>
                                    <input type="text" class="form-control" name="name_en" minlength="1" maxlength="100" required value="{{$trip->trip_name_en}}">
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('client')}}</label>
                                    <select class="form-select" name="client" id="client">
                                        <option value="">Select Client</option>
                                        @foreach($client as $row)
                                        <option value="{{$row->id}}" {{$trip->client_id == $row->id ? 'selected' :''}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" maxlength="250" name="details" value = "{{ $trip->details}}"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (ar)')}}</label>
                                    <input type="text" class="form-control" minlength="1" maxlength="100" name="name_ar" required value="{{$trip->trip_name_ar}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('trip type')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="trip_type"
                                                    id="trip_type_1"  value = "1" {{$trip->trip_type == 1 ? 'checked' :''}} >
                                                <label class="form-check-label text-capitalize" for="trip_type_1">
                                                    {{__('periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="trip_type"
                                                    id="trip_type_1"  value = "1" {{$trip->trip_type == 1 ? 'checked' :''}} >
                                                <label class="form-check-label labelRight1 text-capitalize" for="trip_type_1">
                                                    {{__('periodic')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="trip_type"
                                                    id="trip_type_2" value = "0" {{$trip->trip_type == 0 ? 'checked' :''}} >
                                                <label class="form-check-label text-capitalize" for="trip_type_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="trip_type"
                                                    id="trip_type_2" value = "0" {{$trip->trip_type == 0 ? 'checked' :''}} >
                                                <label class="form-check-label labelRight1 text-capitalize" for="trip_type_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class = "mb-3" id="freqid">
                                    <label class="form-label"><span class="custom-val-color">*</span>
                                        {{__('trip frequancy')}}
                                    <span class = "font-size-10 mb-1" >[{{__('only for periodic trip')}}]</span></label>
                                    <div class = "row border rounded border-secondary"  id="daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-warning">
                                                        <input class="form-check-input" type="checkbox" id="select_all" {{$trip->trip_frequancy == '["1","2","3","4","5","6","7"]' ? "checked":""}}/>
                                                        <label class="form-check-label" for="select_all">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{__('Choose One or More')}}
                                                </div>
                                            </div>
                                        </div>
                                        @if ($trip->trip_type == 1)
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor1" name = "trip_frequancy[]"
                                                        value = "1" {{in_array("1", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor1">
                                                        {{__('sunday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor2" name = "trip_frequancy[]"
                                                        value = "2" {{in_array("2", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor2">
                                                        {{__('monday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor3" name = "trip_frequancy[]"
                                                        value = "3" {{in_array("3", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor3">
                                                        {{__('tuesday')}}
                                                    </label>
                                                </div>

                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor4" name = "trip_frequancy[]"
                                                        value = "4" {{in_array("4", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor4">
                                                        {{__('wednesday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor5" name = "trip_frequancy[]"
                                                        value = "5" {{in_array("5", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor5">
                                                        {{__('thursday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor6" name = "trip_frequancy[]"
                                                        value = "6" {{in_array("6", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor6">
                                                        {{__('friday')}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor7" name = "trip_frequancy[]"
                                                        value = "7" {{in_array("7", (json_decode($trip->trip_frequancy)??[])) == true ? "checked" : ""}}>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor7">
                                                        {{__('saturday')}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($trip->trip_type == 0)
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor1" name = "trip_frequancy[]"
                                                        value = "1" readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor1">
                                                        {{__('sunday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor2" name = "trip_frequancy[]"
                                                        value = "2"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor2">
                                                        {{__('monday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor3" name = "trip_frequancy[]"
                                                        value = "3"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor3">
                                                        {{__('tuesday')}}
                                                    </label>
                                                </div>

                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor4" name = "trip_frequancy[]"
                                                        value = "4"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor4">
                                                        {{__('wednesday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor5" name = "trip_frequancy[]"
                                                        value = "5"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor5">
                                                        {{__('thursday')}}
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor6" name = "trip_frequancy[]"
                                                        value = "6"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor6">
                                                        {{__('friday')}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="formCheckcolor7" name = "trip_frequancy[]"
                                                        value = "7"  readonly='true' disabled>
                                                    <label class="form-check-label text-capitalize" for="formCheckcolor7">
                                                        {{__('saturday')}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        <input type="checkbox" value="" id="validateBox" style="display: none;" {{$trip->trip_type == 0?'':'required'}}>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class = "col-md-12">
                        <div class = "row">
                            <div class = "col-md-6">
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('date of first trip')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="startdate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="first_trip_date" required value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($trip->first_trip_date))}}">
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('origin')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_city" id ="origin_city" required>
                                                <option value="">{{__('Select City')}}</option>
                                                @foreach($city as $row)
                                                <option value="{{$row->id}}" {{$trip->origin_city == $row->id ? 'selected' :''}} >{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_area" id ="origin_area" required>
                                                <option value="">{{__('Select Area')}}</option>
                                                @foreach($area as $row)
                                                <option value="{{$row->id}}" {{$trip->origin_area == $row->id ? 'selected' :''}} >{{$row->area_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <label for=""><span class = "custom-val-color">*</span> {{__('departure time')}}</label>
                                    <div class="input-group" id="timepicker-input-group1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="starttime-div">
                                            <input id="starttime" type="text" class="form-control" data-provide="timepicker" name = "departure_time" value = "{{ $trip->departure_time}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value = "1" {{$trip->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label text-capitalize" for="status_1" style="margin-right: 3rem; float: right;">
                                                    {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="status"
                                                    id="status_1" value = "1" {{$trip->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight1 text-capitalize" for="status_1" style="margin-right: 3rem; float: right;">
                                                    {{__('active')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value = "0" {{$trip->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_2 text-capitalize" style="margin-right: 2rem; float: right;">
                                                    {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="status"
                                                    id="status_2" value = "0" {{$trip->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight1 text-capitalize" for="status_2" style="margin-right: 2rem; float: right;">
                                                    {{__('inactive')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>SHOW TRIP IN ADMIN APP</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_1" value = "1" {{$trip->admin_show == 1 ? 'checked' :''}}  >
                                                <label class="form-check-label" for="status_1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_2" value = "0" {{$trip->admin_show == 0 ? 'checked' :''}} >
                                                <label class="form-check-label" for="status_2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class = "col-md-6">
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('date of last trip')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="enddate-div">
                                            <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="enddate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="last_trip_date" required value = "{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($trip->last_trip_date))}}">
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('destination')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_city" id ="destination_city" required>
                                                <option value="">{{__('Select City')}}</option>
                                                @foreach($city as $row)
                                                <option value="{{$row->id}}" {{$trip->destination_city == $row->id ? 'selected' :''}} >{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_area" id ="destination_area" required>
                                                <option value="">{{__('Select Area')}}</option>
                                                @foreach($area as $row)
                                                <option value="{{$row->id}}" {{$trip->destination_area == $row->id ? 'selected' :''}} >{{$row->area_name_en}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <label for=""><span class = "custom-val-color">*</span> {{__('arrival time')}}</label>
                                    <div class="input-group" id="timepicker-input-group1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="endtime-div">
                                            <input id="endtime" type="text" class="form-control" data-provide="timepicker" name = "arrival_time" value = "{{ $trip->arrival_time }}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- status  -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                <button type="button" id="submit" class="btn btn-primary waves-effect waves-light">{{__('SAVE')}}</button>
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
    <script src="{{ URL::asset('/assets/admin/trip/edit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
       $(document).ready(function(){
        $('#client').select2();
        $('#origin_city').select2();
        $('#origin_area').select2();
        $('#destination_city').select2();
        $('#destination_area').select2();
        function updateStatus(){
            if ($('div#daysofweek input:checked').length > 0 ){
                $("#freqdiv").children("ul").removeClass("filled");
                $("#freqdiv").children("input").removeClass( "parsley-error" );
                jQuery('#validateBox').prop('checked', true);
            }
            else {
                let $allCheckCount = jQuery('#daysofweek').find('input[type="checkbox"]:checked').not('#validateBox').length
                if($allCheckCount == 0) { jQuery('#validateBox').prop('checked', false); } else { jQuery('#validateBox').prop('checked', true); }
            }
        }
        $("#select_all").click(function () {
            // Check/uncheck all checkboxes based on the "Select All" checkbox state
            $("input[name='trip_frequancy[]']").prop("checked", this.checked);

        });

        // When any day checkbox is clicked
        $("input[name='trip_frequancy[]']").click(function () {
            // Check if all day checkboxes are checked and update "Select All" accordingly
            if ($("input[name='trip_frequancy[]']:checked").length === $("input[name='trip_frequancy[]']").length) {
                $("#select_all").prop("checked", true);
            } else {
                $("#select_all").prop("checked", false);
            }

            // Save and print selected values
            var selectedValues = [];
            $("input[name='trip_frequancy[]']:checked").each(function () {
                selectedValues.push($(this).val());
            });

            // Print selected values (you can modify this part as needed)
            console.log("Selected Values: " + selectedValues.join(", "));
        });
        updateStatus();
        $('div#daysofweek input[type="checkbox"]').on("change",updateStatus);

        $("#backbtn").click(() => {
            history.back();
        })
        // validate
        $(".reset-btn").click(function(){
            // $( ".parsley-errors-list.filled" ).hide();
            location.reload();
        });


            // end validate
        $('#startdate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
        });
        $('#enddate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
        });
         //  setStart date
         $( "#startdate" ).on( "change", function() {
            $("#enddate").click();
            var setval = $(this).datepicker('getDate');

            if(document.getElementById('trip_type_1').checked == false) {
                $('#enddate').datepicker('setStartDate', setval);
            } else {
                $('#enddate').datepicker('setStartDate', new Date(setval.getFullYear() + '-' + (setval.getMonth() + 1) + '-' + (setval.getDate() + 1)));
            }
            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });

        //  setEnd date
        $( "#enddate" ).on( "change", function() {
            $("#startdate").click();
            var setval = $(this).datepicker('getDate');
            if(document.getElementById('trip_type_1').checked == false) {
                $('#startdate').datepicker('setEndDate', setval);
            } else {
                $('#startdate').datepicker('setEndDate', new Date(setval.getFullYear() + '-' + (setval.getMonth() + 1) + '-' + (setval.getDate() - 1)));
            }

            $("#enddate-div").children("ul").removeClass("filled");
            $("#enddate-div").children("input").removeClass( "parsley-error" );
        });

        //  setStart time
        // $( "#starttime" ).on( "change", function() {
        //     $("#starttime-div").children("ul").removeClass("filled");
        //     $("#starttime-div").children("input").removeClass( "parsley-error" );
        // });

        // $( "#endtime" ).on( "change", function() {
        //     var endtime = $(this).val();
        //     var starttime = $('#starttime').val();
        //     if (starttime > endtime) {
        //         $( "#endtime" ).timepicker('setTime', starttime);
        //     }

        //     $("#endtime-div").children("ul").removeClass("filled");
        //     $("#endtime-div").children("input").removeClass( "parsley-error" );
        // });

            // // display days of week
            // $("#trip_type_2").on("change", function (e) {
            //     if (document.getElementById('trip_type_2').checked) {
            //         $('#daysofweek input').prop('checked', false); // Unchecks it
            //         $("#daysofweek").hide();
            //     }
            // })

            // $("#trip_type_1").on("change", function (e) {
            //     if (document.getElementById('trip_type_1').checked) {
            //         $("#daysofweek").show();
            //     }
            // })

            // display days of week
            $("#trip_type_2").on("change", function (e) {
                // $("#startdate").val("");
                // $("#enddate").val("");
                if (document.getElementById('trip_type_2').checked) {
                    var formInputs = $("#daysofweek :input");
                    formInputs.each(function(index) {
                        $(this).prop( "disabled", true );
                        $(this).prop('readonly', true);
                    });
                    document.getElementById("validateBox").required = false;
                } else {
                    document.getElementById("validateBox").required = true;
                }
            })

            $("#trip_type_1").on("change", function (e) {
                if (document.getElementById('trip_type_1').checked) {
                    var formInputs = $("#daysofweek :input");
                    formInputs.each(function(index) {
                        $(this).prop( "disabled", false );
                        $(this).prop('readonly', false);
                    });
                    document.getElementById("validateBox").required = true;
                }else{
                    document.getElementById("validateBox").required = false;
                }
            })

            store = "{{route('admin.trip.store')}}";
            list_url = "{{route('admin.trip.index')}}";
            origin_area = $("select[name='origin_area']");
            destination_area = $("select[name='destination_area']");

            // display area when click origin_city
            $("select[name='origin_city']").on("change", function (e) {
                var id = $(e.currentTarget).val();
                if (id == "") {
                    origin_area.empty();
                    origin_area.append("<option value=''>Select Area</option>");
                }
                selectFunction(origin_area, id)
            })
            // display area when click destination_area
            $("select[name='destination_city']").on("change", function (e) {
                var id = $(e.currentTarget).val();
                if (id == "") {
                    destination_area.empty();
                    destination_area.append("<option value=''>Select Area</option>");
                }
                selectFunction(destination_area, id)
            });

            function selectFunction(select, id){
                show_url = "{{route('admin.trip.area', ':trip')}}";
                show_url = show_url.replace(':trip', id);
                $.ajax({
                    url: show_url,
                    method: 'get',
                    success: function (res) {
                        result = res.data;
                        if(result){
                            select.empty();
                            select.append("<option>Select Area</option>");
                            for(i=0; i<result.length; i++ ){
                                select.append('<option value="'+result[i].area_name_en+'">'+result[i].area_name_en+'</option>');
                            }
                        }
                    },
                    error: function (res){
                        console.log(res)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            }

            $('#submit').click(e => {
                var radios = document.querySelectorAll('input[name="status"]');
                var selectedValue;

                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        selectedValue = radios[i].value;
                        break;
                    }
                }
                if(selectedValue == 0)
                {
                    if(!confirm($('#arc_trip_inactive').val()))
                        return;
                }
                $('#custom-form').submit();
            });
        });
    </script>
@endsection
