@extends('admin.layouts.master')
@section('title') Edit Maintenace Record @endsection
@section('page-title') {{__('edit maintenance record')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

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
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('bus no.')}}</label>
                                    <select class="form-select" name="bus_no" id ="bus_no" required>
                                        <option value="">{{__('Select Bus No.')}} </option>
                                        @foreach($bus as $row)
                                        <option value="{{$row->id}}" {{$bus_maintenace->bus_no == $row->id ? "selected" : ""}} > {{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('type')}}</label>
                                    <select class="form-select" name="maintenace_type"  id ="maintenace_type" required>
                                        <option value="">{{__('Select Type')}}</option>
                                        @foreach($bus_maintenace_type as $row)
                                        <option value="{{$row->id}}" {{$bus_maintenace->maintanence_type_id == $row->id ? "selected" : ""}}>{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('details')}}</label>
                                    <div>
                                        <textarea class="form-control" rows="3" maxlength="250" minlength="1" name="details" required>{{$bus_maintenace->details}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('date')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="date-daily-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="date-daily"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($bus_maintenace->maintanence_date))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('cost')}}</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="cost" step="0.01" pattern="^\d{1,4}(?:\.\d{1,2})?$" value="{{$bus_maintenace->cost}}" required>
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
    <script src="{{ URL::asset('/assets/admin/busMaintenance/edit.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bus_no').select2();
            $('#maintenace_type').select2();
        });
        store = "{{route('admin.maintenance.update', ['maintenance' => $bus_maintenace->id])}}";
        list_url = "{{route('admin.maintenance.index')}}";
        $('#date-daily').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
        });
        $('#date-daily').change(function () {
            $("#date-daily-div").children("ul").removeClass("filled");
            $("#date-daily-div").children("input").removeClass( "parsley-error" );
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
