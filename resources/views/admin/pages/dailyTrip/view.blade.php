@extends('admin.layouts.master')
@section('title') {{__('View Daily Trip')}} @endsection
@section('page-title') {{__('VIEW DAILY TRIP')}} <p style="text-align: center;width: 100%;font-size: .8rem;color: #aaa"> TRIP # {{$daily_trip->trip_id}} </p> @endsection
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
                                    <label>{{__('client')}}</label>
                                    <select class="form-select" name="client" disabled required>
                                        <option>{{__('Select Client')}}</option>
                                        @foreach($client as $key=>$row)
                                            <option value="{{$row->id}}" {{$daily_trip->client_name == $row->id ? "selected" : ""}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                            <input type="hidden" name="client" value="{{$daily_trip->client_name}}">
                                </div>
                                <div class = "mb-3">
                                    <label>{{__('origin')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_city" disabled required>
                                                <option>Select City</option>
                                                @foreach($city as $key=>$row)
                                                    <option value="{{$row->city_name_en}}" data-id="{{$row->id}}" {{$daily_trip->origin_city == $row->city_name_en ? "selected" : ""}}>{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="origin_area" disabled required>
                                                <option selected>{{$daily_trip->origin_area}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label>{{__('start date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" disabled placeholder="dd/mm/yyyy"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" name="" value="{{ date(Session::get('date') == 0 ? 'd/m/Y' : 'm/d/Y',strtotime($daily_trip->start_date)) }}" required>

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label for="">{{__('start time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" disabled type="text" class="form-control" data-provide="timepicker" value="{{$daily_trip->start_time}}" name = "start_trip_time">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>{{__('bus size')}}</label>
                                    <select class="form-select" name="bus_size" disabled required>
                                        <option> {{__('Select Bus Size')}}</option>
                                        @foreach($bus_size as $key=>$row)
                                            <option value="{{$row->size}}" {{$daily_trip->bus_size_id == $row->size ? "selected" : ""}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="details" disabled>{{$daily_trip->details}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('trip type')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" disabled name="trip_type"
                                                    id="trip_type_1" value="1" {{$daily_trip->trip_type == 1 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="trip_type_1">
                                                {{__('periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" disabled name="trip_type"
                                                    id="trip_type_1" value="1" {{$daily_trip->trip_type == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight text-capitalize" for="trip_type_1">
                                                {{__('periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" disabled name="trip_type"
                                                    id="trip_type_2" value="0" {{$daily_trip->trip_type == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="trip_type_2">
                                                   {{__('non-periodic')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" disabled name="trip_type"
                                                    id="trip_type_2" value="0" {{$daily_trip->trip_type == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="trip_type_2">
                                                   {{__('non-periodic')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label">SHOW TRIP IN ADMIN APP</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_1" value="1" {{$daily_trip->show_admin_status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="show_trip_admin_1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="show_trip_admin"
                                                    id="show_trip_admin_2" value="0" {{$daily_trip->show_admin_status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="show_trip_admin_2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>{{__('trip name')}}</label>
                                    <select class="form-select" name="tripe_name" disabled required>
                                        <option>Select Trip</option>
                                        @foreach($trip as $key=>$row)
                                            <option value="{{$row->trip_name_en}}" {{$daily_trip->trip_name == $row->trip_name_en ? "selected" : ""}}>{{$row->trip_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "mb-3">
                                    <label> {{__('destination')}}</label>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <select class="form-select" disabled name="destination_city" required>
                                                <option> {{__('Select City')}}</option>
                                                @foreach($city as $key=>$row)
                                                    <option value="{{$row->city_name_en}}" data-id="{{$row->id}}" {{$daily_trip->destination_city == $row->city_name_en ? "selected" : ""}}>{{$row->city_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "col-md-6">
                                            <select class="form-select" name="destination_area" disabled required>
                                                <option selected>{{$daily_trip->destination_area}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "mb-3">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label> {{__('end date')}}</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" disabled class="form-control" placeholder="dd/mm/yyyy"
                                                    data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                    data-provide="datepicker" name="end_trip_date" value="{{ date(Session::get('date') == 0 ? 'd/m/Y' : 'm/d/Y',strtotime($daily_trip->end_date)) }}" required>
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label for=""> {{__('end time')}}</label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <input id="timepicker" disabled type="text" class="form-control" data-provide="timepicker" value="{{$daily_trip->end_time}}" name = "end_trip_time">
                                                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label> {{__('bus no.')}}</label>
                                    <select class="form-select" name="bus_no" disabled required>
                                        <option> {{__('Select Bus.No')}}</option>
                                        @foreach($bus as $key=>$row)
                                            <option value="{{$row->bus_no}}" {{$daily_trip->bus_no == $row->bus_no ? "selected" : ""}}>{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label> {{__('driver')}}</label>
                                    <select class="form-select" name="driver" disabled required>
                                        <option> {{__('Select Driver')}}</option>
                                        @foreach($driver as $key=>$row)
                                            <option value="{{$row->name_en}}" {{$daily_trip->dirver_name == $row->name_en ? "selected" : ""}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "mb-3">
                                    <label class="form-label"> {{__('status')}}</label>

                                    <select class="form-select" name="bus_size" disabled required>
                                        <option>Pending</option>
                                        <option class="form-check-input" type="radio" disabled  value="{{$row->size}}" name="status"
                                                id="status_1" value="1" {{$daily_trip->bus_size == 1 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_1">
                                                Pending
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_2" value="2" {{$daily_trip->bus_size == 2 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_2">
                                                Accepted
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_3" value="3" {{$daily_trip->status == 3 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_3">
                                                Rejected
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_4" value="4" {{$daily_trip->status == 4 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_4">
                                                Started
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_5" value="5" {{$daily_trip->status == 5 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_5">
                                                Started with a delay
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_6" value="6" {{$daily_trip->status == 6 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_6">
                                                Finished
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_7" value="7" {{$daily_trip->status == 7 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_7">
                                                Finished with a delay
                                            </label>
                                        </option>
                                        <option class="form-check-input" type="radio" disabled name="status"
                                            id="status_8" value="8" {{$daily_trip->status == 8 ? "selected" : ""}}>
                                            <label class="form-check-label" for="status_8">
                                                Canceled
                                            </label>
                                        </option>
                                    </select>
                                </div>
                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color"></span>  {{__('supervisor')}}
                                    </label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" id='selectAll' disabled
                                                    >
                                                <label class="form-check-label text-normal" style="width: 200px">
                                                {{__('Choose One or More')}}
                                                </label>
                                            </div>
                                        </div>
                                        @if(Session::get('lang') != 'jor')
                                        <div class = "col-md-4">
                                            @foreach($supervisor as $row)
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                        value = "{{$row->id}}" checked disabled>
                                                    <label class="form-check-label text-capitalize" for="supervisor_{{$row->id}}">
                                                        {{$row->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <div class = "col-md-10">
                                            @foreach($supervisor as $row)
                                                <div class="form-check form-check-warning ">
                                                    <input class="form-check-input checkRight" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                        value = "{{$row->id}}" checked disabled>
                                                    <label class="form-check-label labelRight text-capitalize" for="supervisor_{{$row->id}}">
                                                        {{$row->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/view-daily-trip.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn"> {{__('BACK')}}</button>
                <!-- <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">Reset</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button> -->
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
            if(new Date(document.getElementsByName("end_trip_date")[0].value + " " + document.getElementsByName("end_trip_time")[0].value) > new Date()) {
                document.getElementsByName("bus_size")[0].disabled = true;
                document.getElementsByName("bus_no")[0].disabled = true;
                document.getElementsByName("driver")[0].disabled = true;
                // document.getElementsByName("select[name='origin_area']")[0].disabled = true;
            }


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
