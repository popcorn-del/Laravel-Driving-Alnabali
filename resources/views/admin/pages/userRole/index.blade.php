@extends('admin.layouts.master')
@section('title') Roles @endsection
@section('page-title') {{__('user roles')}} @endsection

@section('css')
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">                

                <div class="card">
                    <div class="card-body">
                        <div class = "mb-3">
                            <span class = "font-size-16 text-uppercase">{{__('list of user roles')}}</span>
                        </div>
                        <div class="table-filter">
                            <a href="{{route('admin.user_role.create')}}" class="btn btn-outline-warning btn-rounded waves-effect
                                waves-light add-new citesAdd text-uppercase"><i class="fas fa-plus"></i> {{__('Add Role')}}</a>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('name')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user_role as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$lang=='jor'?$row->name_ar:$row->name_en}}</td>
      
                                    <td class="text-center">
                                        <a href="{{route('admin.user_role.show', ['user_role' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit citesview" data-id="{{$row->id}}" >{{__('view')}}</a>
                                        <a href="{{route('admin.user_role.edit', ['user_role' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit editbtn" data-id="{{$row->id}}" >{{__('edit')}}</a>
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
 <!-- delete modal content -->

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('/assets/js/pages/vfs_fonts_arabic.js') }}"></script>
    <script>

        const clearValidation = () => {
            $(".parsley-errors-list").removeClass('filled');
            $(".form-control").removeClass('parsley-error');
        }

        $.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
        {
            return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
                return $('input', td).prop('checked') ? '0' : '1';
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

        $(document).ready(function() {
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
                    bDestroy: true,
                    dom: 'Blfrtip',
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
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2 ]
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            targets: [2],
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
                else {
                table = $('#datatable').DataTable( {
                    paging: false
                } );
                }
            makeExportBtn();
        });

    </script>
@endsection
