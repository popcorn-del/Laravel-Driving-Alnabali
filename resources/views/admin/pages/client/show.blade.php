@extends('admin.layouts.master')
@section('title') View Client @endsection
@section('page-title') View Client @endsection
@section('css')
@section('css')

    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/driver/style.css')}}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form">
            @csrf
            <input type="hidden" name="id" value="{{$client->id}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-6">
                                    <div style="text-align: center">LOGO</div>
                                    <div class="picture-container" style="margin-bottom: 30px">
                                        <div class="picture">
                                            <img src="{{ asset('/images/admin/client_default.png') }}" class="picture-src" id="wizardPicturePreview" title="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NAME (EN)</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$client->name_en}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">TYPE</label>
                                    <div class="row">
                                        @foreach($client_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="client_type_id"
                                                    id="client_type_{{$key}}" value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label" for="client_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NAME (AR)</label>
                                    <input type="text" class="form-control" name="name_ar" value="{{$client->name_ar}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CONTRACT TYPE</label>
                                    <div class="row">
                                        @foreach($contract_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label" for="contract_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">ADDRESS</label>
                            <div>
                                <textarea class="form-control" rows="3" name="address">{{$client->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">PHONE</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <input data-parsley-type="number" type="text" class="form-control" name="phone" value="{{$client->phone_number}}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">WEBSITE</label>
                                    <div>
                                        <input type="text" class="form-control" name="website" value="{{$client->website}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>CONTRACT START DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                            data-date-format="yyyy-mm-dd" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="start_date" value="{{date('d/m/Y', strtotime($client->contract_start_date))}}" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">LIAISON NAME</label>
                                    <div>
                                        <input type="text" class="form-control" name="name_liaison" value="{{$client->liaison_name}}" required/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">RECORDE NUMBER</label>
                                    <div>
                                        <input type="text" class="form-control" name="recorde_number" value="{{$client->record_number}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">EMAIL</label>
                                    <div>
                                        <input type="email" class="form-control" required parsley-type="email" name="email" value="{{$client->email}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">FAX</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <div style="width: 100%">
                                            <input type="text" pattern="[0-9]" class="form-control" id='fax_inp' value="{{$client->fax}}" maxlength="8" minlength="8" name="fax"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>CONTRACT END DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                            data-date-format="yyyy-mm-dd" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="end_date" value="{{date('d/m/Y', strtotime($client->contract_end_date))}}" required>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">LIAISON PHONE</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <input data-parsley-type="number" type="text" class="form-control" name="phone_liaison" value="{{$client->liaison_phone}}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">STATUS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value="1" {{$client->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_1">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$client->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_2">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-5">
                    <img src="{{ URL::asset ('/images/admin/bus.png') }}" alt="" width="100%">
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
    <script src="{{ URL::asset('/assets/admin/client/index.js') }}"></script>
    <script>
         store = "{{route('admin.client.store')}}";
         list_url = "{{route('admin.client.index')}}";


         var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }
        var backbtn = document.getElementById("backbtn");
        backbtn.disabled = false;

        $("#backbtn").click(function() {
            history.back();
        })
    </script>
@endsection
