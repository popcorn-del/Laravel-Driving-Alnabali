@extends('admin.layouts.master')
@section('title') Edit Client @endsection
@section('page-title') EDIT CLIENT @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/admin/driver/style.css')}}" rel="stylesheet" type="text/css" >

    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.5/dist/bootstrap-validate.js"></script>


@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="" id="custom-form" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="{{$client->id}}">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-12">
                                    <div style="text-align: center">LOGO</div>
                                    <div class="picture-container" style="margin-bottom: 30px">
                                        <div class="picture">
                                            <img src="{{$client->client_avatar == '' ? 'http://167.86.102.230/Alnabali/public/images/admin/client_default.png' : 'http://167.86.102.230/Alnabali/public/uploads/image/' . $client->client_avatar }}" class="picture-src" id="wizardPicturePreview" title="">
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
                                    <label class="form-label"><span class="custom-val-color">*</span> NAME (EN)</label>
                                    <input type="text" class="form-control" name="name_en" maxlength="100" value="{{$client->name_en}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> TYPE</label>
                                    <div class="row">
                                        @foreach($client_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="client_type_id"
                                                    id="client_type_{{$key}}" value="{{$row->id}}" {{$client->client_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label" for="client_type_{{$key}}">
                                                    {{$row->type_name_en}}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> NAME (AR)</label>
                                    <input type="text" class="form-control" name="name_ar" maxlength="100" value="{{$client->name_ar}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> CONTRACT TYPE</label>
                                    <div class="row">
                                        @foreach($contract_type as $key=>$row)
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="contract_type_id"
                                                    id="contract_type_{{$key}}" value="{{$row->id}}" {{$client->contract_type_id == $row->id ? "checked" : ""}}>
                                                <label class="form-check-label" for="contract_type_{{$key}}">
                                                    {{$row->type_name_en}}
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
                                <textarea class="form-control" maxlength="250" rows="3" name="address">{{$client->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> PHONE</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <input data-parsley-type="number" minlength="8" maxlength="9" type="text" class="form-control" id="phone_inp" name="phone" value="{{$client->phone_number}}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">WEBSITE</label>
                                    <div>
                                        <input type="text" minlength="5" maxlength="70" class="form-control" name="website" value="{{$client->website}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> CONTRACT START DATE</label>
                                    <div class="input-group" id="datepicker1" style="flex-wrap: nowrap">
                                        <div style="width: 100%" id="startdate-div">
                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                                data-provide="datepicker" name="start_date" value="{{date('d/m/Y', strtotime($client->contract_start_date))}}" required>
                                        </div>
                                        <div>
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> LIAISON NAME</label>
                                    <div>
                                        <input type="text" class="form-control" minlength="1" maxlength="100" name="name_liaison" value="{{$client->liaison_name}}" required/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> RECORDE NUMBER</label>
                                    <div>
                                        <input type="text" class="form-control" minlength="1" maxlength="100" name="recorde_number" value="{{$client->record_number}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color"></span> EMAIL</label>
                                    <div>
                                        <input type="email" class="form-control" minlength="5" maxlength="70" parsley-type="email" name="email" value="{{$client->email}}"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">FAX</label>
                                    <div class="input-group" style="flex-wrap: nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <div style="width: 100%">
                                            <input data-parsley-type="number" type="text" class="form-control" id='fax_inp' value="{{$client->fax}}" name="fax"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> CONTRACT END DATE</label>
                                    <div class="input-group" id="datepicker2" style="flex-wrap: nowrap">
                                    <div style="width: 100%" id="enddate-div">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="enddate"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker2'
                                                data-provide="datepicker" name="end_date" value="{{date('d/m/Y', strtotime($client->contract_end_date))}}" required>
                                    </div>
                                    <div>
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    </div><!-- input-group -->
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> LIAISON PHONE</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+ 962</span>
                                        </div>
                                        <input data-parsley-type="number" type="text" class="form-control" id="phone_inp2" name="phone_liaison" value="{{$client->liaison_phone}}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> STATUS</label>
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
                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">Reset</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('script')

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
    <script>
        var str = "{{ asset('/images/admin/client_default.png') }}";

        $("#avatar_close").click(() => {
            $("#edit-avatar").css('display', 'block');
            $("#avatar_close").css('display', 'none');
            $("#wizardPicturePreview").attr('src', str);
            $("#wizard-picture").val("");
        })

        $("#wizard-picture").change(() => {
            if($("#wizard-picture").val() != '') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            }
        })

        $(document).ready(() => {
            if($("#wizardPicturePreview").attr('src') != 'http://167.86.102.230/Alnabali/public/images/admin/client_default.png') {
                $("#edit-avatar").css('display', 'none');
                $("#avatar_close").css('display', 'block');
            } else {
                $("#edit-avatar").css('display', 'block');
                $("#avatar_close").css('display', 'none');
            }
        })
         store = "{{route('admin.client.store')}}";
         list_url = "{{route('admin.client.index')}}";
         //  setStart date
         $( "#startdate" ).on( "change", function() {
            $("#enddate").click();
            var setval = $(this).datepicker('getDate'); 
            $('#enddate').datepicker('setStartDate',setval);

            $("#startdate-div").children("ul").removeClass("filled");
            $("#startdate-div").children("input").removeClass( "parsley-error" );
        });

        //  setEnd date
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

        document.addEventListener("keyup", KeyCheck);  //or however you are calling your method
        function KeyCheck(event)
        {
           var KeyID = event.keyCode;
           console.log($("#fax_inp").val().length)
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

        $('#custom-form').submit(function(e){
            // $( ".parsley-errors-list.filled" ).show();
        });
        // end validate

        bootstrapValidate(
            '#phone_inp',
            'max:9:Don\'t Enter more than 9 Characters'
        );
        bootstrapValidate(
            '#phone_inp',
            'min:8:Enter at least 8 Characters'
        );
        bootstrapValidate(
            '#phone_inp2',
            'max:9:Don\'t Enter more than 9 Characters'
        );
        bootstrapValidate(
            '#phone_inp2',
            'min:8:Enter at least 8 Characters'
        );
        bootstrapValidate(
            '#fax_inp',
            'max:8:Enter exactly 8 digits'
        );
        bootstrapValidate(
            '#fax_inp',
            'min:8:Enter exactly 8 digits'
        );
    </script>
@endsection