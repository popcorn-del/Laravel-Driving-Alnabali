@extends('admin.layouts.master')
@section('title') Add Trip's Bus @endsection
@section('page-title') {{__("add trip's bus")}} @endsection
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
                                    <label><span class="custom-val-color">*</span> {{__('trip name')}}</label>
                                    <select class="form-select" name="trip_name" id="tripname" required>
                                        <option value="">{{__('select trip name')}}</option>
                                        @foreach($trip as $row)
                                            <option value="{{$row->id}}">
                                                {{app()->getLocale()=='jor'?$row->trip_name_ar:$row->trip_name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('is fake')}} </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="fake"
                                                    id="fake_1" value = "1">
                                                <label class="form-check-label" for="fake_1">
                                                    {{__('yes')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="fake"
                                                    id="fake_2" value = "0" checked>
                                                <label class="form-check-label" for="fake_2">
                                                    {{__('no')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('bus no.')}} </label>
                                    <select class="form-select" name="bus_no" id="busno" required>
                                        <option value="">{{__('select bus no.')}}</option>
                                        @foreach($bus_no as $row)
                                        <option value="{{$row->id}}">{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span>     {{__('trip frequancy')}}
                                    <span class = "font-size-10 mb-1" >[{{__('only for periodic trip')}}]</span></label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            {{__('choose one or more')}}
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_1" name="trip_frequancy[]"
                                                    value = "1">
                                                <label class="form-check-label" for="trip_frequancy_1">
                                                    {{__('sunday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_2" name="trip_frequancy[]"
                                                     value = "2" >
                                                <label class="form-check-label" for="trip_frequancy_2">
                                                    {{__('monday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_3" name="trip_frequancy[]"
                                                    value = "3">
                                                <label class="form-check-label" for="trip_frequancy_3">
                                                    {{__('tuesday')}}
                                                </label>
                                            </div>

                                        </div>
                                        <div class = "col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_4" name="trip_frequancy[]"
                                                    value = "4">
                                                <label class="form-check-label" for="trip_frequancy_4">
                                                    {{__('wednesday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_5" name="trip_frequancy[]"
                                                    value = "5">
                                                <label class="form-check-label" for="trip_frequancy_5">
                                                    {{__('thursday')}}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_6" name="trip_frequancy[]"
                                                    value = "6">
                                                <label class="form-check-label" for="trip_frequancy_6">
                                                    {{__('friday')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class = "col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id="trip_frequancy_7" name="trip_frequancy[]"
                                                    value = "7">
                                                <label class="form-check-label" for="trip_frequancy_7">
                                                    {{__('saturday')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>{{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value = "1" checked>
                                                <label class="form-check-label" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value = "0">
                                                <label class="form-check-label" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('trip type')}} </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" disabled id="trip_type1" value="1" type="radio" checked>
                                                <label class="form-check-label">
                                                    {{__('periodic')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" disabled id="trip_type2" value="0" type="radio">
                                                <label class="form-check-label">
                                                    {{__('non-periodic')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span>{{__('bus size')}}</label>
                                    <select class="form-select" name="bus_size" id="bussize" required>
                                        <option value="">{{__('select bus size')}}</option>
                                        @foreach($bus_size as $row)
                                        <option value="{{$row->id}}">{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span>{{__('driver name')}}</label>
                                    <select class="form-select" name="driver_name" id="drivername" required>
                                        <option value="">{{__('select driver name')}}</option>
                                        @foreach($driver as $row)
                                        <option value="{{$row->id}}">{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('supervisor name')}}
                                    </label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check text-uppercase">
                                            {{__('choose one or more')}}
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
                            </div>
                        </div>
                </div>
                <!-- <div class="col-md-8" style="padding-top: 10vw;">
                    <img src="{{ URL::asset ('/images/admin/add-bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('back')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('reset')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('save')}}</button>
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
<script src="{{ URL::asset('/assets/admin/tripBus/index.js') }}"></script>
<script>

    $("#backbtn").on('click', () => {
        history.back();
    })
    function isNumeric(str) {
        if (typeof str != "string") return false // we only process strings!
        return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
                !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
    }

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
    $(document).ready(function(){
        store = "{{route('admin.trip_bus.store')}}";
        list_url = "{{route('admin.trip_bus.index')}}";
        trip_url = "{{route('admin.trip_bus.tripname')}}";

        // $(".add-new-form").hide();
        $("#tripname").on('change', () => {
            let selectValue = $('#tripname').find(":selected").val();
            if (selectValue === "") {
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
                    data:{id:selectValue},
                    success:function(res){
                        if(res.result == "success" ){

                            let tripfreq = res.tripdata;
                            let bus_not = res.bus_not == null ? [] : res.bus_not;
                            let driver_not = res.driver_not == null ? [] : res.driver_not;
                            let disableopt = res.disableopt == null ? [] : res.disableopt;

                            let arr = tripfreq;
                            if (arr["trip_frequancy"] == "null") {
                                // $(".add-new-form").hide();
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
                                            $('input[id="trip_frequancy_' + i + '"]').attr("disabled", true);
                                            $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                        } else {
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("disabled");
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("readonly");
                                        }
                                }

                                disableopt.forEach(element => {
                                    $('input[id="trip_frequancy_' + element + '"]').prop( "checked", false );
                                });

                                // $(".add-new-form").hide();
                                // $(".add-new-form").slideToggle(500);
                            }
                            document.getElementById('trip_type1').checked = tripfreq.trip_type == 1;
                            document.getElementById('trip_type2').checked = tripfreq.trip_type == 0;
                            if (tripfreq.trip_type == 0) {
                                for (let i = 1; i < 8; i++) {
                                    $('input[id="trip_frequancy_' + i + '"]').attr("disabled", true);
                                    $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                }
                            }
                            // bus_not.forEach(element => {
                            //     var busno_select = document.getElementById('busno')
                            //     busno_select.removeChild(getOptionByValue(select, element))
                            // });
                            // driver_not.forEach(element => {
                            //     var drivername_sel = document.getElementById('drivername')
                            //     drivername_sel.removeChild(getOptionByValue(select, element))
                            // });
                        }
                    }
                });
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

        $("input[name=fake]").on('change', () => {
            if($("#fake_1").prop("checked")) {
                $('#busno').prop('disabled', 'disabled');
                $('#drivername').prop('disabled', 'disabled');
                $('#busno').removeAttr('required');
                $('#drivername').removeAttr('required');
            } else {
                $('#busno').removeAttr('disabled');
                $('#drivername').removeAttr('disabled');
                $('#busno').attr('required');
                $('#drivername').attr('required');
            }
        })



        function getOptionByValue (select, value) {
            var options = select.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === value) {
                    return options[i]
                }
            }
            return null
        }

    });
</script>
@endsection
