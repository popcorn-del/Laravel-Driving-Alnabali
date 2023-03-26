@extends('admin.layouts.master')
@section('title') My Profile @endsection
@section('page-title') My Profile @endsection
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
            <input type="hidden" name="id" value="{{Auth::user()->id}}" />
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> NAME</label>
                                        <input type="text" class="form-control" name="name" minlength="1" maxlength="100" required value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> PHONE</label>
                                        <div class="input-group" style="flex-wrap: nowrap">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+ 962</span>
                                            </div>
                                            <div style="width: 100%">
                                                <input data-parsley-type="number" minlength="8" maxlength="8" type="text" class="form-control" name="phone" required value="{{ Auth::user()->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> EMAIL</label>
                                        <input type="text" class="form-control" name="email" minlength="1" maxlength="100" required value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="button-group">
                <!-- <a href="#" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">Back</a> -->
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">Reset</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
    <!-- <script src="{{ URL::asset('/assets/admin/user/index.js') }}"></script> -->
    <script>
        store = "{{route('updateProfile', ['id' => Auth::user()->id])}}";
        // list_url = "{{route('admin.user.index')}}";
        $(document).ready(() => {

            $('#custom-form').submit(function(e){
                // $( ".parsley-errors-list.filled" ).show();
            });
            $(".reset-btn").click(function(){
                $("#custom-form").trigger("reset");
                // location.reload();
            });
            $('#custom-form').submit(function(e){
                e.preventDefault();
                e.stopPropagation();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: store,
                    method: 'post',
                    data: formData,
                    success: function (res) {
                        console.log(res)
                        if(res.isSuccess == true ){
                            toastr["success"](res.Message);
                            setInterval(function(){ 
                                location.reload();
                            }, 2000);
                        } else {
                            toastr["warning"](res.Message);
                        }
                    },
                    error: function (errors){
                        toastr["warning"](errors);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
        })
        // end validate
    </script>
@endsection