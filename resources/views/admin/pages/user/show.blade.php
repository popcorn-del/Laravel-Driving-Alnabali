@extends('admin.layouts.master')
@section('title') View User @endsection
@section('page-title') View User @endsection
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
                        <div style="text-align: center;">PROFILE IMAGE</div>
                        <div class="picture-container" style="margin-bottom: 30px">
                            <div class="picture">
                                <img src="{{$user->avatar == '' ? 'http://167.86.102.230/Alnabali/public/images/admin/user-profile.jpg' : 'http://167.86.102.230/Alnabali/public/uploads/user/' . $user->avatar }}" class="picture-src" id="wizardPicturePreview" title="">
                                <input type="file" id="wizard-picture" name="file" class="" required>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <!-- <div>PROFILE IMAGE</div>
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ asset('/images/admin/user-profile.jpg') }}" class="picture-src" id="wizardPicturePreview" title="">
                                        <input type="file" id="wizard-picture" name="file" class="" required>
                                    </div>
                                </div>
                                <br> -->
                                <div class="mb-3">
                                    <label class="form-label">NAME</label>
                                    <input type="text" class="form-control" name="name" required value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">PHONE</label>
                                    <div class="input-group">
                                            <span class="input-group-text">+ 962</span>
                                            <input data-parsley-type="number" type="text" class="form-control" name="phone" required value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ADDRESS</label>
                                    <div>
                                        <textarea class="form-control" rows="3" name="address" required value="{{ $user->email }}"></textarea>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            <div class="col-md-6">
                                <!-- <div><br></div>
                                <div class="picture-container">
                                    <div class="picture">
                                        
                                    </div>
                                </div>
                                <br> -->
                                <div class="mb-3">
                                    <label>DATE OF BIRTH</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="start_date" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">USERNAME</label>
                                        <input type="text" class="form-control" name="user_name" required value="{{ $user->user_name }}">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label">PASSWORD</label>
                                        <div>
                                            <input type="password" id="pass2" class="form-control" name="password" required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">CONFIRM PASSWORD</label>
                                        <div>
                                            <input type="password" class="form-control" required data-parsley-equalto="#pass2" />
                                        </div>
                                    </div> -->
                                    <div class="mb-3">
                                    <label class="form-label">STATUS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{ $user->status == 1 ? "checked" : "" }}>
                                                <label class="form-check-label" for="status_1">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{ $user->status == 0 ? "checked" : "" }}>
                                                <label class="form-check-label" for="status_2">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">LEVEL</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning mb-3">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="level_1" value="1" {{ $user->role == 1 ? "checked" : "" }}>
                                                    <label class="form-check-label" for="level_1">
                                                        Super Admin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning mb-3">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="level_1" value="1" {{ $user->role == 2 ? "checked" : "" }}>
                                                    <label class="form-check-label" for="level_1">
                                                        Admin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-radio-warning">
                                                    <input class="form-check-input" type="radio" name="role"
                                                        id="level_2" value="2" {{ $user->role == 3 ? "checked" : "" }}>
                                                    <label class="form-check-label" for="level_2">
                                                        Editor
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
                <div class="col-md-6"></div>
            </div>
            <div class="button-group">
                <a href="#" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">Back</a>
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

         // disable element
         var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }
            // end disable element

        $("#backbtn").click(function() {
            history.back();
        })

    </script>
@endsection