@extends('admin.layouts.master')
@section('title') Edit Bus @endsection
@section('page-title') {{__('edit bus')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <!-- <input type="hidden" name="id" value="{{$bus->id}}" /> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('bus no.')}}</label>
                                    <input type="text" class="form-control" name="bus_no"  value="{{$bus->bus_no}}" required>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('bus size')}}</label>
                                    <select class="form-select" name="bus_size" required>
                                        <option value="">Select Bus Size</option>
                                        @foreach($bus_size as $row)
                                        <option value="{{$row->id}}" {{$bus->bus_size_id == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('license number')}}</label>
                                    <input type="text" class="form-control" name="license_number" minlength="5" maxlength="15" value="{{$bus->license_no}}"  required>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('license expiry date')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="start_date" value="{{date('d/m/Y', strtotime($bus->license_expiry_date))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('type')}}</label>
                                    <select class="form-select" name="bus_type" required>
                                        <option value="">Select Type</option>
                                        @foreach($bus_type as $row)
                                        <option value="{{$row->id}}" {{$bus->bus_type_id == $row->id ? 'selected' :''}}>{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('model')}}</label>
                                    <select class="form-select" name="bus_model">
                                        <option value="">Select Model</option>
                                        <option value="{{$bus->bus_model_id}}" selected>{{$bus->model_en}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('model year')}}</label>
                                    <select class="form-select" name="model_year" required>
                                        <option value="">Select Model Year</option>
                                        @foreach($model_year as $row)
                                        <option value="{{$row}}" {{$bus->model_year == $row ? 'selected' :''}}>{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>  {{__('ownership')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="ownership"
                                                    id="owned" value="1" {{$bus->owner_ship == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="owned">
                                                    {{__('Owned')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="ownership"
                                                    id="rented" value="0" {{$bus->owner_ship == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="rented">
                                                    {{__('Rented')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>  {{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$bus->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-7">
                    <img src="{{ URL::asset ('/images/admin/add-bus.png') }}" alt="" width="100%">
                </div> -->
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
    <script src="{{ URL::asset('/assets/admin/bus/edit.js') }}"></script>
    <script>
        $(document).ready(function(){

                //  setStart date
         $( "#startdate" ).on( "change", function() {
            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });

        //  setEnd date
        $( "#enddate" ).on( "change", function() {
            $("#enddate-div").children("ul").removeClass("filled");
            $("#enddate-div").children("input").removeClass( "parsley-error" );
        });

            // validate
        $(".reset-btn").click(function(){
            // $( ".parsley-errors-list.filled" ).hide();
            location.reload();
            });

            $('#custom-form').submit(function(e){
                // $( ".parsley-errors-list.filled" ).show();
            });
            // end validate

            store = "{{route('admin.bus.update', ['bu' => $bus->id])}}";
            list_url = "{{route('admin.bus.index')}}";
            $("select[name='bus_type']").on("change", function (e) {
                var select_val = $(e.currentTarget).val();
                show_url = "{{route('admin.bus.show', ['bu' => 1])}}";
                show_url = show_url.replace(':bu', select_val);
                $.ajax({
                    url: show_url,
                    method: 'get',
                    success: function (res) {
                        result = res.data;
                        if(result){
                            $("select[name='bus_model']").empty()
                            $("select[name='bus_model']").append("<option value=''>Select model</option>")
                            for(i=0; i<result.length; i++ ){
                                $("select[name='bus_model']").append('<option value="'+result[i].id+'">'+result[i].model_en+'</option>');
                            }
                        }
                    },
                    error: function (res){
                        console.log(res)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })

            $("#backbtn").click(function() {
                location.assign(list_url);
            });
        });
    </script>
@endsection
