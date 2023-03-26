@extends('admin.layouts.master')
@section('title') Edit Trip’s Bus @endsection
@section('page-title') EDIT TRIP’s BUS @endsection
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
                <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                
                            <div class="mb-3">
                                <label><span class="custom-val-color"></span> TRIP NAME </label>
                                <select class="form-select" name="trip_name" id="tripname">
                                    <option>Select Trip Name</option>
                                    @foreach($trip as $row)
                                    <option value="{{$row->id}}" {{$trip_bus->trip_name == $row->id ? 'selected' :''}}>{{$row->trip_name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> IS FAKE </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="fake"
                                                    id="fake_1" value = "1">
                                                <label class="form-check-label" for="fake_1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="fake"
                                                    id="fake_2" value = "0" checked>
                                                <label class="form-check-label" for="fake_2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> BUS NO. </label>
                                    <select class="form-select" name="bus_no" id="busno" required>
                                        <option value=''>Select Bus NO.</option>
                                        @foreach($bus_no as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->bus_size == $row->id ? 'selected' :''}}>{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> TRIP FREQUANCY  
                                    <span class = "font-size-10 mb-1" >[ONLY FOR PERIODIC TRIP]</span></label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            CHOOSE ONE OR MORE
                                        </div>
                                        <div class = "col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_1" name = "trip_frequancy[]"
                                                    value = "1" checked>
                                                <label class="form-check-label" for="trip_frequancy_1">
                                                    Sunday
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_2" name = "trip_frequancy[]"
                                                     value = "2" >
                                                <label class="form-check-label" for="trip_frequancy_2">
                                                    Monday
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_3" name = "trip_frequancy[]"
                                                    value = "3">
                                                <label class="form-check-label" for="trip_frequancy_3">
                                                    Tuesday
                                                </label>
                                            </div>

                                        </div>
                                        <div class = "col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_4" name = "trip_frequancy[]"
                                                    value = "4">
                                                <label class="form-check-label" for="trip_frequancy_4">
                                                    Wenesday
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_5" name = "trip_frequancy[]"
                                                    value = "5">
                                                <label class="form-check-label" for="trip_frequancy_5">
                                                    Thursday
                                                </label>
                                            </div>
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_6" name = "trip_frequancy[]"
                                                    value = "6">
                                                <label class="form-check-label" for="trip_frequancy_6">
                                                    Friday
                                                </label>
                                            </div>
                                        </div>
                                        <div class = "col-md-4">
                                            <div class="form-check form-check-warning">
                                                <input class="form-check-input" type="checkbox" disabled id="trip_frequancy_7" name = "trip_frequancy[]"
                                                    value = "7">
                                                <label class="form-check-label" for="trip_frequancy_7">
                                                    Saturday
                                                </label>
                                            </div>                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> STATUS</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_1" value = "1" {{$trip_bus->status == 1 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_1">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="status_2" value = "0" {{$trip_bus->status == 0 ? 'checked' :''}}>
                                                <label class="form-check-label" for="status_2">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> TRIP TYPE </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                <input class="form-check-input" disabled id="trip_type1" type="radio" checked>
                                                <label class="form-check-label">
                                                    Periodic
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                <input class="form-check-input" disabled id="trip_type2" type="radio">
                                                <label class="form-check-label">
                                                    Non-Periodic
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> BUS SIZE </label>
                                    <select class="form-select" name="bus_size" id="bussize" required>
                                        <option value=''>Select Bus Size</option>
                                        @foreach($bus_size as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->bus_size == $row->id ? 'selected' :''}}>{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label><span class="custom-val-color">*</span> DRIVER NAME </label>
                                    <select class="form-select" name="driver_name" id="drivername" required>
                                        <option value=''>Select Driver Name</option>
                                        @foreach($driver as $row)
                                        <option value="{{$row->id}}" {{$trip_bus->driver_name == $row->id ? 'selected' :''}}>{{$row->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                

                                <div class = "mb-3 add-new-form">
                                    <label class="form-label"><span class="custom-val-color">*</span> SUPERVISOR NAME  
                                    </label>
                                    <div class = "row border rounded border-secondary daysofweek">
                                        <div class = "trip-frequency-check">
                                            CHOOSE ONE OR MORE
                                        </div>
                                        <div class = "col-md-12">
                                            @foreach($supervisor as $row)
                                                <div class="form-check form-check-warning">
                                                    <input class="form-check-input" type="checkbox" id="supervisor_{{$row->id}}" name = "supervisor[]"
                                                        value = "{{$row->id}}">
                                                    <label class="form-check-label" for="supervisor_{{$row->id}}">
                                                        {{$row->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-8" style="padding-top: 10vw;">
                    <img src="{{ URL::asset ('/images/admin/add-bus.png') }}" alt="" width="100%">
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
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/admin/tripBus/edit.js') }}"></script>
<script>

    function isNumeric(str) {
        if (typeof str != "string") return false // we only process strings!  
        return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
                !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
    }
    $(document).ready(function(){

        store = "{{route('admin.trip_bus.update', ['trip_bu' => $trip_bus->id])}}";
        list_url = "{{route('admin.trip_bus.index')}}";

        trip_url = "{{route('admin.trip_bus.tripname')}}";

        // $(".add-new-form").hide()
        $("#tripname").on('change', () => {
            console.log('eeee')
            let selectValue = $('#tripname').find(":selected").val();
            if (selectValue === "") {
                // $(".add-new-form").hide();
            } else {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'JSON',
                    url:trip_url,
                    data:{id:selectValue},
                    success:function(res){
                        if(res.result == "success" ){
                            let tripfreq = res.tripdata;
                            let arr = tripfreq;
                            arr = JSON.parse(arr["trip_frequancy"]);

                            let disableopt = res.disableopt == null ? [] : res.disableopt;

                            console.log(arr)
                            if (arr == "null") {
                                // $(".add-new-form").hide();
                            } else {
                                for (let i = 0; i < 8; i++) {
                                    $('input[id="trip_frequancy_' + i + '"]').prop('checked', false);
                                }
                                for (const element of disableopt) {
                                    let flag = isNumeric(element);
                                    if (flag) {
                                        console.log(element)
                                        $('input[id="trip_frequancy_' + element + '"]').prop( "checked", true );
                                    }
                                }
                            
                            
                                for (let i = 1; i < 8; i++) {
                                        if($('input[id="trip_frequancy_' + i + '"]').prop("checked") == false) {
                                            $('input[id="trip_frequancy_' + i + '"]').attr("disabled", true);
                                            $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                        } else {
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("disabled");
                                            $('input[id="trip_frequancy_' + i + '"]').removeAttr("readonly");
                                        }
                                }

                                document.getElementById('trip_type1').checked = tripfreq.trip_type == 1;
                                document.getElementById('trip_type2').checked = tripfreq.trip_type == 0;
                                if (tripfreq.trip_type == 0) {
                                    for (let i = 1; i < 8; i++) {
                                        $('input[id="trip_frequancy_' + i + '"]').prop('checked', false);
                                        $('input[id="trip_frequancy_' + i + '"]').attr("disabled", true);
                                        $('input[id="trip_frequancy_' + i + '"]').attr("readonly", true);
                                    }
                                }
                                // $(".add-new-form").hide();
                                // $(".add-new-form").slideToggle(500);
                            }
                        }
                        
                    }
                });
            }
        })

        $( "#tripname" ).trigger( "change" );


        $("#backbtn").on('click', () => {
            history.back();
        })

        $("#bussize").on('change', () => {
            let id = $("#bussize").val();
            tripbus_url = "{{ route('admin.tripbus.busno',':id') }}";
            tripbus_url = tripbus_url.replace(':id', id);
            if (id != "") {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'get',
                    dataType:'JSON',
                    url:tripbus_url,
                    success: function(res){
                        $("select[name='bus_no']").empty();
                        $("select[name='bus_no']").append("<option value=''>Select Bus NO.</option>")
                        let result = res.data;
                        for (let i = 0, mlength = result.length ; i < mlength; i++) {
                            $("select[name='bus_no']").append('<option value="' + result[i].id + '">'+result[i].bus_no + '</option>')
                        }
                    },
                    error: function(err) {
                        alert("Fixxing Server Error");
                    }
                });
            } else {
                $("select[name='bus_no']").empty();
                $("select[name='bus_no']").append("<option value=''>Select Bus NO.</option>")
            }                                                                                 
        });

        $("input[name=fake]").on('change', () => {
            if($("#fake_1").prop("checked")) {
                $('#busno').prop('disabled', 'disabled');
                $('#drivername').prop('disabled', 'disabled');
            } else {
                $('#busno').removeAttr('disabled');
                $('#drivername').removeAttr('disabled');
            }
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
        
    });
</script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBOuhG1Ht31r2SyrBD3Wa8riG7gZ5OfpPs",
        authDomain: "fluttersupervisor.firebaseapp.com",
        projectId: "fluttersupervisor",
        storageBucket: "fluttersupervisor.appspot.com",
        messagingSenderId: "906276400183",
        appId: "1:906276400183:web:cd50a9bf75ba167ca2a3b2",
        measurementId: "G-XHMGLHKYDW"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
            
            axios.post("{{ route('send.notification') }}",{
                _method:"PATCH",
                token
            }).then(({data})=>{
                console.log(data)
            }).catch(({response:{data}})=>{
                console.error(data)
            })

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{ route('send.notification') }}",
                data:{id: 1, },
                success: function(res){
                    let result = res.data;
                    for (let i = 0, mlength = result.length ; i < mlength; i++) {

                        $("select[name='bus_no']").append('<option value="' + result[i].id + '">'+result[i].bus_no + '</option>')
                    }
                },
                error: function(err) {
                    alert(err);
                }
            });

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();
  
    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
</script>

@endsection