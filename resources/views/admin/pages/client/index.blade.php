@extends('admin.layouts.master')
@section('title') List of Client @endsection
@section('page-title') List of Clients @endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
<style>
.buttons-print {
  background-color: red;
  color: white;
  background-image: url({{ URL::asset('/assets/images/profile-img.png') }});
}
</style>
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-filter">
                            <a href="{{route('admin.client.create')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> ADD CLIENT</a>
                        </div>
                        <table id="datatable" class="table table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('name')}}</th>
                                    <th>{{__("type")}}</th>
                                    <th>{{__('contract type')}}</th>
                                    <th>{{__('start date')}}</th>
                                    <th>{{__('end date')}}</th>
                                    <th class="text-center">{{__('status')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($client as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td> <img src="{{$row->client_avatar == '' ? 'http://167.86.102.230/Alnabali/public/images/admin/client_default.png' : 'http://167.86.102.230/Alnabali/public/uploads/image/' . $row->client_avatar }}" style="border-radius: 50%;margin-right: 1vw;" width="30" height="30" /> {{$row->name_en}}</td>
                                    <td>{{$row->client_type_name_en}}</td>
                                    <td>{{$row->contract_type_name_en}}</td>
                                    <td>{{date("d/m/Y", strtotime($row->contract_start_date))}}</td>
                                    <td>{{date("d/m/Y", strtotime($row->contract_end_date))}}</td>
                                    <td class="text-center">
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{-- <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">View</button> --}}
                                        <a href="{{route('admin.client.show', ['client' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__("view")}}</button>
                                        <a href="{{route('admin.client.edit', ['client' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__("edit")}}</button>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.3.3/js/dataTables.colReorder.min.js"></script> -->


    <!-- <script src="cdn.datatables.net/plug-ins/1.12.1/sorting/custom-data-source/dom-checkbox.js"></script> -->

    <script>

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
            url:"{{route('admin.client.index')}}" + "/" + id,
            data:{status:status},
            success:function(res){
                if(res.result == "success" ){
                    toastr["success"]("Success!!!");
                }
            }
        })
    });
    $(document).ready(function(){
            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
	                bDestroy: true,
                    scrollX: true,
                    dom: 'Blfrtip',
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
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
                    ]
                });
            } else {
                table = $('#datatable').DataTable( {
                    paging: false
                });
            }

            // $("#datatable_length").css('float', 'left');$("#datatable_length").css('margin-top', '-2.2vw');
            makeExportBtn();
        });
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


            $( ".buttons-csv" ).css("padding","0");
            $( ".buttons-excel" ).css("padding","0");
            $( ".buttons-pdf" ).css("padding","0");
            $( ".buttons-print" ).css("padding","0");
        }
    </script>
@endsection
