@extends('admin.layouts.master')
@section('title') View Maintenace Record @endsection
@section('page-title') View Maintenance Record @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    <div class="content-warpper">
        <form id="custom-form" class="custom-validation" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">BUS NO.</label>
                                    <select class="form-select" name="bus_no" required>
                                        <option value="">Select Bus NO. </option>
                                        @foreach($bus as $row)
                                        <option value="{{$row->id}}" {{$bus_maintenace->bus_no == $row->id ? "selected" : ""}}>{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>TYPE</label>
                                    <select class="form-select" name="maintenace_type" required>
                                        <option value="">Select Tyepe</option>
                                        @foreach($bus_maintenace_type as $row)
                                        <option value="{{$row->id}}" {{$bus_maintenace->maintanence_type_id == $row->id ? "selected" : ""}}>{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">DETAILS</label>
                                    <div>
                                        <textarea class="form-control" rows="3" name="details">{{$bus_maintenace->details}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="date" value="{{date('d/m/Y', strtotime($bus_maintenace->maintanence_date))}}" required>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">COST</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="cost" value="{{$bus_maintenace->cost}}" required>
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
    <script src="{{ URL::asset('/assets/admin/busMaintenance/edit.js') }}"></script>
    <script>
        store = "{{route('admin.maintenance.update', ['maintenance' => $bus_maintenace->id])}}";
        list_url = "{{route('admin.maintenance.index')}}";

        // disable element
        var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
            }
            // end disable element
            var backbtn = document.getElementById("backbtn");
        backbtn.disabled = false;

        $("#backbtn").click(function() {
            history.back();
        })
    </script>
@endsection