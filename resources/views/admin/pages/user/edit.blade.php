@extends('admin.layouts.master')
@section('title') Edit User @endsection
@section('page-title') {{__('edit user')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/user/style.css')}}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        input::placeholder {
            opacity: 0.4!important; 
        }    
    </style>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.5/dist/bootstrap-validate.js"></script>

@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}" />
            <input type="hidden" name="change_image" id="change_image" value="0" /> 
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                            <div class="row">
                                <div style="text-align: center;" class="text-uppercase">{{__('profile image')}}</div>
                                <div class="picture-container" style="margin-bottom: 30px">
                                    <div class="picture">
                                        <img src="{{$user->avatar == '' ? asset('images/admin/user-profile.jpg') : asset('uploads/user/' . $user->avatar) }}" class="picture-src" id="wizardPicturePreview" title="">
                                        <input type="file" style="display:none;" id="wizard-picture" name="file" class="">
                                    </div>
                                    <label id="avatar_close">
                                        <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/remove.png')}}" />
                                    </label>
                                    <label for="wizard-picture" id="edit-avatar">
                                        <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/edit.png')}}" />
                                    </label>
                                </div>
                                <br>
                        </div>
                        <div class="row">
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> {{__('name')}}</label>
                                        <input type="text" class="form-control" name="name" minlength="1" maxlength="100" required value="{{ $user->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('phone')}}</label>
                                        <div class="input-group" style="flex-wrap: nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+ 962</span>
                                            </div>
                                            <div style="width: 100%">
                                                <input data-parsley-type="number" minlength="8" maxlength="9" type="text" class="form-control" name="phone" id="phone_inp" value="{{ $user->phone }}" placeholder="7 xxxx xxxx">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('address')}}</label>
                                        <div>
                                            <textarea class="form-control" maxlength="250" rows="3" name="address">{{ $user->address }}</textarea>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <!-- <div><br></div>
                                    <div class="picture-container">
                                        <div class="picture">

                                        </div>
                                    </div>-->
                                    <div class="mb-3">
                                            <label><span class="custom-val-color">*</span> {{__('date of birth')}}</label>
                                            <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                                <div style="width: 100%">
                                                    <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="startdate"
                                                        data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                        data-provide="datepicker" name="start_date" value="{{ date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y',strtotime($user->birth_day)) }}" required>
                                                </div>
                                                <div>
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{__('username')}}                                            </label>
                                            <input type="text" class="form-control" name="user_name" minlength="5" maxlength="50"  pattern="^\S+$" readonly required value="{{ $user->user_name }}">
                                        </div>
      
                                        <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> {{__('status')}}                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning mb-3">
                                                    @if(Session::get('lang') != 'jor')
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="status_1" value="1" {{ $user->status == 1 ? "checked" : "" }}>
                                                    <label class="form-check-label text-capitalize" for="status_1">
                                                        {{__('active')}}
                                                    </label>
                                                    @else
                                                    <input class="form-check-input radioRight" type="radio" name="status"
                                                        id="status_1" value="1" {{ $user->status == 1 ? "checked" : "" }}>
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
                                                        id="status_2" value="0" {{ $user->status == 0 ? "checked" : "" }}>
                                                    <label class="form-check-label text-capitalize" for="status_2">
                                                        {{__('inactive')}}
                                                    </label>
                                                    @else
                                                    <input class="form-check-input radioRight" type="radio" name="status"
                                                        id="status_2" value="0" {{ $user->status == 0 ? "checked" : "" }}>
                                                    <label class="form-check-label labelRight text-capitalize" for="status_2">
                                                        {{__('inactive')}}
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 select-validation">
                                                <label class="form-label"><span class="custom-val-color">*</span>  {{__('role')}}</label>
                                                <select class="form-select" name="user_role" id="user_role" required>
                                                    <option value="">{{__('Select Role')}}</option>
                                                    @foreach($roles as $row)
                                                    <option value="{{$row->id}}" {{$user->role == $row->id ? 'selected' :''}}>{{ $lang=="jor"? $row->name_ar: $row->name_en}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="button-group">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light text-uppercase" id="backbtn">{{__('back')}}</button>
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn text-uppercase">{{__('reset')}}</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light text-uppercase">{{__('save')}}</button>
            </div>            </div>
  
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
    <script src="{{ URL::asset('/assets/admin/user/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        var str = "{{ asset('/images/admin/user-profile.jpg') }}";

        $("#avatar_close").click(() => {
            $("#edit-avatar").css('display', 'block');
            $("#avatar_close").css('display', 'none');
            $("#wizardPicturePreview").attr('src', str);
            $("#wizard-picture").val("");
            $("#change_image").val("1");

        })

        $("#wizard-picture").change(() => {
            if($("#wizard-picture").val() != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            }
        })

        $(document).ready(() => {
            $("#user_role").select2();
            if('{{$user->avatar}}' != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            } else {
                $("#edit-avatar").css('display', 'block');
                $("#avatar_close").css('display', 'none');
            }
        })
        store = "{{route('admin.user.store')}}";
        list_url = "{{route('admin.user.index')}}";


        let setval = new Date();
        setval = (setval.getMonth() + 1) + '/' +  (setval.getDate() - 1) + '/' + setval.getFullYear();
        // console.log(setval)
        $('#startdate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}",
            endDate: new Date(setval)
        });
        $('#startdate').change(function () {
            if (new Date($('#startdate').val()) > new Date(setval)) {
                $('#startdate').val(setval);
            }
            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });
        $("#backbtn").click(() => {
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
            
            // end validate
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
