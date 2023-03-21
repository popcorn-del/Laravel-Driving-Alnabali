@extends('admin.layouts.master')
@section('title') Contract Types @endsection
@section('page-title') Contract Types @endsection
@section('css')
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <!-- add city section -->
                <div class="card add-new-form">
                    <div class="card-body">
                        <form id="custom-form" class="custom-validation" method= "POST" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class = "mb-3">
                                            <span class = "font-size-16" id="cityTitle"> ADD CONTRACT TYPE</span>   
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> TYPE (EN)</label>
                                                <input type="text" class="form-control" id = "contractTypeEn" minlength="1" maxlength="100" name="name_en" required>
                                                <input type="hidden" name="id">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> STATUS</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning mb-3">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="status_1" value="1" checked>
                                                            <label class="form-check-label" for="status_1">
                                                                Active
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="status_2" value="0">
                                                            <label class="form-check-label" for="status_2">
                                                                Inactive
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> TYPE (AR)</label>
                                                <input type="text" class="form-control" id = "contractTypeAr" minlength="1" maxlength="100" name="name_ar" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3" style = "display: flex; align-items: flex-end;">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light cancel-btn" style="margin-left: auto">Cancel</button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn" style="margin:0 .5vw">Reset</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light save-btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class = "mb-3">
                            <span class = "font-size-16">LIST OF CONTRACT TYPES</span>   
                        </div>
                        <div class="table-filter">
                            <a href="javascript: void(0);" id = "contractTypeAdd" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new">
                                <i class="fas fa-plus"></i> ADD CONTRACT TYPE</a> 
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th >NO.</th>
                                    <th >Type</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contract_type as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->type_name_en}}</td>
                                    <td class="text-center">
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit btn-view" data-id="{{$row->id}}" id="viewbtn">View</button>
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit contractTypeEdit" data-id="{{$row->id}}">Edit</button>
                                        <!-- <a href="javascript:void(0);" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light confirm_delete" data-id="1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a> -->
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
    <script src="{{ URL::asset('/assets/admin/miscellaneous/contractType/index.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        store = "{{route('admin.miscellaneous.contract_type.store')}}";
        list_url = "{{route('admin.miscellaneous.contract_type.index')}}";
        status_url = "{{route('admin.miscellaneous.contract_type.status')}}";

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
            makeExportBtn();
            // $(".edit").on('click', function() {
            //     $("#cityTitle").text("EDIT CONTRACT TYPE");
            // });

            $(".btn-view").on('click', function() {
                clearValidation();
                $("#cityTitle").text("VIEW CONTRACT TYPE");
                $(".save-btn").css("display", "none")
                $(".reset-btn").css("display", "none")
                document.getElementById("contractTypeEn").disabled = true;
                document.getElementById("contractTypeAr").disabled = true;
                document.getElementById("status_1").disabled = true;
                document.getElementById("status_2").disabled = true;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "none"; // depending on what you're doing
                }
            });

            $(".contractTypeEdit").on('click', function() {
                clearValidation();
                $("#cityTitle").text("EDIT CONTRACT TYPE");
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("contractTypeEn").disabled = false;
                document.getElementById("contractTypeAr").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
            });

            $("#contractTypeAdd").on('click', function() {
                clearValidation();
                $("#cityTitle").text("ADD CONTRACT TYPE");
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("contractTypeEn").disabled = false;
                document.getElementById("contractTypeAr").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
            });
            
        });
    </script>
@endsection
