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
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                            <div class="row">
                                <div style="text-align: center;">{{__('profile image')}}</div>
                                <div class="picture-container" style="margin-bottom: 30px">
                                    <div class="picture">
                                        <img src="{{$user->avatar == '' ? 'http://167.86.102.230/Alnabali/public/images/admin/user-profile.jpg' : 'http://167.86.102.230/Alnabali/public/uploads/user/' . $user->avatar }}" class="picture-src" id="wizardPicturePreview" title="">
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
                                        <label class="form-label"><span class="custom-val-color">*</span> {{__('phone')}}</label>
                                        <div class="input-group" style="flex-wrap: nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+ 962</span>
                                            </div>
                                            <div style="width: 100%">
                                                <input data-parsley-type="number" minlength="8" maxlength="9" type="text" class="form-control" name="phone" required value="{{ $user->phone }}">
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
                                            <label><span class="custom-val-color">*</span>{{__('date of birth')}}</label>
                                            <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                                <div style="width: 100%">
                                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                        data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                        data-provide="datepicker" name="start_date" value="{{ $user->birth_day }}" required>
                                                </div>
                                                <div>
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label"><span class="custom-val-color">*</span>{{__('username')}}                                            </label>
                                            <input type="text" class="form-control" name="user_name" minlength="5" maxlength="50"  pattern="^\S+$" readonly required value="{{ $user->user_name }}">
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label class="form-label"><span class="custom-val-color">*</span> PASSWORD</label>
                                            <div>
                                                <input type="password" id="pass2" class="form-control" name="password" required />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"><span class="custom-val-color">*</span> CONFIRM PASSWORD</label>
                                            <div>
                                                <input type="password" class="form-control" required data-parsley-equalto="#pass2" />
                                            </div>
                                        </div> -->
                                        <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span>{{__('status')}}                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning mb-3">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="status_1" value="1" {{ $user->status == 1 ? "checked" : "" }}>
                                                    <label class="form-check-label" for="status_1">
                                                        {{__('active')}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="status_2" value="0" {{ $user->status == 0 ? "checked" : "" }}>
                                                    <label class="form-check-label" for="status_2">
                                                        {{__('inactive')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color">*</span> LEVEL</label>
                                                <div class="row">
                                                    <div class="col-md-6" style="display:none">
                                                        <div class="form-check form-radio-warning mb-3">
                                                            <input class="form-check-input" type="radio" name="role"
                                                                id="level_1" value="1" {{ $user->role == 1 ? "checked" : "" }}>
                                                            <label class="form-check-label" for="level_1">
                                                                {{__('super admin')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning mb-3">
                                                            <input class="form-check-input" type="radio" name="role"
                                                                id="level_2" value="2" {{ $user->role == 2 ? "checked" : "" }}>
                                                            <label class="form-check-label" for="level_2">
                                                                {{__('admin')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning">
                                                            <input class="form-check-input" type="radio" name="role"
                                                                id="level_3" value="3" {{ $user->role == 3 ? "checked" : "" }}>
                                                            <label class="form-check-label" for="level_3">
                                                                {{__('editor')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
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
    <script src="{{ URL::asset('/assets/admin/user/index.js') }}"></script>
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
            if($("#wizardPicturePreview").attr('src') != 'http://167.86.102.230/Alnabali/public/images/admin/user-profile.jpg') {
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
        $('#startdate').datepicker('setEndDate',new Date(setval));
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
    </script>
@endsection
