@extends('admin.layouts.master')
@section('title') List of Daily Trips @endsection
@section('page-title') {{__('list of daily trips')}} @endsection

@section('css')
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <!--Daily Trip List section -->

                <div class="card">
                    <div class="card-body">
                        <div class="table-filter" style="margin-bottom: 40px">
                            <div class = "row mb-3">
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('client')}}</label>
                                    </div>
                                    <select class="form-select" name="client_filter" id="client_filter">
                                        <option value="">{{__('All Clients')}}</option>
                                        @foreach($client as $key=>$row)
                                            <option value="{{$row->name_en}}">
                                                {{$lang=='jor'?$row->name_ar:$row->name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('origin city')}}</label>
                                    </div>
                                    <select class="form-select" name="origin_city_filter" id="origin_city_filter">
                                        <option value="">{{__('All Cities')}}</option>
                                        @foreach($city as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->city_name_en}}">
                                                {{$lang=='jor'?$row->city_name_ar:$row->city_name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('origin area')}}</label>
                                    </div>
                                    <select class="form-select" name="origin_area_filter" id="origin_area_filter">
                                        <option value="">{{__('All Areas')}}</option>
                                        @foreach($area as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->area_name_en}}">{{$row->area_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('destination city')}}</label>
                                    </div>
                                    <select class="form-select" name="destinations_city_filter" id="destinations_city_filter">
                                        <option value="">{{__('All Cities')}}</option>
                                        @foreach($city as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->city_name_en}}">
                                                    {{$lang=='jor'?$row->city_name_ar:$row->city_name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('destination area')}}</label>
                                    </div>
                                    <select class="form-select" name="destinations_area_filter" id="destinations_area_filter">
                                        <option value="">{{__('All Areas')}}</option>
                                        @foreach($area as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->area_name_en}}">
                                                {{$lang=='jor'?$row->area_name_ar:$row->area_name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col">
                                    <div style="text-align: left">
                                        <label for="">{{__('driver')}}</label>
                                    </div>
                                    <select class="form-select" name="driver_filter" id="driver_filter">
                                        <option value="">{{__('All Drivers')}}</option>
                                        @foreach($driver as $key=>$row)
                                            <option value="{{$row->name_en}}">
                                                {{$lang=='jor'?$row->name_ar:$row->name_en}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-2">
                                    <div style="text-align: left">
                                        <label for="">{{__('bus size')}}</label>
                                    </div>
                                    <select class="form-select" name="bus_sizes_filter" id="bus_sizes_filter">
                                        <option value="">{{__('All Bus Sizes')}}</option>
                                        @foreach($bus_size as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->size}}">{{$row->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col-2">
                                    <div style="text-align: left">
                                        <label for="">{{__('bus')}}</label>
                                    </div>
                                    <select class="form-select" name="bus_filter" id="bus_filter">
                                        <option value="">{{__('All Buses')}}</option>
                                        @foreach($bus as $key=>$row)
                                            <option data-id="{{$row->id}}" value="{{$row->bus_no}}">{{$row->bus_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class = "col-2">
                                    <div style="text-align: left">
                                        <label for="">{{__('status')}}</label>
                                    </div>
                                    <select class="form-select" name="status_filter" id="status_filter">
                                        <option value="">{{__('All Status')}}</option>
                                        <option value="Pending">{{__('Pending')}}</option>
                                        <option value="Accepted">{{__('Accepted')}}</option>
                                        <option value="Rejected">{{__('Rejected')}}</option>
                                        <option value="Started">{{__('Started')}}</option>
                                        <option value="Finished">{{__('Finished')}}</option>
                                        <option value="Canceled">{{__('Canceled')}}</option>
                                    </select>
                                </div>
                                <div class = "col-md-2">
                                    <div style="text-align: left">
                                        <label for="">{{__('start date')}}</label>
                                    </div>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="startdate"
                                            data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="first_trip_date" required value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y')}}">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class = "col-md-2">
                                    <div style="text-align: left">
                                        <label for="">{{__('end date')}}</label>
                                    </div>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" id="enddate"
                                            data-date-format="{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="first_trip_date" required value="{{date(Session::get('date') == 1 ? 'd/m/Y' : 'm/d/Y')}}">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.daily.task')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new"><i class="fas fa-plus"></i> ADD DAILY TRIP</a> --}}
                        </div>
                        <div class="table-wrapper">
                           @include('admin.pages.dailyTrip.table')
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/dailyTrip/index.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('/assets/js/pages/vfs_fonts_arabic.js') }}"></script>
    <script>
        url = "{{route('admin.daily.table')}}"
        var search_strings = new Array(14);
        search_strings.fill("");
        origin_area = $("#origin_area_filter");
        destination_area = $("#destinations_area_filter");

        let makeExportBtn = () => {
            $( ".buttons-csv" ).empty();
            $( ".buttons-csv" ).removeClass("btn-secondary");
            $("<img src='{{ URL::asset('/assets/images/btn_csv.png') }}' width='30px' height='38px'></img>").appendTo(".buttons-csv");

            $( ".buttons-excel" ).empty();
            $( ".buttons-excel" ).removeClass("btn-secondary");
            $("<img src='{{ URL::asset('/assets/images/btn_excel.png') }}' width='30px' height='38px'></img>").appendTo(".buttons-excel");

            $( ".buttons-pdf" ).empty();
            $( ".buttons-pdf" ).removeClass("btn-secondary");
            $("<img src='{{ URL::asset('/assets/images/btn_pdf.png') }}' width='30px' height='38px'></img>").appendTo(".buttons-pdf");

            $( ".buttons-print" ).empty();
            $( ".buttons-print" ).removeClass("btn-secondary");
            $("<img src='{{ URL::asset('/assets/images/btn_print.png') }}' width='30px' height='38px'></img>").appendTo(".buttons-print");

            $( ".btn-group" ).css("border","1px solid rgb(239 242 247)");
            $( ".btn-group" ).css("display","inline-block");

            $( ".btn-group" ).css("float","left");
            $( ".dataTables_filter" ).css("display","inline-block");

            $( ".buttons-csv" ).css("padding","0");
            $( ".buttons-excel" ).css("padding","0");
            $( ".buttons-pdf" ).css("padding","0");
            $( ".buttons-print" ).css("padding","0");
        }


        $(document).ready(function(){

            $("#bus_sizes_filter").on('change', function (e) {
                var id = $(this).find(':selected').data('id')
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
                            $("select[name='bus_filter']").empty();
                            $("select[name='bus_filter']").append("<option value=''>All Buses</option>")
                            let result = res.data;
                            for (let i = 0, mlength = result.length ; i < mlength; i++) {
                                $("select[name='bus_filter']").append('<option value="' + result[i].bus_no + '">'+result[i].bus_no + '</option>')
                            }
                        },
                        error: function(err) {
                            alert("Fixxing Server Error");
                        }
                    });
                } else {
                    $("select[name='bus_filter']").empty();
                    $("select[name='bus_filter']").append("<option value=''>All Buses</option>")
                }
            });
            // display area when click origin_city
            $("#origin_city_filter").on("change", function (e) {
                var id = $(this).find(':selected').data('id')
                if (id == "") {
                    origin_area.empty();
                    origin_area.append("<option value=''>All Areas</option>");
                }
                search_strings[8] = '';
                selectFunction(origin_area, id)
            })
            // display area when click destination_area
            $("#destinations_city_filter").on("change", function (e) {
                var id = $(this).find(':selected').data('id')
                if (id == "") {
                    origin_area.empty();
                    origin_area.append("<option value=''>All Areas</option>");
                }
                search_strings[10] = '';
                selectFunction(destination_area, id)
            })

            function selectFunction(select, id){
                show_url = "{{route('admin.trip.area', ':trip')}}";
                show_url = show_url.replace(':trip', id);
                $.ajax({
                    url: show_url,
                    method: 'get',
                    success: function (res) {
                        result = res.data;
                        if(result){
                            select.empty();
                            select.append("<option value=''>All Areas</option>");
                            for(i=0; i<result.length; i++ ){
                                select.append('<option value="'+result[i].area_name_en+'">'+result[i].area_name_en+'</option>');
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
            }
            $("#client_filter").change(() => {
                search_strings[3] = $("#client_filter").val();
                filterData();
            });
            $("#origin_city_filter").change(() => {
                search_strings[7] = $("#origin_city_filter").val();
                filterData();
            });
            $("#origin_area_filter").change(() => {
                search_strings[8] = $("#origin_area_filter").val();
                filterData();
            });
            $("#destinations_city_filter").change(() => {
                search_strings[9] = $("#destinations_city_filter").val();
                filterData();
            });
            $("#destinations_area_filter").change(() => {
                search_strings[10] = $("#destinations_area_filter").val();
                filterData();
            });
            $("#driver_filter").change(() => {
                search_strings[4] = $("#driver_filter").val();
                filterData();
            });
            $("#bus_sizes_filter").change(() => {
                search_strings[6] = $("#bus_sizes_filter").val();
                filterData();
            });
            $("#bus_filter").change(() => {
                search_strings[5] = $("#bus_filter").val();
                filterData();
            });
            $("#status_filter").change(() => {
                search_strings[13] = $("#status_filter").val();
                filterData();
            });

            $("#startdate").change(() => {
                search_strings[11] = $("#startdate").val();
                filterData();
            })
            $("#enddate").change(() => {
                search_strings[12] = $("#enddate").val();
                filterData();
            })
            function filterData() {
                $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                    for (var i = 0; i < search_strings.length; i++) {
                        if (search_strings[i] != '') {
                            if (i == 11 && new Date(data[11]) < new Date(search_strings[11])) {
                                return false;
                            } else if (i == 12 && new Date(data[12]) > new Date(search_strings[12])) {
                                return false;
                            } else if((i != 11 && i != 12) && data[i].toLowerCase() != search_strings[i].toLowerCase()) {
                                return false;
                            }
                        }
                    }
                    return true;
                })
                table = $('#datatable').DataTable({
                    bDestroy: true,
                    dom: 'Blfrtip',
                    scrollX: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    "oLanguage": {
                        "sSearch": $("#arc_search").val() + " ",
                        "sLengthMenu": $('#arc_show').val() + " _MENU_ " + $('#arc_entries').val(),
                        "sInfo": $("#arc_showing").val() + " _START_ " + $('#arc_to').val() + " _END_ " + $('#arc_of').val() +" _TOTAL_ " + $('#arc_entries').val(),
                        "sInfoEmpty": $('#arc_norecord').val(),
                        "sInfoFiltered": "(" + $('#arc_filterfrom').val() + " _MAX_ " + $('#arc_totalrecord').val() + ")",
                        "sZeroRecords": $('#arc_nodata').val(),
                        "oPaginate": {
                            "sNext": $('#arc_next').val(),
                            "sPrevious": $('#arc_previous').val()
                        }
                    },
                    buttons: [
                        // 'csv', 'excel', 'pdf', 'print'
                        {
                            extend: 'csv',
                            exportOptions: {
                                orthogonal: 'csvoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            },
                            customize : function(doc) {
                                doc.styles['td:nth-child(2)'] = {
                                   width: '10px',
                                   'max-width': '100px'
                                }
                            }
                        },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            },

                        }
                    ],
                    columnDefs: [
                        {
                            targets: [6],
                            orderDataType: 'dom-checkbox',
                            render: function(data, type, row, meta){
                                if(type === 'printoption'){
                                    var api = new $.fn.dataTable.Api( meta.settings );
                                    var $input = $(api.cell({ row: meta.row, column: meta.col }).node()).find('input');
                                    data = $input.prop('checked') ? 'Active' : 'Inactive';
                                }

                                return data;
                            }
                        }
                    ],
                });
                makeExportBtn();
            }
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
	                bDestroy: true,
                    dom: 'Blfrtip',
                    scrollX: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    "oLanguage": {
                        "sSearch": $("#arc_search").val() + " ",
                        "sLengthMenu": $('#arc_show').val() + " _MENU_ " + $('#arc_entries').val(),
                        "sInfo": $("#arc_showing").val() + " _START_" + $('#arc_to').val() + " _END_ " + $('#arc_of').val() +" _TOTAL_ " + $('#arc_entries').val(),
                        "sInfoEmpty": $('#arc_norecord').val(),
                        "sInfoFiltered": "(" + $('#arc_filterfrom').val() + " _MAX_ " + $('#arc_totalrecord').val() + ")",
                        "sZeroRecords": $('#arc_nodata').val(),
                        "oPaginate": {
                            "sNext": $('#arc_next').val(),
                            "sPrevious": $('#arc_previous').val()
                        }
                    },
                    buttons: [
                        // 'csv', 'excel', 'pdf', 'print'
                        {
                            extend: 'csv',
                            exportOptions: {
                                orthogonal: 'csvoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'landscape',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            },
                            customize : function(doc) {
                                doc.styles['td:nth-child(2)'] = {
                                   width: '10px',
                                   'max-width': '100px'
                                }
                            }
                        },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            targets: [6],
                            orderDataType: 'dom-checkbox',
                            render: function(data, type, row, meta){
                                if(type === 'printoption'){
                                    var api = new $.fn.dataTable.Api( meta.settings );
                                    var $input = $(api.cell({ row: meta.row, column: meta.col }).node()).find('input');
                                    data = $input.prop('checked') ? 'Active' : 'Inactive';
                                }

                                return data;
                            }
                        }
                    ],
                });
            } else {
                table = $('#datatable').DataTable( {
                    paging: false
                });
            }

            $('#startdate').datepicker({
                format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
            });
            $( "#startdate" ).on( "change", function() {
                $("#enddate").click();
                $('this').datepicker('setDate', setval);
                var setval = $(this).datepicker('getDate');
                $('#enddate').datepicker('setStartDate',setval);
            });

            //  setEnd date
            $('#enddate').datepicker({
                format: "{{Session::get('date') == 1 ? 'dd/mm/yyyy' : 'mm/dd/yyyy'}}"
            });
            $( "#enddate" ).on( "change", function() {
                $("#startdate").click();
                $('this').datepicker('setDate', setval);
                var setval = $(this).datepicker('getDate');
                $('#startdate').datepicker('setEndDate',setval);
            });



            makeExportBtn();
        })

    </script>
@endsection
