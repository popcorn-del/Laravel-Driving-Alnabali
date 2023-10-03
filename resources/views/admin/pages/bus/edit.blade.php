@extends('admin.layouts.master')
@section('title') {{__('Edit Bus')}} @endsection
@section('page-title') {{__('edit bus')}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/bus/style.css')}}" rel="stylesheet" type="text/css" >
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
                                    <select class="form-select" name="bus_size" id ="bus_size" required>
                                        <option value="">{{__('Select Bus Size')}}</option>
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
                                    <select class="form-select" name="bus_type" id ="bus_type" required>
                                        <option value="">{{__('Select Type')}}</option>
                                        @foreach($bus_type as $row)
                                        <option value="{{$row->id}}" {{$bus->bus_type_id == $row->id ? 'selected' :''}}>{{$row->type_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('model')}}</label>
                                    <select class="form-select" name="bus_model" id ="bus_model">
                                        <option value="">{{__('Select Model')}}</option>
                                        <option value="{{$bus->bus_model_id}}" selected>{{$bus->model_en}}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('model year')}}</label>
                                    <select class="form-select" name="model_year" id ="model_year" required>
                                        <option value="">{{__('Select Model Year')}}</option>
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
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="ownership"
                                                    id="owned" value="1" {{$bus->owner_ship == 1 ? 'checked' :''}}>
                                                <label class="form-check-label normal-text" for="owned">
                                                    {{__('Owned')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="ownership"
                                                    id="owned" value="1" {{$bus->owner_ship == 1 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight normal-text" for="owned">
                                                    {{__('Owned')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" radioRight type="radio" name="ownership"
                                                    id="rented" value="0" {{$bus->owner_ship == 0 ? 'checked' :''}}>
                                                <label class="form-check-label normal-text" for="rented">
                                                    {{__('Rented')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="ownership"
                                                    id="rented" value="0" {{$bus->owner_ship == 0 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight normal-text" for="rented">
                                                    {{__('Rented')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span>  {{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$bus->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_1" value="1" {{$bus->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="status"
                                                    id="status_2" value="0" {{$bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label labelRight" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @endif

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
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                <button type="button" id="submit" class="btn btn-primary waves-effect waves-light">{{__('SAVE')}}</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
        $('#bus_size').select2();
        $('#bus_type').select2();
        $('#bus_model').select2();
        $('#model_year').select2();
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

        $('#submit').click(e => {
            var radios = document.querySelectorAll('input[name="status"]');
            var selectedValue;

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    selectedValue = radios[i].value;
                    break;
                }
            }
            if(selectedValue == 0)
            {
                if(!confirm($('#arc_bus_inactive').val()))
                    return;
            }
            $('#custom-form').submit();
        });

            store = "{{route('admin.bus.update', ['bu' => $bus->id])}}";
            list_url = "{{route('admin.bus.index')}}";
            $("select[name='bus_type']").on("change", function (e) {
                var select_val = $(e.currentTarget).val();
                show_url = "{{route('admin.bus.model', ':bus')}}";
                show_url = show_url.replace(':bus', select_val);
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
