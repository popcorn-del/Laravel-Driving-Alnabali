@extends('admin.layouts.master')
@section('title') View Bus @endsection
@section('page-title') View Bus @endsection
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
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">BUS NO</label>
                                    <input type="text" class="form-control" name="bus_no" value="{{$bus->bus_no}}" required>
                                </div>
                                <div class="mb-3">
                                    <label>BUS SIZE</label>
                                    <select class="form-select" name="bus_size" required>
                                        <option value="">Select bus size</option>
                                        @foreach($bus_size as $row)
                                        <option value="{{$row->id}}" {{$bus->bus_size_id == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">LICENSE NUMBER</label>
                                    <input type="text" class="form-control" name="license_number" value="{{$bus->license_no}}"  required>
                                </div>
                                <div class="mb-3">
                                    <label>LICENSE EXPIRY DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="start_date" value="{{date('d/m/Y', strtotime($bus->license_expiry_date))}}" required>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>TYPE</label>
                                    <select class="form-select" name="bus_type" required>
                                        <option value="">Select</option>
                                        @foreach($bus_type as $row)
                                        <option value="{{$row->id}}" {{$bus->bus_type_id == $row->id ? 'selected' :''}}>{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>MODEL</label>
                                    <select class="form-select" name="bus_model" required>
                                        <option value="">Select model</option>
                                        <option value="{{$bus->bus_model_id}}" selected>{{$bus->model_en}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>SELECT MODEL YEAR</label>
                                    <select class="form-select" name="model_year" required>
                                        <option value="">Select Model Year</option>
                                        @foreach($model_year as $row)
                                        <option value="{{$row}}" {{$bus->model_year == $row ? 'selected' :''}}>{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">OWNERSHIP</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="ownership"
                                                    id="owned" value="1" {{$bus->owner_ship == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="owned">
                                                    Owned
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="ownership"
                                                    id="rented" value="0" {{$bus->owner_ship == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="rented">
                                                    Rented
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">STATUS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$bus->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_1">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_2">
                                                    Inactive
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
    <script src="{{ URL::asset('/assets/admin/bus/edit.js') }}"></script>
    <script>
        $(document).ready(function(){

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
        });
    </script>
@endsection