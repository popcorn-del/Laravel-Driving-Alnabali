@extends('admin.layouts.master')
@section('title') Edit App Supervisor @endsection
@section('page-title') {{__('edit app supervisor')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/driver/style.css')}}" rel="stylesheet" type="text/css" >

    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.5/dist/bootstrap-validate.js"></script>

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
                                            <input type="file" id="wizard-picture" style="display: none;" name="file" class="">
                                        </div>

                                        <label id="avatar_close">
                                            <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/remove.png')}}" />
                                        </label>
                                        <label for="wizard-picture" id="edit-avatar">
                                            <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/edit.png')}}" />
                                        </label>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name')}} </label>
                                    <input minlength="1" maxlength="100" type="text" class="form-control" name="name_en" id="name_en" value="{{$supervisor->name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('phone')}}</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <div style="width: 100%">
                                            <input data-parsley-type="number" minlength="8" maxlength="9" type="text" class="form-control" name="phone" id="phone_inp" value="{{$supervisor->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('address')}}</label>
                                    <div>
                                        <textarea class="form-control" maxlength="50" rows="5" name="address" value="{{$supervisor->address}}">{{$supervisor->address}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('date of birth')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="birthdate-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="birthdate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="birthday" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($supervisor->birthday))}}"  required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('username')}}</label>
                                    <input type="text" class="form-control" minlength="5" pattern="^\S+$" maxlength="50" name="user_name" readonly value="{{$supervisor->user_name}}" required>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('status')}}</label>
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
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
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
    <script src="{{ URL::asset('/assets/admin/supervisor/edit.js') }}"></script>
    <script>
        var str = "{{ asset('/images/admin/user-profile.jpg') }}";

        $("#avatar_close").click(() => {
            $("#edit-avatar").css('display', 'block');
            $("#avatar_close").css('display', 'none');
            $("#wizardPicturePreview").attr('src', str);
            $("#wizard-picture").val("");
        })

        $("#wizard-picture").change(() => {
            if($("#wizard-picture").val() != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            }
        })

        $(document).ready(() => {
            if($("#wizardPicturePreview").attr('src') != 'http://213.136.71.7/Alnabali/public/images/admin/user-profile.jpg') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            } else {
                $("#edit-avatar").css('display', 'block');
                $("#avatar_close").css('display', 'none');
            }
        })
        store = "{{route('admin.user.store')}}";
        list_url = "{{route('admin.user.index')}}";

        store = "{{route('admin.super_visor.store')}}";
        list_url = "{{route('admin.super_visor.index')}}";


        let setval = new Date();
        setval = (setval.getMonth() + 1) + '/' +  (setval.getDate() - 1) + '/' + setval.getFullYear();
        // console.log(setval)
        $('#birthdate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}",
            endDate: new Date(setval)
        });
        $('#birthdate').change(function () {
            if (new Date($('#birthdate').val()) > new Date(setval)) {
                $('#birthdate').val(setval);
            }
            $("#birthdate-div").children("ul").removeClass("filled");
            $("#birthdate-div").children("input").removeClass( "parsley-error" );
        });

        $("#backbtn").click(function() {
            history.back();
        })
        // validate
        $(".reset-btn").click(function(){
            // $( ".parsley-errors-list.filled" ).hide();
            location.reload();
            });

            $('#custom-form').submit(function(e){
                // $( ".parsley-errors-list.filled" ).show();
            });
            bootstrapValidate(
                '#phone_inp',
                'max:9:Don\'t Enter more than 9 Characters'
            );
            bootstrapValidate(
                '#phone_inp',
                'min:8:Enter at least 8 Characters'
            );
            // end validate
    </script>
@endsection
