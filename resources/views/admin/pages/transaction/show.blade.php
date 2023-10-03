@extends('admin.layouts.master')
@section('title') View Transaction @endsection
@section('page-title') {{__('View Transaction')}} <p style="text-align: center;width: 100%;font-size: .8rem;color: #aaa"> TRIP # {{$transaction->disp_trip_id}} </p> @endsection
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
            @csrf
            <input type="hidden" name="id" value="" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('client')}}</label>
                                    <input type="text" class="form-control" name="name_en" required value="{{$client_name}}">
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color"></span>{{__('origin')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_city">
                                                <option>{{$origin_city}}</option>
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_area">
                                                <option>{{$origin_area}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class = "mb-3">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('start date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" name="first_trip_date" required value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($trip->first_trip_date))}}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('start time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" type="text" class="form-control" data-provide="timepicker" name = "arrival_time" value = "{{date('h:m A', strtotime($trip->departure_time))}}">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label><span class="custom-val-color"></span>{{__('bus size')}}</label>
                                    <select class="form-select" name="destination_area">
                                            {{-- <option>Select Bus Size</option> --}}
                                            <option>{{$bus_size}}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="details" value = ""></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('trip type')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_1" value = "1" {{$trip->trip_type == 1 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_1">
                                                    {{__('periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="show_trip_admin"
                                                    id="status_1" value = "1" {{$trip->trip_type == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight text-capitalize" for="status_1">
                                                    {{__('periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_2" value = "0" {{$trip->trip_type == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="show_trip_admin"
                                                    id="status_2" value = "0" {{$trip->trip_type == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "row">

                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('transaction date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd/mm/YYYY" id="startdate"
                                                    data-date-format="dd/mm/YYYY" data-date-container='#datepicker1'
                                                    data-provide="datepicker" required value="{{ date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y',strtotime($transaction->created_at)) }}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('transaction time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" type="text" class="form-control" data-provide="timepicker" name = "arrival_time" value="{{$transaction->created_at->format('h:i A')}}">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('trip name')}}</label>
                                    <input type="text" class="form-control" name="name_en" required value="{{$transaction->trip_name}}">
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color"></span>{{__('destination')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_city">
                                                <option>{{$destination_city}}</option>
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_area">
                                                <option>{{$destination_area}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class = "mb-3">
                                    <div class = "row">

                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('end date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" required value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($trip->last_trip_date))}}">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color"></span>{{__('end time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" type="text" class="form-control" data-provide="timepicker" name = "arrival_time" value = "{{date('h:m A', strtotime($trip->arrival_time))}}">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('bus no.')}}</label>
                                    <input type="text" class="form-control" name="name_en" required value="{{$bus_no}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('driver')}}</label>
                                    <select class="form-select" name="destination_city">
                                                {{-- <option value="">Select City</option> --}}
                                                <option value="">{{$transaction->driver_name}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('old status')}}</label>
                                    <select class="form-select" name="destination_city">
                                        @switch($transaction->old_status)
                                            @case(100)
                                                <option value="">{{__('Created')}}</option>
                                                @break
                                            @case(1)
                                                <option value="">{{__('Pending')}}</option>
                                                @break
                                            @case(2)
                                                <option value="">{{__('Accepted')}}</option>
                                                @break
                                            @case(3)
                                                <option value="">{{__('Rejected')}}</option>
                                                @break
                                            @case(4)
                                                <option value="">{{__('Started')}}</option>
                                                @break
                                            @case(5)
                                                <option value="">{{__('Canceled')}}</option>
                                                @break
                                            @case(6)
                                                <option value="">{{__('Finished')}}</option>
                                                @break
                                            @case(7)
                                                <option value="">{{__('Fake')}}</option>
                                                @break
                                            @default
                                                <option value="">{{__('Pending')}}</option>
                                        @endswitch
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('new status')}}</label>
                                    <select class="form-select" name="destination_city">
                                        @switch($transaction->new_status)
                                        @case(100)
                                                <option value="">{{__('Created')}}</option>
                                                @break
                                            @case(1)
                                                <option value="">{{__('Pending')}}</option>
                                                @break
                                            @case(2)
                                                <option value="">{{__('Accepted')}}</option>
                                                @break
                                            @case(3)
                                                <option value="">{{__('Rejected')}}</option>
                                                @break
                                            @case(4)
                                                <option value="">{{__('Started')}}</option>
                                                @break
                                            @case(5)
                                                <option value="">{{__('Canceled')}}</option>
                                                @break
                                            @case(6)
                                                <option value="">{{__('Finished')}}</option>
                                                @break
                                            @case(7)
                                                <option value="">{{__('Fake')}}</option>
                                                @break
                                            @default
                                                <option value="">{{__('Pending')}}</option>
                                    @endswitch

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('reason for rejection')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="details" value = ""></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class = "col-md-12">
                        <div class = "row">
                            <div class = "col-md-6">


                                {{-- <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span>{{__('show trip on map')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_1" value = "1">
                                                <label class="form-check-label" for="status_1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="status_2" value = "0" >
                                                <label class="form-check-label" for="status_2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}



                            </div>
                            <div class = "col-md-6">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/bus.png') }}" alt="" width="100%">
                </div>
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
    <script src="{{ URL::asset('/assets/admin/trip/edit.js') }}"></script>
    <script>
       $(document).ready(function(){

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

            // end validate

            // display days of week
            $("#trip_type_2").on("change", function (e) {
                if (document.getElementById('trip_type_2').checked) {
                    $('#daysofweek input').prop('checked', false); // Unchecks it
                    $("#daysofweek").hide();
                }
            })

            $("#trip_type_1").on("change", function (e) {
                if (document.getElementById('trip_type_1').checked) {
                    $("#daysofweek").show();
                }
            })

            store = "{{route('admin.trip.store')}}";
            list_url = "{{route('admin.trip.index')}}";
            origin_area = $("select[name='origin_area']");
            destination_area = $("select[name='destination_area']");

            // display area when click origin_city
            $("select[name='origin_city']").on("change", function (e) {
                var id = $(e.currentTarget).val();
                selectFunction(origin_area, id)
            })
            // display area when click destination_area
            $("select[name='destination_city']").on("change", function (e) {
                var id = $(e.currentTarget).val();
                selectFunction(destination_area, id)
            })

            function selectFunction(select, id){
                show_url = "{{route('admin.trip.show', ':trip')}}";
                show_url = show_url.replace(':trip', id);
                $.ajax({
                    url: show_url,
                    method: 'get',
                    success: function (res) {
                        result = res.data;
                        if(result){
                            select.empty();
                            select.append("<option>Select area</option>");
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
        });
    </script>
@endsection
