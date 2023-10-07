@extends('admin.layouts.master')
@section('title') Bus Models @endsection
@section('page-title') {{__('bus models')}} @endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class = "mb-3">
                                            <span class = "font-size-16 text-uppercase" id="cityAdd"> {{__('Add Bus Model')}}</span>
                                            <span class = "font-size-16 text-uppercase" style="display:none" id="cityView"> {{__('View Bus Model')}}</span>
                                            <span class = "font-size-16 text-uppercase" style="display:none" id="cityEdit"> {{__('Edit Bus Model')}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> {{__('model (en)')}}</label>
                                                <input type="text" class="form-control" id = "busModelEn" minlength="1" maxlength="100" name="model_en" required>
                                                <input type="hidden" name="id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> {{__('model (ar)')}}</label>
                                                <input type="text" class="form-control" name="model_ar" id = "busModelAr" minlength="1" maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> {{__('type')}}</label><br>
                                                <div class="col-md-12">
                                                    <select class="form-select select-category bus_model_type" id = "busModelType" name="bus_type" required>
                                                        <option value="">Select Type</option>
                                                        @foreach($bus_type as $row)
                                                            <option value="{{$row->id}}">{{$row->type_en}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label"><span class="custom-val-color span-validation">*</span> {{__('status')}}</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning mb-3">
                                                            @if(Session::get('lang') != 'jor')
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="status_1" value="1" checked>
                                                            <label class="form-check-label text-capitalize" for="status_1">
                                                                {{__('active')}}
                                                            </label>
                                                            @else
                                                            <input class="form-check-input radioRight" type="radio" name="status"
                                                                id="status_1" value="1" checked>
                                                            <label class="form-check-label labelRight text-capitalize" for="status_1">
                                                                {{__('active')}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-warning">
                                                            @if(Session::get('lang') != 'jor')
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="status_2" value="0">
                                                            <label class="form-check-label text-capitalize" for="status_2">
                                                                {{__('inactive')}}
                                                            </label>
                                                            @else
                                                            <input class="form-check-input radioRight" type="radio" name="status"
                                                                id="status_2" value="0">
                                                            <label class="form-check-label text-capitalize" for="status_2">
                                                                {{__('inactive')}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style = "display: flex; align-items: flex-end;justify-content: flex-end;">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light cancel-btn">{{__('CANCEL')}}</button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light reset-btn">{{__('RESET')}}</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light save-btn">{{__('SAVE')}}</button>
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
                                add-new  text-uppercase"><i class="fas fa-plus"></i> {{__('Add Bus Model')}}</a>
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
                                    <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit btn-view" data-id="{{$row->id}}" id="viewbtn" onclick="view({{$row->id}})">{{__('view')}}</button>
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit" id = "editBtn" data-id="{{$row->id}}" onclick="edit({{$row->id}})">{{__('edit')}}</button>
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
    <script src="{{ URL::asset('/assets/js/pages/vfs_fonts_arabic.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        store = "{{route('admin.miscellaneous.bus_model.store')}}";
        list_url = "{{route('admin.miscellaneous.bus_model.index')}}";
        status_url = "{{route('admin.miscellaneous.bus_model.status')}}";
        $('.bus_model_type').select2();

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
                $("#cityView").css("display","none")
                $("#cityAdd").css("display","none")
                $("#cityEdit").css("display","block")
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
                $("#cityView").css("display","none")
                $("#cityAdd").css("display","block")
                $("#cityEdit").css("display","none")
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block");
                $("#busModelType").val('').trigger('change');

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
                $("#cityView").css("display","block")
                $("#cityAdd").css("display","none")
                $("#cityEdit").css("display","none")
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

        function edit(id)
        {
            $(".add-new-form").hide()
            $(".add-new-form").slideToggle(1000);
            initForm(id);
            clearValidation();
            $("#cityView").css("display","none")
            $("#cityAdd").css("display","none")
            $("#cityEdit").css("display","block")
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
        }

        function view(id){
            $(".add-new-form").hide()
            $(".add-new-form").slideToggle(1000);
            initForm(id);
            clearValidation();
            $("#cityView").css("display","block")
            $("#cityAdd").css("display","none")
            $("#cityEdit").css("display","none")
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
        }

        function initForm(id) {
            $.ajax({
                url: window.location.href + "/" + id,
                method: 'get',
                success: function (res) {
                    result = res.data;
                    if (result) {
                        $("input[name='id']").val(id)
                        $("input[name='model_en']").val(result.model_en)
                        $("input[name='model_ar']").val(result.model_ar)
                        if (result.status == 1) {
                            $("input[name='status'][value='1']").prop('checked', true);
                        } else {
                            $("input[name='status'][value='0']").prop('checked', true);
                        }
                        $(".bus_model_type").val(result.bus_type_id).trigger('change');
                        // $("select[name='bus_type']").val(result.bus_type_id);

                    }
                },
                error: function (res) {
                    console.log(res)
                },
                cache: false,
                contentType: false,
                processData: false
            })
        }
    </script>
@endsection
