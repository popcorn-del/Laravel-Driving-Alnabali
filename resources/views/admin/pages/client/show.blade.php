@extends('admin.layouts.master')
@section('title') {{__('View Client')}} @endsection
@section('page-title') {{__('View Client')}} @endsection
@section('css')
@section('css')

    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/driver/style.css')}}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css" integrity="sha512-s51TDsIcMqlh1YdQbF3Vj4StcU/5s97VyLEEpkPWwP0CJfjZ/C5zAaHnG+DZroGDn1UagQezDEy61jP4yoi4vQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .iti {
            width:100%;
        }
    </style>
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
                                    <div style="text-align: center">{{__('LOGO')}}</div>
                                    <div class="picture-container" style="margin-bottom: 30px">
                                        <div class="picture">
                                            <img src="{{$client->client_avatar == '' ? asset('images/admin/client_default.png') : asset('uploads/image/' . $client->client_avatar) }}" class="picture-src" id="wizardPicturePreview" title="">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('name (en)')}}</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$client->name_en}}" disabled required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('type')}}</label>
                                    <div class="row">
                                        @foreach($client_type as $key=>$row)
                                        <div class="col-md-6">
                                            @if(Session::get('lang') != 'jor')
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="client_type_id"
                                                    id="client_type_{{$key}}" disabled value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="client_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check form-radio-warning mb-3">
                                                <label class="form-check-label text-capitalize" for="client_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                                <input class="form-check-input radioRight" type="radio" disabled name="client_type_id"
                                                    id="client_type_{{$key}}" value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('name (ar)')}}</label>
                                    <input type="text" class="form-control" name="name_ar" disabled value="{{$client->name_ar}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('contract type')}}</label>
                                    <div class="row">
                                        @foreach($contract_type as $key=>$row)
                                        <div class="col-md-6">
                                            @if(Session::get('lang') != 'jor')
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" disabled value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="contract_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check form-radio-warning mb-3">
                                                <label class="form-check-label text-capitalize" for="contract_type_{{$key}}">
                                                    @if (app()->getLocale()=='jor')
                                                        {{$row->type_name_ar}}
                                                    @else
                                                        {{$row->type_name_en}}
                                                    @endif
                                                </label>
                                                <input class="form-check-input radioRight " disabled type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">{{__('address')}}</label>
                            <div>
                                <textarea class="form-control" rows="3" disabled name="address">{{$client->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('phone')}}</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                       </div>
                                       <input data-parsley-type="number" type="text" disabled class="form-control" name="phone" value="{{$client->phone_number}}"  required>
                                    </div>
                                    <!-- <div style="width: 100%">
                                        <input type="tel" id="phone1" class="form-control phone_inp" name="phone" placeholder="7 xxxx xxxx"/>
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('website')}}</label>
                                    <div>
                                        <input type="text" disabled class="form-control" disabled name="website" value="{{$client->website}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>{{__('contract start date')}}</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" disabled 
                                            data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="start_date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($client->contract_start_date))}}" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('liaison name')}}</label>
                                    <div>
                                        <input type="text" class="form-control" disabled name="name_liaison" value="{{$client->liaison_name}}" required/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('record number')}}</label>
                                    <div>
                                        <input type="text" class="form-control" disabled name="recorde_number" value="{{$client->record_number}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('email')}}</label>
                                    <div>
                                        <input type="email" class="form-control" disabled required parsley-type="email" name="email" value="{{$client->email}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('fax')}}</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                       </div>
                                       <div style="width: 100%">
                                           <input type="text" pattern="[0-9]" disabled class="form-control" id='fax_inp' value="{{$client->fax}}" maxlength="8" minlength="8" name="fax"/>
                                       </div>
                                    </div>
                                    <!-- <div style="width: 100%">
                                        <input type="tel" id="phone2" class="form-control phone_inp" name="fax" placeholder="6 xxx xxxx" />
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label>{{__('contract end date')}}</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" disabled 
                                            data-date-format="yyyy-mm-dd" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="end_date" value="{{date('d/m/Y', strtotime($client->contract_end_date))}}" required>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('liaison phone')}}</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                       </div>
                                       <input data-parsley-type="number" disabled type="text" class="form-control" name="phone_liaison" value="{{$client->liaison_phone}}"  required>
                                    </div>
                                    <!-- <div style="width: 100%">
                                        <input type="tel" id="phone3" class="form-control phone_inp" name="phone_liaison" placeholder="7 xxxx xxxx" required/>
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input normal-text" disabled type="radio" name="status"
                                                    id="status_1" value="1" {{$client->status == 1 ? "checked" : ""}} >
                                                <label class="form-check-label text-capitalize" for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight normal-text" disabled type="radio" name="status"
                                                    id="status_1" value="1" {{$client->status == 1 ? "checked" : ""}} >
                                                <label class="form-check-label labelRight text-capitalize"  for="status_1">
                                                {{__('active')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" disabled type="radio" name="status"
                                                    id="status_2" value="0" {{$client->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label normal-text text-capitalize" for="status_2">
                                                {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" disabled type="radio" name="status"
                                                    id="status_2" value="0" {{$client->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label normal-text text-capitalize" for="status_2">
                                                {{__('inactive')}}
                                                </label>
                                                @endif
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

                    36+6

                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light backbtn" id="backbtn">{{__('BACK')}}</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js" integrity="sha512-uZZS8rsETXJQX6Jy57Zdc7PAmP83GCjC1F/LX0xUj12wY5SlfUX+CVnYFEX89doutQPeFbI9FjUCkpuTWqlBwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.min.js" integrity="sha512-viyGJzhGVZqq0awVdFrcUjKyAtoYoxXzAZBBkMd1E19TkkdpMM+UpfgF+yaCst2D4Vsz4dMMW1wi2wyvU79BoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
         $("#backbtn").on('click', () => {
            location.href = list_url;
            // history.back();
        })
         store = "{{route('admin.client.store')}}";
         list_url = "{{route('admin.client.index')}}";
        var input1 = document.querySelector("#phone1");
        var iti1 = window.intlTelInput(input1, {
            autoInsertDialCode: true,
            preferredCountries: ['jo', 'us'],
            separateDialCode: true,
        });

        var input2 = document.querySelector("#phone2");
        var iti2 = window.intlTelInput(input2, {
            autoInsertDialCode: true,
            preferredCountries: ['jo', 'us'],
            separateDialCode: true,
        });

        var input3 = document.querySelector("#phone3");
        var iti3 = window.intlTelInput(input3, {
            autoInsertDialCode: true,
            preferredCountries: ['jo', 'us'],
            separateDialCode: true,
        });

        iti1.setNumber('{{$client->phone_number}}');
        iti2.setNumber('{{$client->fax}}');
        iti3.setNumber('{{$client->liaison_phone}}');


         var form = document.getElementById("custom-form");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].readOnly = true;
                elements[i].disabled = true;
        }
        var backbtn = document.getElementById("backbtn");
        backbtn.disabled = false;
    </script>
@endsection
