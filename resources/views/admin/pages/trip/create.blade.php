@extends('admin.layouts.master')
@section('title') Add Trip @endsection
@section('page-title') {{__('add trip')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link href="{{ URL::asset('/assets/libs/admin/style.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" autocomplete="off" action="" id="custom-form">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (en)')}}</label>
                                    <input type="text" class="form-control" minlength="1" maxlength="100" name="name_en" required>
                                </div>
                                <div class="mb-3 select-validation">
                                    <label><span class="custom-val-color">*</span> {{__('client')}}</label>
                                    <select class="form-select" name="client" id="client" required>
                                        <option value="">{{__('Select Client')}}</option>
                                        @foreach($client as $row)
                                        <option value="{{$row->id}}">{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" maxlength="250" rows="5" name="details"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (ar)')}}</label>
                                    <input type="text" class="form-control" name="name_ar" minlength="1" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('trip type')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="trip_type"
                                                    id="trip_type_1" checked value = "1" >
                                                <label class="form-check-label text-capitalize" for="trip_type_1">
                                                    {{__('periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="trip_type"
                                                    id="trip_type_1" checked value = "1" >
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
                                                    id="trip_type_2" value = "0" >
                                                <label class="form-check-label text-capitalize" for="trip_type_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="trip_type"
                                                    id="trip_type_2" value = "0" >
                                                <label class="form-check-label labelRight1 text-capitalize" for="trip_type_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class = "mb-3" id="freqdiv">
                                    <label class="form-label"><span class="custom-val-color">*</span>
                                        {{__('trip frequancy')}}
                                    <span class = "font-size-10 mb-1 text-uppercase" >[{{__('only for periodic trip')}}]</span></label>
                                    <div class = "row border rounded border-secondary" id="daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-warning">
                                                        <input class="form-check-input" type="checkbox" id="select_all" />
                                                        <label class="form-check-label" for="select_all">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{__('Choose One or More')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_1" name="trip_frequancy[]"
                                                    value = "1">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_1">
                                                    {{__('sunday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_2" name="trip_frequancy[]"
                                                     value = "2" >
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_2">
                                                    {{__('monday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_3" name="trip_frequancy[]"
                                                    value = "3">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_3">
                                                    {{__('tuesday')}}
                                                </label>
                                            </div>

                                        </div>
                                        <div class = "col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_4" name="trip_frequancy[]"
                                                    value = "4">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_4">
                                                    {{__('wednesday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_5" name="trip_frequancy[]"
                                                    value = "5">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_5">
                                                    {{__('thursday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_6" name="trip_frequancy[]"
                                                    value = "6">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_6">
                                                    {{__('friday')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_7" name="trip_frequancy[]"
                                                    value = "7">
                                                <label class="form-check-label text-capitalize" for="trip_frequancy_7">
                                                    {{__('saturday')}}
                                                </label>
                                            </div>
                                        </div>
                                        <input type="checkbox" value="" id="validateBox" style="display: none" required>

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
                                    <div class="input-group date" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="startdate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="first_trip_date" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('origin')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6 select-validation">
                                            <select class="form-select" name="origin_city" id="origin_city" required>
                                                <option value="">{{__('Select City')}}</option>
                                                @foreach($city as $row)
                                                <option value="{{$row->id}}">{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6 select-validation">
                                            <select class="form-select" name="origin_area" id="origin_area" required>
                                                <option value="">{{__('Select Area')}}</option>
                                                @foreach($area as $row)
                                                <option value="{{$row->id}}">{{$row->area_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <label for=""><span class = "custom-val-color">*</span> {{__('departure time')}}</label>
                                    <div class="input-group" id="timepicker-input-group1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="starttime-div">
                                            <input id="starttime" type="text" class="form-control" data-provide="timepicker" name = "departure_time" required>
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
                                                    id="status_1" value = "1" checked>
                                                <label class="form-check-label text-capitalize" for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="status"
                                                    id="status_1" value = "1" checked>
                                                <label class="form-check-label labelRight1 text-capitalize" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value = "0">
                                                <label class="form-check-label text-capitalize" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="status"
                                                    id="status_2" value = "0">
                                                <label class="form-check-label labelRight1 text-capitalize" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> SHOW TRIP IN ADMIN APP</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_1" value = "1" checked>
                                                <label class="form-check-label" for="show_trip_admin_1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_2" value = "0">
                                                <label class="form-check-label" for="show_trip_admin_2">
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
                                    <div class="input-group date" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="enddate-div">
                                            <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="enddate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="last_trip_date" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('destination')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6 select-validation" >
                                            <select class="form-select" name="destination_city" id ="destination_city" required>
                                                <option value="">{{__('Select City')}}</option>
                                                @foreach($city as $row)
                                                <option value="{{$row->id}}">{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6 select-validation">
                                            <select class="form-select" name="destination_area" id ="destination_area" required>
                                                <option value="">{{__('Select Area')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <label for=""><span class = "custom-val-color">*</span> {{__('arrival time')}}</label>
                                    <div class="input-group" id="timepicker-input-group1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="endtime-div">
                                            <input id="endtime" type="text" class="form-control" data-provide="timepicker" name = "arrival_time" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="btnback">{{__('BACK')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('SAVE')}}</button>
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
    <script src="{{ URL::asset('/assets/admin/trip/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>

        $("#btnback").on('click', function() {
            history.back();
        })
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

        $('div#daysofweek input[type="checkbox"]').on("change",updateStatus);

        $(document).ready(function(){
	    $('#client').select2();
        $('#origin_city').select2();
        $('#origin_area').select2();
        $('#destination_city').select2();
        $('#destination_area').select2();
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
            var starttime = $('#starttime').timepicker({
             format: 'HH.MM'
            });
            var endtime = $('#endtime').timepicker({
             format: 'HH.MM'
            });
            $('#startdate').datepicker({
                format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
            });
            $('#enddate').datepicker({
                format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
            });
             $( "#startdate" ).on( "change", function() {
                var date = new Date();
                $("#enddate").click();
                var setval = $(this).datepicker('getDate');
                if(document.getElementById('trip_type_1').checked == false) {
                    if (date > setval) {
                        $('#enddate').datepicker('setStartDate', date);
                    } else {
                        $('#enddate').datepicker('setStartDate', setval);
                    }
                } else {
                    date.setDate(date.getDate() + 1);
                    if(date > setval) {
                        $('#enddate').datepicker('setStartDate', date);
                    } else {
                        $('#enddate').datepicker('setStartDate', setval);
                    }
                }

                $("#startdate-div").children("ul").removeClass("filled");
                $("#startdate-div").children("input").removeClass( "parsley-error" );
            });

            //  setEnd date
            $( "#enddate" ).on( "change", function() {
                var date = new Date()
                $("#startdate").click();
                var setval = $(this).datepicker('getDate');
                if(document.getElementById('trip_type_1').checked == false) {
                    if (date > setval) {
                        $('#startdate').datepicker('setEndDate', date);
                    } else {
                        $('#startdate').datepicker('setEndDate', setval);
                    }
                } else {
                    setval.setDate(setval.getDate() - 1);
                    $('#startdate').datepicker('setEndDate', setval);
                }
                // $('#startdate').datepicker('setEndDate',setval);

                $("#enddate-div").children("ul").removeClass("filled");
                $("#enddate-div").children("input").removeClass( "parsley-error" );
            });

            // validate
            $(".reset-btn").click(function(){
            // $( ".parsley-errors-list.filled" ).hide();
            location.reload();
            });

            $('#custom-form').submit(function(e){
                // $( ".parsley-errors-list.filled" ).show();

            });
            // display days of week
            $("#trip_type_2").on("change", function (e) {
                // $("#startdate").val("");
                // $("#enddate").val("");
                var dd = new Date();

                // console.log(dd.getDate() + "/" + (dd.getMonth() + 1) + "/" + dd.getFullYear());
                // $('#startdate').datepicker({
                //     format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}",
                //     startDate: dd
                // });
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
                // $("#startdate").val("");
                // $("#enddate").val("");
                if (document.getElementById('trip_type_1').checked) {
                    var formInputs = $("#daysofweek :input");
                    formInputs.each(function(index) {
                        $(this).prop( "disabled", false );
                        $(this).prop('readonly', false);
                    });
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
            })

            function selectFunction(select, id){
                show_url = "{{route('admin.trip.area', ':trip')}}";
                show_url = show_url.replace(':trip', id);
                if(id == "") {
                    
                    show_url = "{{route('admin.trip.areaAll')}}";
                    alert(show_url)
                }
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: show_url,
                    method: 'get',
                    success: function (res) {
                        result = res.data;
                        if(result){
                            select.empty();
                            select.append("<option value=''>Select Area</option>");
                            for(i=0; i<result.length; i++ ){
                                select.append('<option value="'+result[i].id+'">'+result[i].area_name_en+'</option>');
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
        });
    </script>
@endsection
