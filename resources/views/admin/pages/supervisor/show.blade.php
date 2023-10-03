@extends('admin.layouts.master')
@section('title') View App Supervisor @endsection
@section('page-title') {{__('View App Supervisor')}} @endsection
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
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <input type="hidden" name="id" value="{{$supervisor->id}}" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-12">
                                    <div style="text-align: center;" class="text-uppercase">
                                    {{__('profile image')}}
                                    </div>
                                    <div class="picture-container" style="margin-bottom: 30px">
                                        <div class="picture">
                                            <img src="{{ isset($supervisor->profile_image) ? asset('/uploads/supervisor').'/'.($supervisor->profile_image):asset('/images/admin/user-profile.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                                            <input type="file" id="wizard-picture" name="file" class="">
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('name')}} </label>
                                    <input type="text" class="form-control" name="name_en" value="{{$supervisor->name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('phone')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <input data-parsley-type="number" type="text" class="form-control" name="phone" value="{{$supervisor->phone}}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('address')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="5" name="address" value="{{$supervisor->address}}">{{$supervisor->address}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>{{__('date of birth')}}</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="birthday" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($supervisor->birthday))}}"  required>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('username')}}</label>
                                    <input type="text" class="form-control" name="user_name" value="{{$supervisor->user_name}}" required>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">{{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$supervisor->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_1" value="1" {{$supervisor->status == 1 ? "checked" : ""}}>
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
                                                    id="status_2" value="0" {{$supervisor->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_2">
                                                {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_2" value="0" {{$supervisor->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="status_2">
                                                {{__('inactive')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
                <a href="#" class="btn btn-outline-primary waves-effect waves-light" id= "backbtn">{{__('BACK')}}</a>
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
    <script src="{{ URL::asset('/assets/admin/supervisor/edit.js') }}"></script>
    <script>
        store = "{{route('admin.super_visor.store')}}";
        list_url = "{{route('admin.super_visor.index')}}";

        var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }
        var backbtn = document.getElementById("backbtn");
        backbtn.disabled = false;

        $("#backbtn").click(function() {
            history.back();
        })

    </script>
@endsection
