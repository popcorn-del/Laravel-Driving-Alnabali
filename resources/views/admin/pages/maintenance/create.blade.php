@extends('admin.layouts.master')
@section('title') Add Maintenance Record @endsection
@section('page-title') Add Maintenance Record @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    <div class="content-warpper">
        <form id="custom-form" class="custom-validation" enctype="multipart/form-data">
        {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> BUS NO.</label>
                                    <select class="form-select" name="bus_no" required>
                                        <option value="">Select Bus NO. </option>
                                        @foreach($bus as $row)
                                        <option value="{{$row->id}}">{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> TYPE</label>
                                    <select class="form-select" name="maintenace_type" required>
                                        <option value="">Select Type</option>
                                        @foreach($bus_maintenace_type as $row)
                                        <option value="{{$row->id}}">{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> DETAILS</label>
                                    <div>
                                        <textarea class="form-control" rows="3" maxlength="250" minlength="1" name="details" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> DATE</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div id="date-daily-div" style="width: 100%">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="date" id="date-daily" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> COST</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div style="width: 100%">
                                            <input type="number" class="form-control" pattern="^\d{1,4}(?:\.\d{1,2})?$" name="cost" step="0.01" required>
                                        </div>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">JOD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/maintenance.png') }}" alt="" width="100%">
                </div> -->
                <div class="col-md-2"></div>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">Back</button>
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
    <script src="{{ URL::asset('/assets/admin/busMaintenance/index.js') }}"></script>
    <script>
        store = "{{route('admin.maintenance.store')}}";
        list_url = "{{route('admin.maintenance.index')}}";

        // validate
        $(".reset-btn").click(function(){
        // $( ".parsley-errors-list.filled" ).hide();
        location.reload();
        });

        $('#custom-form').submit(function(e){
            // $( ".parsley-errors-list.filled" ).show();
        });
        // end validate

        $("#backbtn").click(function() {
            location.assign(list_url);
        })

        $('#date-daily').change(function () {
            $("#date-daily-div").children("ul").removeClass("filled");
            $("#date-daily-div").children("input").removeClass( "parsley-error" );
        });
    </script>
@endsection