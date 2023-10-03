@extends('admin.layouts.master')
@section('title') Edit Trip’s Bus @endsection
@section('page-title') {{__("edit trip's bus")}} @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            <div class="row">
                <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('Client')}}
                                    </label>
                                    <input type="text" class="form-control" id="client" value="{{app()->getLocale()=='jor'?$client_name[0]->name_ar:$client_name[0]->name_en}}" disabled>
                                </div>
                                <div class="mb-3 add-new-form">
                                    <label class="form-label">{{__('trip type')}} </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" disabled id="trip_type1" type="radio" checked>
                                                <label class="form-check-label text-capitalize">
                                                    {{__('periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" disabled id="trip_type1" type="radio" checked>
                                                <label class="form-check-label labelRight text-capitalize">
                                                    {{__('periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" disabled id="trip_type2" type="radio">
                                                <label class="form-check-label text-capitalize">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" disabled id="trip_type2" type="radio">
                                                <label class="form-check-label text-capitalize">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('bus size')}}</label>
                                    <select class="form-select" name="bus_size" id="bussize" required>
                                        <option value="">{{__('Select Bus Size')}}</option>
                                        @foreach($bus_size as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->bus_size == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('driver name')}}</label>
                                    <select class="form-select" name="driver_name" id="drivername" required>
                                        <option value="">{{__('Select Driver Name')}}</option>
                                        @foreach($driver as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->driver_name == $row->id ? 'selected' :''}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color"></span> {{__('trip frequancy')}}
                                    <span class = "font-size-10 mb-1" >[{{__('only for periodic trip')}}]</span></label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-warning">
                                                        <input class="form-check-input" type="checkbox" id="select_all" {{$trip_bus->trip_frequancy == '["1","2","3","4","5","6","7"]' ? "checked":""}}/>
                                                        <label class="form-check-label" for="select_all">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    {{__('Choose One or More')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-md-6" disabled>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_1" name = "trip_frequancy[]"
                                                    value = "1">
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
                                    <label><span class="custom-val-color">*</span> {{__('trip name')}}
                                    </label>
                                    <select class="form-select" name="trip_name" id="tripname">
                                        <option value="">{{__('Select Trip Name')}}</option>
                                        @foreach($trip as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->trip_name == $row->id ? 'selected' :''}}>
                                            {{app()->getLocale()=='jor'?$row->trip_name_ar:$row->trip_name_en}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('is fake')}} </label>
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
                                    <label><span class="custom-val-color">*</span> {{__('bus no.')}} </label>
                                    <select class="form-select" name="bus_no" id="busno" required>
                                        <option value="">{{__('Select Bus No.')}}</option>
                                        @foreach($bus_no as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->bus_no == $row->id ? 'selected' :''}}>{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('supervisor')}}
                                    </label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check form-check-warning">
                                                        <input class="form-check-input" type="checkbox" id="select_all_supervisor" />
                                                        <label class="form-check-label" for="select_all_supervisor">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    {{__('Choose One or More')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-md-12">
                                            @foreach($supervisor as $row)
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                        value = "{{$row->id}}" required>
                                                    <label class="form-check-label text-capitalize" for="supervisor_{{$row->id}}">
                                                        {{$row->name}}
                                                    </label>
                                                </div>
                                            @endforeach
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
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_2" value = "0" {{$trip_bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight text-capitalize" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">

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
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('SAVE')}}</button>
            </div>
        </form>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_header"></h4>
                    </div>
                    <div class="modal-body">
                        <div id="trip_data">
                            <table class="table table-bordered w-100 datatable no-footer dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{__('name')}}</th>
                                        <th>{{__('date of first trip')}}</th>
                                        <th>{{__('date of last trip')}}</th>
                                        <th>{{__('departure time')}}</th>
                                        <th>{{__('arrival time')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="result_trip">

                                </tbody>
                            </table>
                        </div>
                        <div id="check_data">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_close">Close</button>
                    </div>
                </div>

            </div>
        </div>
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
<script src="{{ URL::asset('/assets/admin/tripBus/edit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>

    function isNumeric(str) {
        if (typeof str != "string") return false // we only process strings!
        return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
                !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
    }
    $(document).ready(function(){
        $("#tripname").select2();
        $("#bussize").select2();
        $("#drivername").select2();
        $("#busno").select2();
        store = "{{route('admin.trip_bus.update', ['trip_bu' => $trip_bus->id])}}";
        list_url = "{{route('admin.trip_bus.index')}}";

        trip_url = "{{route('admin.trip_bus.tripname')}}";

        $("#tripname").on('change', () => {checkTrip()});
        $('#busno').change(() => checkTrip('busno'));

        $( "#tripname" ).trigger( "change" );
        $("#backbtn").on('click', () => {
            history.back();
        })

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


        $("#select_all_superversor").click(function () {
            // Check/uncheck all checkboxes based on the "Select All" checkbox state
            $("input[name='supervisor[]']").prop("checked", this.checked);

        });

        // When any day checkbox is clicked
        $("input[name='supervisor[]']").click(function () {
            // Check if all day checkboxes are checked and update "Select All" accordingly
            if ($("input[name='supervisor[]']:checked").length === $("input[name='supervisor[]']").length) {
                // $("#select_all_superversor").prop("checked", true);
            } else {
                // $("#select_all_superversor").prop("checked", false);
            }

            // Save and print selected values
            var selectedValues = [];
            $("input[name='supervisor[]']:checked").each(function () {
                selectedValues.push($(this).val());
            });

            // Print selected values (you can modify this part as needed)
            console.log("Selected Values: " + selectedValues.join(", "));
        });

        $("#bussize").on('change', () => {
            let id = $("#bussize").val();
            tripbus_url = "{{ route('admin.tripbus.busno',':id') }}";
            tripbus_url = tripbus_url.replace(':id', id);
            if (id != "") {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'get',
                    dataType:'JSON',
                    url:tripbus_url,
                    success: function(res){
                        $("select[name='bus_no']").empty();
                        $("select[name='bus_no']").append("<option value=''>Select Bus NO.</option>")
                        let result = res.data;
                        for (let i = 0, mlength = result.length ; i < mlength; i++) {
                            $("select[name='bus_no']").append('<option value="' + result[i].id + '">'+result[i].bus_no + '</option>')
                        }
                    },
                    error: function(err) {
                        alert("Fixxing Server Error");
                    }
                });
            } else {
                $("select[name='bus_no']").empty();
                $("select[name='bus_no']").append("<option value=''>Select Bus NO.</option>")
            }
        });

        $("input[name=fake]").on('change', () => {
            if($("#fake_1").prop("checked")) {
                $('#busno').prop('disabled', 'disabled');
                $('#drivername').prop('disabled', 'disabled');
            } else {
                $('#busno').removeAttr('disabled');
                $('#drivername').removeAttr('disabled');
            }
        })

        // validate
        $(".reset-btn").click(function(){
            // $( ".parsley-errors-list.filled" ).hide();
        location.reload();
        });

        $('#custom-form').submit(function(e){
            // $( ".parsley-errors-list.filled" ).show();
        });
            // end validate
        function checkTrip(type = 'trip') {
            let trip_id = $('#tripname').find(":selected").val();
            let busno = $('#busno').val();

            if(type == "busno" && trip_id == "") {
                return false;
            }
            if (trip_id === "") {
                // $(".add-new-form").hide();
                for (let i = 1; i < 8; i++) {
                    $('input[id="trip_frequancy_' + i + '"]').prop("checked", false);
                    $('input[id="trip_frequancy_' + i + '"]').attr("disabled", false);
                }
            } else {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'JSON',
                    url:trip_url,
                    data:{trip_id:trip_id,busno:busno,type:type},
                    success:function(res){
                        if(res.result == "success" ){
                            let tripfreq = res.tripdata;
                            let bus_not = res.bus_not == null ? [] : res.bus_not;
                            let driver_not = res.driver_not == null ? [] : res.driver_not;
                            let disableopt = res.disableopt == null ? [] : res.disableopt;
                            let closes = res.bus_result.closes == null ? [] : res.bus_result.closes;
                            let crashes = res.bus_result.crashes == null ? [] : res.bus_result.crashes;

                            let trip_tr = `<tr bgcolor="#E5E4E2">
                                                <td>${tripfreq.trip_name_en}</td>
                                                <td>${tripfreq.first_trip_date}</td>
                                                <td>${tripfreq.last_trip_date}</td>
                                                <td>${tripfreq.departure_time}</td>
                                                <td>${tripfreq.arrival_time}</td>
                                            </tr>
                            `;

                            console.log(res.bus_result);
                            // if (crashes.length > 0) {
                            //     // $('#modal_header').html($('#arc_crash_message').val());
                            //     crashes.forEach(crash => {
                            //         trip_tr += `<tr bgcolor='#f2dede'>
                            //                         <td>${crash.trip_name_en}</td>
                            //                         <td>${crash.first_trip_date}</td>
                            //                         <td>${crash.last_trip_date}</td>
                            //                         <td>${crash.departure_time}</td>
                            //                         <td>${crash.arrival_time}</td>
                            //                     </tr>
                            //         `;
                            //     });
                            //     $('#result_trip').html(trip_tr);
                            //     $('#myModal').modal('show');
                            // }
                            // else if (closes.length > 0) {
                            //     // $('#modal_header').html($('#arc_close_message').val());
                            //     closes.forEach(close => {
                            //         trip_tr += `<tr bgcolor='#fcf8e3'>
                            //                         <td>${close.trip_name_en}</td>
                            //                         <td>${close.first_trip_date}</td>
                            //                         <td>${close.last_trip_date}</td>
                            //                         <td>${close.departure_time}</td>
                            //                         <td>${close.arrival_time}</td>
                            //                     </tr>
                            //         `;
                            //     });
                            //     $('#result_trip').html(trip_tr);

                            //     $('#myModal').modal('show');
                            // }

                            let arr = tripfreq;
                            if (arr["trip_frequancy"] == null || arr["trip_frequancy"] == "null") {
                                for (let i = 1; i < 8; i++) {
                                    $('input[id="trip_frequancy_' + i + '"]').attr("disabled", false);
                                }
                            } else {
                                arr = JSON.parse(arr["trip_frequancy"]);
                                for (let i = 0; i < 8; i++) {
                                    $('input[id="trip_frequancy_' + i + '"]').prop('checked', false);
                                }
                                for (const element of arr) {
                                    let flag = isNumeric(element);
                                    if (flag) {
                                        // $('input[id="trip_frequancy_' + element + '"]').attr("disabled", false);
                                        // $('input[id="trip_frequancy_' + element + '"]').attr("readonly", false);
                                        $('input[id="trip_frequancy_' + element + '"]').prop( "checked", true );
                                    }
                                }
                                for (let i = 1; i < 8; i++) {
                                        if($('input[id="trip_frequancy_' + i + '"]').prop("checked") == false) {
                                            $('input[id="trip_frequancy_' + i + '"]').attr("disabled", false);
                                            $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                        } else {
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("disabled");
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("readonly");
                                        }
                                }

                                disableopt.forEach(element => {
                                    $('input[id="trip_frequancy_' + element + '"]').prop( "checked", false );
                                    $('input[id="trip_frequancy_' + element + '"]').attr("disabled", false);
                                });

                                // $(".add-new-form").hide();
                                // $(".add-new-form").slideToggle(500);
                            }
                            document.getElementById('trip_type1').checked = tripfreq.trip_type == 1;
                            document.getElementById('trip_type2').checked = tripfreq.trip_type == 0;
                            if (tripfreq.trip_type == 0) {
                                for (let i = 1; i < 8; i++) {
                                    $('input[id="trip_frequancy_' + i + '"]').attr("disabled", false);
                                    $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                }
                            }
                        }
                    }
                });
            }
        }

        $('#modal_close').click(()=>{
            $('#myModal').modal('hide');
        });

    });
</script>


<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

@endsection
