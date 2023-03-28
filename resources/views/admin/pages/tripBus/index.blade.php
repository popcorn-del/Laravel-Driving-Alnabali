@extends('admin.layouts.master')
@section('title') List of Trips' Buses @endsection
@section('page-title') {{__("list of trip's buses")}} @endsection

@section('css')
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <!--Bus List section -->

                <div class="card">
                    <div class="card-body">
                        <div class="table-filter">
                            <a href="{{route('admin.trip_bus.create')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new text-uppercase"><i class="fas fa-plus"></i> {{__("add trip's bus")}}</a>
                        </div>
                        <table id="datatable" class="table table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('trip id')}}</th>
                                    <th>{{__('trip name')}}</th>
                                    <th>{{__('bus no.')}}</th>
                                    <th>{{__('bus size')}}</th>
                                    <th>{{__('driver')}}</th>
                                    <th>{{__('supervisor')}}</th>
                                    <th>{{__('is fake')}}</th>
                                    <th>{{__('days')}}</th>
                                    <th>{{__('status')}}</th>
                                    <th>{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($trip_bus as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->trip_id}}</td>
                                    <td>{{$row->trip_name_en}}</td>
                                    <td>{{$row->bus_no}}</td>
                                    <td>{{$row->size}}</td>
                                    <td>{{$row->name_en}}</td>
                                    <td>{{$row->supervisor}}</td>
                                    <td>{{$row->fake == 1 ? "yes" : "no"}}</td>
                                    <td>N/A</td>
                                    <td>
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    {{-- <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">VIEW</button> --}}
                                    <a href="{{route('admin.trip_bus.show', ['trip_bu' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('view')}}</button>
                                        <a href="{{route('admin.trip_bus.edit', ['trip_bu' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('edit')}}</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        status_url = "{{route('admin.trip_bus.status')}}"
    </script>
    <script>
        $(document).ready(function(){
            $(".reset-btn").click(function(){
                $("#custom-form").trigger("reset");
            });
            // $("#custom-form").hide()
            $(".add-new").click(function(){
                $("#custom-form").slideUp(1000);
            });
            $(".price-status").change(function(){
                var status= $(this).prop('checked');
                var id=$(this).val();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    dataType:'JSON',
                    url:status_url,
                    data:{status:status, id:id},
                    success:function(res){
                        if(res.result == "success" ){
                            toastr["success"]("Success!!!");
                        }
                    }
                })
            })
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
                    bDestroy: true,
                    dom: 'Blfrtip',
                    scrollX: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    buttons: [
                        // 'csv', 'excel', 'pdf', 'print'
                        {
                            extend: 'csv',
                            exportOptions: {
                                orthogonal: 'csvoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            targets: [5],
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
                    ]
                });
            }
            makeExportBtn();
        });
        $.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
        {
            return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
                return $('input', td).prop('checked') ? '1' : '0';
            });
        }

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

    </script>
@endsection
