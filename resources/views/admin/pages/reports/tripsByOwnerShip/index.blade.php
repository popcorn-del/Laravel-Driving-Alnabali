@extends('admin.layouts.master')
@section('title') Trips Report By Ownership Type @endsection
@section('page-title') {{__('Trips Report By Ownership Type')}} @endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <!--Daily Trip List section -->

                <div class="card">
                    <div class="card-body">
                        <div class="table-filter">
                            <div class = "row mb-5">
                                <div class = "col-md-2">
                                    <label for="" style="float: left">{{__('ownership type')}}</label>
                                    <select class="form-select" name="client_filter" id="owner_filter">
                                        <option value="">All Ownership Types</option>
                                        <option value="Owned">Owned</option>
                                        <option value="Rented">Rented</option>
                                    </select>
                                </div>
                                {{-- <div class = "col-md-2">
                                    <label for="" style="float: left">START DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="startdate"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="first_trip_date" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class = "col-md-2">
                                    <label for="" style="float: left">END DATE</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="enddate"
                                            data-date-format="dd/mm/yyyy" data-date-container='#datepicker1'
                                            data-provide="datepicker" name="first_trip_date" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div> --}}


                            </div>


                        </div>
                        <div class="table-wrapper">
                           @include('admin.pages.reports.tripsByOwnerShip.table')
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

    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="{{ URL::asset('/assets/admin/dailyTrip/index.js') }}"></script>
    <script>
       url = "{{route('admin.daily.table')}}"
        var search_strings = new Array(3);
        search_strings.fill("");
        //  setStart date
        // $( "#startdate" ).on( "change", function() {
        //     $("#enddate").click();
        //     var setval = $(this).datepicker('getDate');
        //     $('#enddate').datepicker('setStartDate',setval);
        // });

        // //  setEnd date
        // $( "#enddate" ).on( "change", function() {
        //     $("#startdate").click();
        //     var setval = $(this).datepicker('getDate');
        //     $('#startdate').datepicker('setEndDate',setval);
        // });
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

            $( ".dataTables_filter" ).css("display","inline-block");
            $( ".btn-group" ).css("float","left");

            $( ".buttons-csv" ).css("padding","0");
            $( ".buttons-excel" ).css("padding","0");
            $( ".buttons-pdf" ).css("padding","0");
            $( ".buttons-print" ).css("padding","0");
        }
        $(document).ready(function () {
            $("#owner_filter").change(() => {
                search_strings[0] = $("#owner_filter").val();
                filterData();
            });
            function filterData() {
                $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                    for (var i = 0; i < search_strings.length; i++) {
                        if (search_strings[i] != '') {
                            if (i == 1 && new Date(data[1]) < new Date(search_strings[1])) {
                                return false;
                            } else if (i == 2 && new Date(data[2]) > new Date(search_strings[2])) {
                                return false;
                            } else if((i != 1 && i != 2) && data[i].toLowerCase() != search_strings[i].toLowerCase()) {
                                return false;
                            }
                        }
                    }
                    return true;
                })
                table = $('#datatable').DataTable({
                    bDestroy: true,
                    dom: 'Blfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],

                    footerCallback: function ( row, data, start, end, display ) {
                        var api = this.api();
                        api.columns('').every(function () {
                            var total = api
                                .column( this.index(), {search: 'applied'} )
                                .data()
                                .reduce(function (a, b) {
                                    return Number(a) + Number(b);
                                }, 0);
                            if(this.index()===0){
                                total="Total";
                            }
                            $(this.footer()).html(total);
                        });
                    }
                });
                makeExportBtn();
            }
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
                    bDestroy: true,
                    dom: 'Blfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    footerCallback: function ( row, data, start, end, display ) {
                        var api = this.api();
                        api.columns('').every(function () {
                            var total = api
                                .column( this.index(), {search: 'applied'} )
                                .data()
                                .reduce(function (a, b) {
                                    return Number(a) + Number(b);
                                }, 0);
                            if(this.index()===0){
                                total="Total";
                            }
                            $(this.footer()).html(total);
                        });
                    }
                });
                makeExportBtn();
            }
        })
    </script>
@endsection
