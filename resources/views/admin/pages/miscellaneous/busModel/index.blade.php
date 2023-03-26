@extends('admin.layouts.master')
@section('title') Bus Models @endsection
@section('page-title') {{__('bus models')}} @endsection

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
                                            <span class = "font-size-16" id="cityTitle"> ADD BUS MODEL</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> MODEL (EN)</label>
                                                <input type="text" class="form-control" id = "busModelEn" minlength="1" maxlength="100" name="model_en" required>
                                                <input type="hidden" name="id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> MODEL (AR)</label>
                                                <input type="text" class="form-control" name="model_ar" id = "busModelAr" minlength="1" maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> TYPE</label>
                                                <select class="form-select select-category" id = "busModelType" name="bus_type" required>
                                                    <option value="">Select Type</option>
                                                    @foreach($bus_type as $row)
                                                        <option value="{{$row->id}}">{{$row->type_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

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
                            <span class = "font-size-16 text-uppercase">{{__('list of bus models')}}</span>
                        </div>
                        <div class="table-filter">
                            <a href="javascript: void(0);" id = "busModelAdd" class="btn btn-outline-warning btn-rounded waves-effect waves-light
                                add-new  text-uppercase"><i class="fas fa-plus"></i> {{__('add bus model')}}</a>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('model')}}</th>
                                    <th>{{__('type')}}</th>
                                    <th class="text-center">{{__('status')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bus_model as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->model_en}}</td>
                                    <td>{{$row->type_en}}</td>
                                    <td class="text-center">
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit btn-view" data-id="{{$row->id}}" id="viewbtn">{{__('view')}}</button>
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit" id = "editBtn" data-id="{{$row->id}}">{{__('edit')}}</button>
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
    <script src="{{ URL::asset('/assets/admin/miscellaneous/busModel/index.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        store = "{{route('admin.miscellaneous.bus_model.store')}}";
        list_url = "{{route('admin.miscellaneous.bus_model.index')}}";
        status_url = "{{route('admin.miscellaneous.bus_model.status')}}";

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
            $("#busModelType").removeClass('parsley-error');
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
            $( ".btn-group" ).css("float","left");

            $( ".dataTables_filter" ).css("display","inline-block");

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
                    buttons: [
                        // 'csv', 'excel', 'pdf', 'print'
                        {
                            extend: 'csv',
                            exportOptions: {
                                orthogonal: 'csvoption',
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3 ]
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            targets: [3],
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
            $(".edit").on('click', function() {
                clearValidation();
                $("#cityTitle").text("EDIT BUS MODEL");
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("busModelEn").disabled = false;
                document.getElementById("busModelAr").disabled = false;
                document.getElementById("busModelType").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
            });

            $("#busModelAdd").on('click', function() {
                clearValidation();
                $("#cityTitle").text("ADD BUS MODEL");
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("busModelEn").disabled = false;
                document.getElementById("busModelAr").disabled = false;
                document.getElementById("busModelType").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                document.getElementById("busModelType").value = '0';

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
                document.getElementById('busModelType').value = '';
            });

            $(".btn-view").on('click', function() {
                clearValidation();
                $("#cityTitle").text("VIEW BUS MODEL");
                $(".save-btn").css("display", "none")
                $(".reset-btn").css("display", "none")
                document.getElementById("busModelEn").disabled = true;
                document.getElementById("busModelAr").disabled = true;
                document.getElementById("busModelType").disabled = true;
                document.getElementById("status_1").disabled = true;
                document.getElementById("status_2").disabled = true;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "none"; // depending on what you're doing
                }
            });
        });
    </script>
@endsection
