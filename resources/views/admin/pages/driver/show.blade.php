@extends('admin.layouts.master')
@section('title') View Driver @endsection
@section('page-title') {{__('View Driver')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/driver/style.css')}}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" method="post" id="custom-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$driver->id}}" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div style="text-align: center">{{__('profile image')}}</div>
                            <div class="picture-container" style="margin-bottom: 30px">
                                <div class="picture">
                                    <img src="{{ $driver->profile_image != '' ? asset('/uploads/driver').'/'.($driver->profile_image):asset('/images/admin/user-profile.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                                    <input type="file" id="wizard-picture" name="file" class="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('name')}}</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$driver->name_en}}" required>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> EMAIL </label>
                                    <input type="email" class="form-control" name="user_email" minlength="1" maxlength="100" value="{{$driver->user_email}}" required>
                                </div> -->
                                <div class="mb-3">
                                    <label class="form-label">{{__('phone')}}</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <div style="width: 100%">
                                            <input data-parsley-type="number" type="text" class="form-control" name="phone" value="{{$driver->phone}}" placeholder="7 xxxx xxxx" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('address')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="address">{{$driver->address}}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$driver->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_1" value="1" {{$driver->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight" for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$driver->status == 0 ? "checked" : ""}}>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_2" value="0" {{$driver->status == 0 ? "checked" : ""}}>
                                                @endif
                                                <label class="form-check-label" for="status_2">
                                                {{__('inactive')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('date of birth')}}</label>
                                    <!-- <input type="number" class="form-control" name="age" value="{{$driver->age}}" required> -->
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="start_date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($driver->age))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('username')}}</label>
                                    <input type="text" class="form-control" name="user_name" value="{{$driver->user_name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('license number')}}</label>
                                    <input type="text" class="form-control" name="license_number" value="{{$driver->license_number}}" required>
                                </div>

                                <div class="mb-3">
                                    <label>{{__('license expiry date')}}</label>
                                    <div class="input-group" id="datepicker2" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="enddate-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="enddate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker2'
                                                data-provide="datepicker" name="end_date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($driver->license_expiry_date))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/driver.png') }}" alt="" width="100%">
                </div> -->
            </div>
            <div class="button-group">

                <a href="{{route('admin.driver.index')}}" class="btn btn-outline-primary waves-effect waves-light">
                {{__('BACK')}}
                </a>
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
    <script src="{{ URL::asset('/assets/admin/driver/edit.js') }}"></script>
    <script>
        store = "{{route('admin.driver.store')}}";
        list_url = "{{route('admin.driver.index')}}";

        // for View
        var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }

        // var backbtn = document.getElementById("backbtn");
        // backbtn.disabled = false;

        // $("#backbtn").click(function() {
        //     // history.back();
        //     window.location.href = './'
        // })


        // End for View

            //  setStart date
            $( "#startdate" ).on( "change", function() {
            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });

        //  setEnd date
        $( "#enddate" ).on( "change", function() {
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
            // end validate
    </script>
@endsection
