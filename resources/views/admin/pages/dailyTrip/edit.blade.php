@extends('admin.layouts.master')
@section('title') Edit Daily Trip @endsection
@section('page-title') Edit Daily Trip <p style="text-align: center;width: 100%;font-size: .8rem;color: #aaa"> {{$daily_trip->trip_id}} </p>  @endsection
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
            <input type="hidden" name="id" value="{{$daily_trip->id}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('trip name')}}</label>
                                    <select class="form-select" disabled required>
                                        <option>Select trip</option>
                                        @foreach($trip as $key=>$row)
                                            <option value="{{$row->trip_name_en}}" {{$daily_trip->trip_name == $row->trip_name_en ? "selected" : ""}}>{{$row->trip_name_en}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="tripe_name" value="{{$daily_trip->trip_name}}">
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('origin')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" disabled required>
                                                <option>Select City</option>
                                                @foreach($city as $key=>$row)
                                                    <option value="{{$row->city_name_en}}" data-id="{{$row->id}}" {{$daily_trip->origin_city == $row->city_name_en ? "selected" : ""}}>{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="origin_city" value="{{$daily_trip->origin_city}}">
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" disabled required>
                                                <option selected>{{$daily_trip->origin_area}}</option>
                                            </select>
                                            <input type="hidden" name="origin_area" value="{{$daily_trip->origin_area}}">
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color">*</span> {{__('start date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" disabled placeholder="dd/mm/yyyy"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" name="" value="{{$daily_trip->start_date}}" required>
                                                    <input type="hidden" value="{{$daily_trip->start_date_str}}" name="start_trip_date">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label for=""><span class="custom-val-color">*</span> {{__('start time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" disabled type="text" class="form-control" data-provide="timepicker" value="{{date('h:i A', strtotime($daily_trip->start_time))}}">
                                                    <input type="hidden" value="{{date('h:i A', strtotime($daily_trip->start_time))}}" name="start_trip_time">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span>  {{__('bus size')}}</label>
                                    <select class="form-select" id="bus_size_id" required>
                                        <option>Select Bus Size</option>
                                        @foreach($bus_size as $key=>$row)
                                            <option value="{{$row->id}}" {{$daily_trip->bus_size_id == $row->size ? "selected" : ""}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="bus_size_id_hide" name="bus_size_id" value="{{$daily_trip->bus_size_id}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"> {{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="details">{{$daily_trip->details}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('trip type')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="trip_type"
                                                    id="trip_type_1" value="1" {{$daily_trip->trip_type == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="trip_type_1">
                                                    {{__('periodic')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="trip_type"
                                                    id="trip_type_2" value="0" {{$daily_trip->trip_type == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="trip_type_2">
                                                    {{__('non-periodic')}}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>{{__('show trip in admin app')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" dis type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_1" value="1" {{$daily_trip->show_admin_status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="show_trip_admin_1">
                                                    {{__('yes')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_2" value="0" {{$daily_trip->show_admin_status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="show_trip_admin_2">
                                                    {{__('no')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('client')}}</label>
                                    <select class="form-select" name="client" disabled required>
                                        <option>Select Client</option>
                                        @foreach($client as $key=>$row)
                                            <option value="{{$row->id}}" {{$daily_trip->client_name == $row->id ? "selected" : ""}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                            <input type="hidden" name="client" value="{{$daily_trip->client_name}}">
                                </div>
                                <div class = "mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('destination')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" disabled required>
                                                <option>Select City</option>
                                                @foreach($city as $key=>$row)
                                                    <option value="{{$row->city_name_en}}" data-id="{{$row->id}}" {{$daily_trip->destination_city == $row->city_name_en ? "selected" : ""}}>{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="destination_city" value="{{$daily_trip->destination_city}}">
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_area" disabled required>
                                                <option selected>{{$daily_trip->destination_area}}</option>
                                            </select>
                                            <input type="hidden" name="destination_area" value="{{$daily_trip->destination_area}}">
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label><span class="custom-val-color">*</span>{{__('end date')}}</label>
                                            <input type="hidden" value="{{$daily_trip->end_date}}" name="">
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" disabled class="form-control" placeholder="dd/mm/yyyy"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" name="end_trip_date" value="{{$daily_trip->end_date}}" required>

                                                    <input type="hidden" value="{{$daily_trip->end_date_str}}" name="end_trip_date">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label for=""><span class = "custom-val-color">*</span> {{__('end time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" disabled type="text" class="form-control" data-provide="timepicker" value="{{date('h:i A', strtotime($daily_trip->end_time))}}">
                                                    <input type="hidden" value="{{date('h:i A', strtotime($daily_trip->end_time))}}" name="end_trip_time">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('bus no.')}}</label>
                                    <select class="form-select" name="bus_no" id="bus_no" required>
                                        <option>Select Bus.No</option>
                                        <option value="{{$daily_trip->bus_no}}" selected>{{$daily_trip->bus_no}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('driver')}}</label>
                                    <select class="form-select" name="driver" required>
                                        <option>Select Driver</option>
                                        @foreach($driver as $key=>$row)
                                            <option value="{{$row->name_en}}|{{$row->id}}" {{$daily_trip->dirver_name == $row->name_en ? "selected" : ""}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('status')}}</label>

                                    <select class="form-select" name="status" id="statusID" required disabled>
                                        <option class="form-check-input"
                                            id="status_1" value="1" {{$daily_trip->status == 1 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_1">
                                                Pending
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_2" value="2" {{$daily_trip->status == 2 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_2">
                                                Accepted
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_3" value="3" {{$daily_trip->status == 3 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_3">
                                                Rejected
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_4" value="4" {{$daily_trip->status == 4 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_4">
                                                Started
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_5" value="5" {{$daily_trip->status == 5 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_5">
                                                Canceled
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_6" value="6" {{$daily_trip->status == 6 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_6">
                                                Finished
                                            </label>
                                        </option>
                                        <option class="form-check-input"
                                            id="status_7" value="7" {{$daily_trip->status == 7 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_7">
                                                Fake
                                            </label>
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('change status')}}</label>
                                    <div class="row" style="margin-left: 5px">
                                        <div class="row">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_type_0" value="0" checked>
                                                <label class="form-check-label" for="status_type_0">
                                                    {{__("don't change")}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_type_1" value="1">
                                                <label class="form-check-label" for="status_type_1">
                                                    {{__('set as pending')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_type_5" value="5">
                                                <label class="form-check-label" for="status_type_5">
                                                    {{__('set as canceled')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_type_7" value="7">
                                                <label class="form-check-label" for="status_type_7">
                                                    {{__('set as fake')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('supervisor')}}
                                    </label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id='selectAll'
                                                    >
                                                <label class="form-check-label" style="width: 200px">
                                                    {{__('select all')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class = "col-md-4">
                                            @foreach($supervisor as $row)
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                        value = "{{$row->id}}" {{in_array($row->id, $supervisor_id) ? "checked" : ""}} >
                                                    <label class="form-check-label" style="width: 200px" for="supervisor_{{$row->id}}">
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
                </div>
             <!--    <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/bus.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('back')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('reset')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('save')}}</button>
                <!-- <a href="{{route('admin.daily.task')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new"><i class="fas fa-plus"></i> ADD DAILY TRIP</a>  -->
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
    <script src="{{ URL::asset('/assets/admin/dailyTrip/edit.js') }}"></script>
    <script>
         $(document).ready(function(){
            $("#backbtn").on('click', () => {
                history.back();
            })
            $(".trip-frequency-check").click(function(){

                let aInputs = document.getElementsByName('supervisor[]');
                let source = document.getElementById('selectAll');
                console.log(source)
                console.log(aInputs)
                for (let i=0;i<aInputs.length;i++) {
                    aInputs[i].checked = source.checked;
                }
            });
            // if(new Date(document.getElementsByName("end_trip_date")[0].value + " " + document.getElementsByName("end_trip_time")[0].value) > new Date()) {
            //     document.getElementsByName("bus_size")[0].disabled = true;
            //     document.getElementsByName("bus_no")[0].disabled = true;
            //     document.getElementsByName("driver")[0].disabled = true;
            //     // document.getElementsByName("select[name='origin_area']")[0].disabled = true;
            // }

            let status_types = $('input[name="status"]');
            console.log(status_types);
            for (let index = 0; index < status_types.length; index++) {
                const element = status_types[index];
                element.onclick = function() {
                    let id = this.value;
                    document.getElementById('statusID').value = id;
                }
            }
            if (document.getElementById('statusID').value == 6) {
                for (let index = 0; index < status_types.length; index++) {
                    const element = status_types[index];
                    element.disabled = true;
                }
            }

            $("#bus_size_id").on('change', (e) => {
                $("#bus_size_id_hide").val(e.target.options[e.target.selectedIndex].text);
                let id = $("#bus_size_id").val();
                // bus_size_id_hide =
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
                                $("select[name='bus_no']").append('<option value="' + result[i].bus_no + '">'+result[i].bus_no + '</option>')
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

            store = "{{route('admin.daily_trip.store')}}";
            list_url = "{{route('admin.daily_trip.index')}}";
            origin_area = $("select[name='origin_area']");
            console.log(origin_area)
            destination_area = $("select[name='destination_area']");

            // display area when click origin_city
            $("select[name='origin_city']").on("change", function (e) {
                var id = $(this).find(':selected').data('id')
                selectFunction(origin_area, id)
            })
            // display area when click destination_area
            $("select[name='destination_city']").on("change", function (e) {
                var id = $(this).find(':selected').data('id')
                selectFunction(destination_area, id)
            })

            function selectFunction(select, id){
                show_url = "{{route('admin.daily_trip.show', ':daily_trip')}}";
                show_url = show_url.replace(':daily_trip', id);
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
