@extends('admin.layouts.master')
@section('title') Edit Client @endsection
@section('page-title') {{__('edit client')}} @endsection
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
        input::placeholder {
            opacity: 0.4!important; 
        }
    </style>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.5/dist/bootstrap-validate.js"></script>


@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" method="post" id="custom-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$client->id}}">
            <input type="hidden" name="change_image" id="change_image" value="0" /> 

            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                    <div style="text-align: center">{{__('LOGO')}}</div>
                                    <div class="picture-container" style="margin-bottom: 30px">
                                        <div class="picture">
                                            <img src="{{$client->client_avatar == '' ? asset('images/admin/client_default.png') : asset('uploads/image/' . $client->client_avatar) }}" class="picture-src" id="wizardPicturePreview" title="">
                                            <input type="file" id="wizard-picture" name="client_avatar" class="">
                                        </div>
                                        <label id="avatar_close">
                                            <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/remove.png')}}" />
                                        </label>
                                        <label for="wizard-picture" id="edit-avatar">
                                            <img style="width: 25px;border-radius: 50%;position: absolute;top: 57%;left: 53%;" src="{{asset('/images/edit.png')}}" />
                                        </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (en)')}}</label>
                                    <input type="text" class="form-control" name="name_en" maxlength="100" value="{{$client->name_en}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('type')}}</label>
                                    <div class="row">
                                        @foreach($client_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="client_type_id"
                                                    id="client_type_{{$key}}" value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="client_type_{{$key}}">
                                                    {{$row->type_name_en}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="client_type_id"
                                                    id="client_type_{{$key}}" value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label labelRight1 text-capitalize" for="client_type_{{$key}}">
                                                    {{$row->type_name_ar}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('name (ar)')}}</label>
                                    <input type="text" class="form-control" name="name_ar" maxlength="100" value="{{$client->name_ar}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('contract type')}}</label>
                                    <div class="row">
                                        @foreach($contract_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label text-capitalize" for="contract_type_{{$key}}">
                                                    {{$row->type_name_en}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label labelRight1 text-capitalize" for="client_type_{{$key}}">
                                                    {{$row->type_name_ar}}
                                                </label>
                                                @endif
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
                            <label class="form-label">{{__('address')}}</label>
                            <div>
                                <textarea class="form-control" maxlength="250" rows="3" name="address">{{$client->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label">{{__('phone')}}</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                        </div>
                                        <div style="width:100%;">
                                            <input data-parsley-type="number" type="text" class="form-control phone_inp" data-parsley-pattern="^[0-9]{8,9}$" minlength="8" maxlength="9" name="phone" id="phone_inp" placeholder="7 xxxx xxxx">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('website')}}</label>
                                    <div>
                                        <input type="text" minlength="5" maxlength="70" class="form-control" name="website" value="{{$client->website}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('contract start date')}}</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="startdate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="start_date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($client->contract_start_date))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('liaison name')}}</label>
                                    <div>
                                        <input type="text" class="form-control" minlength="1" maxlength="100" name="name_liaison" value="{{$client->liaison_name}}" required/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('record number')}}</label>
                                    <div>
                                        <input type="text" class="form-control" minlength="1" maxlength="100" name="recorde_number" value="{{$client->record_number}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span> {{__('email')}}</label>
                                    <div>
                                        <input type="email" class="form-control" minlength="5" maxlength="70" parsley-type="email" name="email" value="{{$client->email}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{__('fax')}}</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                       </div>
                                       <div style="width: 100%">    
                                           <input data-parsley-type="number" type="text" minlength="8" maxlength="8" class="form-control" id='fax_inp' value="{{$client->fax}}" name="fax" placeholder="6 xxx xxxx"/>
                                       </div>
                                    </div>
                                    <!-- <div style="width: 100%">
                                        <input type="tel" id="phone2" class="form-control phone_inp" name="fax" placeholder="6 xxx xxxx"/>
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> {{__('contract end date')}}</label>
                                    <div class="input-group" id="datepicker2" style="flex-wrap: nowrap">
                                    <div style="width: 100%" id="enddate-div">
                                        <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="enddate"
                                                data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker2'
                                                data-provide="datepicker" name="end_date" value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y', strtotime($client->contract_end_date))}}" required>
                                    </div>
                                    <div>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"> {{__('liaison phone')}}</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text">+ 962</span>
                                       </div>
                                       <input data-parsley-type="number" type="text" minlength="8" maxlength="9" class="form-control" id="phone_inp2" name="phone_liaison" value="{{$client->liaison_phone}}" placeholder="7 xxxx xxxx">
                                    </div>
                                    <!-- <div style="width: 100%">
                                        <input type="tel" id="phone3" class="form-control phone_inp" name="phone_liaison" placeholder="7 xxxx xxxx" required/>
                                    </div> -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('status')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input normal-text" type="radio" name="status"
                                                    id="status_1" value="1" {{$client->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label normal-text text-capitalize" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1 normal-text" type="radio" name="status"
                                                    id="status_1" value="1" {{$client->status == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight1 normal-text text-capitalize" for="status_1">
                                                    {{__('active')}}
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                            @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value="0" {{$client->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label normal-text text-capitalize" for="status_2">
                                                    {{__('inactive')}}
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight1" type="radio" name="status"
                                                    id="status_2" value="0" {{$client->status == 0 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight1 normal-text text-capitalize" for="status_2">
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
                </div> -->
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="submit">{{__('SAVE')}}</button>
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
    <script src="{{ URL::asset('/assets/admin/avatar_load.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js" integrity="sha512-uZZS8rsETXJQX6Jy57Zdc7PAmP83GCjC1F/LX0xUj12wY5SlfUX+CVnYFEX89doutQPeFbI9FjUCkpuTWqlBwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.min.js" integrity="sha512-viyGJzhGVZqq0awVdFrcUjKyAtoYoxXzAZBBkMd1E19TkkdpMM+UpfgF+yaCst2D4Vsz4dMMW1wi2wyvU79BoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var str = "{{ asset('/images/admin/client_default.png') }}";

        $("#avatar_close").click(() => {
            $("#edit-avatar").css('display', 'block');
            $("#avatar_close").css('display', 'none');
            $("#wizardPicturePreview").attr('src', str);
            $("#wizard-picture").val("");
            $("#change_image").val("1");
        })

        $("#wizard-picture").change(() => {
            if($("#wizard-picture").val() != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            }
        })

        $(document).ready(() => {
            if('{{$client->client_avatar}}' != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            } else {
                $("#edit-avatar").css('display', 'block');
                $("#avatar_close").css('display', 'none');
            }

            var input1 = document.querySelector("#phone1");
            var iti1 = window.intlTelInput(input1, {
                autoInsertDialCode: true,
                preferredCountries: ['jo', 'us'],
                separateDialCode: true,
            });
            var jordanOption = iti1.getSelectedCountryData();
            jordanOption.disabled = true;

            iti1.setFlagDropdown(false);
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
            $('#phone1').keydown(function(){
                var number = iti1.getNumber();
                $(this).val(number);
            });
            $('#phone2').keydown(function(){
                var number = iti2.getNumber();
                $(this).val(number);
            });
            $('#phone3').keydown(function(){
                var number = iti3.getNumber();
                $(this).val(number);
            });

            // $('#phone1').on('input', function() {
            //     // Remove all non-digit characters from the input
            //     var phone = $(this).val().replace(/\D/g, '');
                
            //     // Add the country code if missing
            //     if (!phone.startsWith('+962')) {
            //     phone = '+962' + phone;
            //     }
                
            //     // Update the input value with the formatted phone number
            //     $(this).val(phone);
            // });
        })
         store = "{{route('admin.client.store')}}";

         list_url = "{{route('admin.client.index')}}";
         //  setStart date
        $('#startdate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
        });
         $( "#startdate" ).on( "change", function() {
            $("#enddate").click();
            var setval = $(this).datepicker('getDate');
            $('#enddate').datepicker('setStartDate',setval);

            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });

        //  setEnd date
        $('#enddate').datepicker({
            format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
        });
        $( "#enddate" ).on( "change", function() {
            $("#startdate").click();
            var setval = $(this).datepicker('getDate');
            $('#startdate').datepicker('setEndDate',setval);

            $("#enddate-div").children("ul").removeClass("filled");
            $("#enddate-div").children("input").removeClass( "parsley-error" );
        });


        $("#backbtn").on('click', () => {
            // location.assign(list_url);
            history.back();
        })

        //document.addEventListener("keyup", KeyCheck);  //or however you are calling your method
        function KeyCheck(event)
        {
           var KeyID = event.keyCode;
           if ($("#fax_inp").val().length == 8) {
                $("#fax_inp").removeClass("is-invalid");
                $(".has-error-min").css("display", "none");
                return;
           }
           switch(KeyID)
           {
              case 8:
              break;
              case 46:
              break;
              default:
                return;
           }
           if($("#fax_inp").val() == '') {
                $("#fax_inp").removeClass("is-invalid");
                $(".has-error-min").css("display", "none");
           }
        }


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
                if(!confirm($('#arc_client_inactive').val()))
                    return;
            }
            $( ".parsley-errors-list.filled" ).show();

            $('#custom-form').submit();
        });


        // $('#custom-form').submit(function(e){
        //     var radios = document.querySelectorAll('input[name="status"]');
        //     var selectedValue;

        //     for (var i = 0; i < radios.length; i++) {
        //         if (radios[i].checked) {
        //             selectedValue = radios[i].value;
        //             break;
        //         }
        //     }
        //     if(selectedValue == 0)
        //     {
        //         if(!confirm($('#arc_client_inactive').val()))
        //             return;
        //     }
        //     //
        // });

        // end validate

        bootstrapValidate(
            '#phone_inp',
            'max:9:It should fill between 8 and 9 digits',
            'regex:^[0-9]+$:Only digits are allowed'

        );
        bootstrapValidate(
            '#phone_inp',
            'min:8:It should fill between 8 and 9 digits',
            'regex:^[0-9]+$:Only digits are allowed'

        );
        bootstrapValidate(
            '#phone_inp2',
            'max:9:It should fill between 8 and 9 digits'
        );
        bootstrapValidate(
            '#phone_inp2',
            'min:8:It should fill between 8 and 9 digits'
        );
         bootstrapValidate(
            '#fax_inp',
            'max:8:It should be exactly 8 digits'
        );
        bootstrapValidate(
            '#fax_inp',
            'min:8:It should be exactly 8 digits'
        );
    </script>
@endsection
