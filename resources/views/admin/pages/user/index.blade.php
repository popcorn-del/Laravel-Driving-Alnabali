@extends('admin.layouts.master')
@section('title') List of Users @endsection
@section('page-title') List of Users @endsection
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
                            <a href="{{route('admin.user.create')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new"><i class="fas fa-plus"></i> ADD USER</a> 
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th >NO.</th>
                                    <th >Name</th>
                                    <th>Level</th>
                                    <th>Phone</th>
                                    <th>Username</th>                               
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td> <img src="{{$row->avatar == '' ? 'http://167.86.102.230/Alnabali/public/images/admin/user-profile.jpg' : 'http://167.86.102.230/Alnabali/public/uploads/user/' . $row->avatar }}" style="border-radius: 50%;margin-right: 1vw;" width="30" height="30" /> {{$row->name}}</td>
                                    <td>{{$row->role==1 ? "Admin" : "Editor"}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->user_name}}</td>
                                    <td>
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>    
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.user.show', ['user' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">View</button>
                                        <a href="{{route('admin.user.edit', ['user' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">Edit</button>
                                        <a href="javsciript::void(0)" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light reset-password" data-id="{{$row->id}}" data-src="{{route('admin.user.update', ['user' => $row->id])}}" data-bs-toggle="modal"
                                                data-bs-target="#myModal">Rest Password</button>
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
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">RESET PASSWORD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form class="custom-validation" action="" id="rest-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> NEW PASSWORD</label>
                                    <div>
                                        <input type="password" id="pass2" class="form-control" name="password" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> CONFIRM NEW PASSWORD</label>
                                    <div>
                                        <input type="password" class="form-control" required data-parsley-equalto="#pass2" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light save_button">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/user/index.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        status_url = "{{route('admin.user.status')}}"

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
                url:status_url,
                data:{status:status, id: id, is_set_status: true},
                success:function(res){
                    if(res.result == "success" ){
                        toastr["success"]("Success!!!");
                    }
                }
            })
        });
        $(document).ready(function() {

            if ( $.fn.dataTable.isDataTable( '#datatable' ) ) {
                table = $('#datatable').DataTable({
                    bDestroy: true,
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
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        },        
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4, 5 ]
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
                else {
                table = $('#datatable').DataTable( {
                    paging: false
                } );
                }
            makeExportBtn();
        });
    </script>
@endsection