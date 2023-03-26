@extends('admin.layouts.master')
@section('title') Areas @endsection
@section('page-title') {{__('areas')}} @endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
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
                                <div class="col-md-11" style="padding-right: 60px;">
                                    <div class = "col-md-12">
                                        <div class="row">
                                            <div class = "mb-3">
                                                <span class = "font-size-16" id="cityTitle">ADD AREA</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label"><span class="custom-val-color span-validation">*</span> NAME (EN)</label>
                                                    <input type="text" minlength="1" maxlength="100" class="form-control" name="name_en" id = "areaNameEn" required>
                                                    <input type="hidden" name="id">
                                                </div>

                                            </div>
                                            <!-- <span class="custom-val-color">*</span>  -->
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label"><span class="custom-val-color span-validation">*</span> NAME (AR)</label>
                                                    <input type="text" class="form-control" minlength="1" maxlength="100" name="name_ar" id = "areaNameAr" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label"><span class="custom-val-color span-validation">*</span> CITY</label>
                                                    <select class="form-select select-category" id = "areacity" name="city" required>
                                                        <option value="">Select City</option>
                                                        @foreach($city as $row)
                                                            <option value="{{$row->id}}">{{$row->city_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-12">
                                        <div class = "row">
                                            <div class = "col-md-8">
                                                <div id="gmaps-markers" class="gmaps mb-3" style = "height:150px !important"></div>
                                            </div>
                                            <div class = "col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label"><span class="custom-val-color span-validation">*</span> LATITUDE</label>
                                                    <input type="text" class="form-control" pattern="^\d{1,3}(?:\.\d{1,6})?$" name="latitude" id="latitude" required>
                                                </div>
                                            </div>

                                            <div class = "col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label"><span class="custom-val-color span-validation">*</span> LONGITUDE</label>
                                                    <input type="text" class="form-control" name="longitude" pattern="^\d{1,3}(?:\.\d{1,6})?$" id="longitude" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-12">
                                        <div class = "row">
                                            <div class = "col-md-4">
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
                                </div>
                                <div style = "display: flex; align-items: flex-end;position: absolute;bottom: 30px;">
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
                            <span class = "font-size-16 text-uppercase">{{__('list of areas')}}</span>
                        </div>
                        <div class="table-filter">
                            <a href="javascript: void(0);" class="btn btn-outline-warning btn-rounded waves-effect
                                waves-light add-new citesAdd text-uppercase"><i class="fas fa-plus"></i> {{__('add area')}}</a>
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('name')}}</th>
                                    <th>{{__('city')}}</th>
                                    <th class="text-center">{{__('status')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($area as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->area_name_en}}</td>
                                    <td>{{$row->city_name_en}}</td>
                                    <td class="text-center">
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit citesView" data-id="{{$row->id}}">{{__('view')}}</button>
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light edit citesEdit" data-id="{{$row->id}}">{{__('edit')}}</button>
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

    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
    <script src="{{ URL::asset('/assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/gmaps.init.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>



    <script src="{{ URL::asset('/assets/admin/miscellaneous/area/index.js') }}"></script>
    <script>
        store = "{{route('admin.miscellaneous.area.store')}}";
        list_url = "{{route('admin.miscellaneous.area.index')}}";
        status_url = "{{route('admin.miscellaneous.area.status')}}";

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
            $(".form-select").removeClass('parsley-error');
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
            $(".citesEdit").on('click', function() {
                clearValidation();
                $("#cityTitle").text("EDIT AREA");
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("areaNameAr").disabled = false;
                document.getElementById("areaNameEn").disabled = false;
                document.getElementById("areacity").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                document.getElementById("latitude").disabled = false;
                document.getElementById("longitude").disabled = false;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
            });

            $(".citesAdd").on('click', function() {
                clearValidation();
                $("#cityTitle").text("ADD AREA");
                document.getElementById("areacity").value = '';
                $(".save-btn").css("display", "inline-block")
                $(".reset-btn").css("display", "inline-block")
                document.getElementById("areaNameAr").disabled = false;
                document.getElementById("areaNameEn").disabled = false;
                document.getElementById("areacity").disabled = false;
                document.getElementById("status_1").disabled = false;
                document.getElementById("status_2").disabled = false;

                document.getElementById("latitude").disabled = false;
                document.getElementById("longitude").disabled = false;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "contents"; // depending on what you're doing
                }
            });

            $(".citesView").on('click', function() {
                clearValidation();
                $("#cityTitle").text("VIEW AREA");
                $(".save-btn").css("display", "none")
                $(".reset-btn").css("display", "none")
                document.getElementById("areaNameAr").disabled = true;
                document.getElementById("areaNameEn").disabled = true;
                document.getElementById("areacity").disabled = true;
                document.getElementById("status_1").disabled = true;
                document.getElementById("status_2").disabled = true;

                document.getElementById("latitude").disabled = true;
                document.getElementById("longitude").disabled = true;

                var divsToHide = document.getElementsByClassName("span-validation"); //divsToHide is an array
                for(var i = 0; i < divsToHide.length; i++){
                    divsToHide[i].style.display = "none"; // depending on what you're doing
                }
            });

        });
    </script>
@endsection
