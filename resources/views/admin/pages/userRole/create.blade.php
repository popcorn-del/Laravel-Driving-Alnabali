@extends('admin.layouts.master')
@section('title') Add User Role @endsection
@section('page-title') {{__("add user role")}} @endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<style>
    input::placeholder {
        opacity: 0.4!important; 
    }
</style>
@endsection
@section('content')
    <div class="content-warpper">
        <form class="custom-validation" action="{{route('admin.trip_bus.create')}}" id="custom-form">
        @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> {{__('name (en)')}}</label>
                                        <input type="text" class="form-control" minlength="1" maxlength="100"  name="name_en"  required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="custom-val-color">*</span> {{__('name (ar)')}}</label>
                                        <input type="text" class="form-control" name="name_ar" minlength="1" maxlength="100"  required>
                                    </div>
                                </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-6 add-new-form">
                                        <div class="form-label col-md-12 text-uppercase"><span class="custom-val-color" id="permission_star">*</span>     {{__('permissions')}}
                                        <div class = "row border rounded border-secondary daysofweek"  id="daysofweek">
                                                <div class = "trip-frequency-check">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-check form-check-warning">
                                                                <input class="form-check-input" type="checkbox" id="select_all" />
                                                                <label class="form-check-label" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" style="text-transform: initial;" >
                                                            {{__('Choose One or More')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    @foreach($permissions as $row)
                                                        <div class="col-md-3 form-check-user-role form-check-warning">
                                                            <input class="form-check-input" type="checkbox" id="permission_{{$row->id}}" name="permission[]"
                                                                value = "{{$row->id}}" >
                                                            <label class="form-check-label text-capitalize" for="permission_{{$row->id}}">
                                                                {{$row->name}}
                                                            </label>
                                                        </div>    
                                                    @endforeach
                                                    
                                                </div>
                                   
                                            </div>

                                            <input type="checkbox" value="" id="validateBox" style="display: none;" required>
                                    </div>
                                </div>
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light" id="backbtn">{{__('BACK')}}</button>
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('SAVE')}}</button>
                            </div>
                    </div>
         
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
<script src="{{ URL::asset('/assets/admin/user_role/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>


    $("#backbtn").on('click', () => {
        location.href="{{route('admin.user_role.index')}}";
    })
    function isNumeric(str) {
        if (typeof str != "string") return false // we only process strings!
        return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
                !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
    }

    $(document).ready(function(){
        store = "{{route('admin.user_role.store')}}";
        list_url = "{{route('admin.user_role.index')}}";
        function updateStatus(){
            if ($('div#daysofweek input:checked').length > 0 ){
                $('#validateBox').prop('checked', true);
            }
            else {
                $('#validateBox').prop('checked', false);
            }
        }

        //select all
        $("#select_all").click(function () {
            // Check/uncheck all checkboxes based on the "Select All" checkbox state
            $("input[name='permission[]']").prop("checked", this.checked);

        });
        // When any day checkbox is clicked
        $("input[name='permission[]']").click(function () {
            // Check if all day checkboxes are checked and update "Select All" accordingly
            if ($("input[name='permission[]']:checked").length === $("input[name='permission[]']").length) {
                $("#select_all").prop("checked", true);
            } else {
                $("#select_all").prop("checked", false);
            }

            // Save and print selected values
            var selectedValues = [];
            $("input[name='permission[]']:checked").each(function () {
                selectedValues.push($(this).val());
            });

            // Print selected values (you can modify this part as needed)
            console.log("Selected Values: " + selectedValues.join(", "));
        });
        updateStatus();
        $('div#daysofweek input[type="checkbox"]').on("change",updateStatus);


        // $(".add-new-form").hide();

        // validate
        $(".reset-btn").click(function(){
        // $( ".parsley-errors-list.filled" ).hide();
        location.href="{{route('admin.user_role.create')}}";
        });

        $('#custom-form').submit(function(e){
            // $( ".parsley-errors-list.filled" ).show();
        });
        // end validate

        function getOptionByValue (select, value) {
            var options = select.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === value) {
                    return options[i]
                }
            }
            return null
        }
    });
</script>
@endsection
