@extends('admin.layouts.master')
@section('title') List of Buses @endsection
@section('page-title') {{__('list of buses')}} @endsection
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
                            <a href="{{route('admin.bus.create')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new text-uppercase"><i class="fas fa-plus"></i> {{__('add bus')}}</a>
                        </div>
                        <table id="datatable" class="table table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('type')}}</th>
                                    <th>{{__('model')}}</th>
                                    <th>{{__('year')}}</th>
                                    <th>{{__('bus no.')}}</th>
                                    <th>{{__('bus size')}}</th>
                                    <th>{{__('ownership')}}</th>
                                    <th class="text-center">{{__('status')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bus as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$lang=='jor'?$row->type_ar:$row->type_en}}</td>
                                    <td>{{$lang=='jor'?$row->model_ar:$row->model_en}}</td>
                                    <td>{{$row->model_year}}</td>
                                    <td>{{$row->bus_no}}</td>
                                    <td>{{$row->size}}</td>
                                    <td>
                                        @if($row->owner_ship == 1)
                                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Owned')}}</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-warning font-size-12">{{__('Rented')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{-- <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">VIEW</button> --}}
                                        <a href="{{route('admin.bus.show', ['bu' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('view')}}</button>
                                        <a href="{{route('admin.bus.edit', ['bu' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('edit')}}</button>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('/assets/js/pages/vfs_fonts_arabic.js') }}"></script>
    <script>

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
            $( ".btn-group" ).css("float","left");

            $( ".dataTables_filter" ).css("display","inline-block");

            $( ".buttons-csv" ).css("padding","0");
            $( ".buttons-excel" ).css("padding","0");
            $( ".buttons-pdf" ).css("padding","0");
            $( ".buttons-print" ).css("padding","0");
    }

    $(document).on('change','.price-status',function(){
        var status= $(this).prop('checked');
        var id=$(this).val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'PUT',
            dataType:'JSON',
            url:"{{route('admin.bus.status')}}",
            data:{status:status, id: id, is_set_status: true},
            success:function(res){
                if(res.result == "success" ){
                    toastr["success"]("Success!!!");
                }
            }
        })
    });
       $(document).ready(function(){
            $(".reset-btn").click(function(){
                $("#custom-form").trigger("reset");
            });
            $("#custom-form").hide()
            $(".add-new").click(function(){
                $("#custom-form").slideUp(1000);
            });
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {

                table = $('#datatable').DataTable({
	                bDestroy: true,
                    scrollX: true,
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
                            targets: [7],
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
