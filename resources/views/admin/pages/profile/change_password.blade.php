@extends('admin.layouts.master')
@section('title') Change Password @endsection
@section('page-title') Change Password @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/user/style.css')}}" rel="stylesheet" type="text/css" >

    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.5/dist/bootstrap-validate.js"></script>



    
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" id="change-password">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_password"><span class="custom-val-color">*</span> OLD PASSWORD</label>
                                    <input id="current-password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" autocomplete="current_password"
                                        placeholder="Enter Old Password" value="{{ old('current_password') }}">
                                    <div class="text-danger" id="current_passwordError" data-ajax-feedback="current_password"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="newpassword"><span class="custom-val-color">*</span> NEW PASSWORD</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new_password" placeholder="Enter New Password">
                                    <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="userpassword"><span class="custom-val-color">*</span> CONFIRM PASSWORD</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                        autocomplete="new_password" placeholder="Enter New Confirm password" required>
                                    <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="button-group" style="margin-top: 8vw;">
                        <button class="btn btn-primary waves-effect waves-light UpdatePassword" data-id="{{ Auth::user()->id }}"
                            type="submit">Change</button>
                <!-- <a href="#" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">Back</a>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">Reset</button> -->
                <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">Change</button> -->
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
        store = "{{route('admin.user.store')}}";
        list_url = "{{route('admin.user.index')}}";
        let setval = new Date();
        setval = setval.getFullYear() + '-' + (setval.getMonth() + 1) + '-' +  (setval.getDate() - 1);
        // console.log(setval)
            $('#startdate').datepicker('setEndDate',new Date(setval));
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
    </script>
@endsection