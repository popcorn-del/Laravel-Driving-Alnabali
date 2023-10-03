@extends('admin.layouts.master')
@section('title') List of App Supervisors @endsection
@section('page-title') {{__('list of app supervisors')}} @endsection
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
                            <a href="{{route('admin.super_visor.create')}}" class="btn btn-outline-warning btn-rounded waves-effect waves-light add-new"><i class="fas fa-plus"></i> {{__('ADD APP SUPERVISOR')}}</a>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable">
                            <thead>
                                <tr bgcolor="#E5E4E2">
                                    <th>{{__('no.')}}</th>
                                    <th>{{__('name')}}</th>
                                    <th>{{__('phone')}}</th>
                                    <th>{{__('username')}}</th>
                                    <th class="text-center">{{__('status')}}</th>
                                    <th class="text-center">{{__('action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supervisor as $key=>$row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td> <img src="{{$row->profile_image == '' ? 'http://213.136.71.7/alnabali/public/images/admin/user-profile.jpg' : 'http://213.136.71.7/alnabali/public/uploads/supervisor/' . $row->profile_image }}" style="border-radius: 50%;margin-right: 1vw;" width="30" height="30" /> {{$row->name}}</td>
                                    <td>{{is_null($row->phone) ? 'N/A' : '+962 '.$row->phone}}</td>
                                    <td>{{$row->user_name}}</td>
                                    <td>
                                        <div style="display:none;">{{$row->status == 1 ? "Active" :"Inactive"}}</div>
                                        <div class="form-check form-switch form-switch-lg text-center">
                                            <input class="form-check-input price-status mx-auto" type="checkbox" {{$row->status == 1 ? "checked" :""}} value="{{$row->id}}" >
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <!-- <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">VIEW</button> -->
                                        <a href="{{route('admin.super_visor.show', ['super_visor' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('view')}}</button>
                                        <a href="{{route('admin.super_visor.edit', ['super_visor' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('edit')}}</button>
                                        <a href="javsciript::void(0)" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light reset-password" data-id="{{$row->id}}" data-src="{{route('admin.super_visor.update', ['super_visor' => $row->id])}}" data-bs-toggle="modal"
                                                data-bs-target="#myModal">{{__('reset password')}}</button>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">{{__('reset password')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="margin: 0rem 0rem 0rem 0rem;"
                        aria-label="Close"></button>
                </div>
                <form class="custom-validation" action="" id="rest-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('password')}}</label>
                                    <div>
                                        <input type="password" id="pass2" class="form-control" name="password" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><span class="custom-val-color">*</span> {{__('confirm password')}}</label>
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
                            data-bs-dismiss="modal">{{__('CANCEL')}}</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light save_button">{{__('SAVE')}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin/supervisor/index.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('/assets/js/pages/vfs_fonts_arabic.js') }}"></script>
    <script>
        status_url = "{{route('admin.super_visor.status')}}"

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
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                orthogonal: 'exceloption',
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                orthogonal: 'pdfoption',
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                orthogonal: 'printoption',
                                columns: [ 0, 1, 2, 3, 4 ]
                            }
                        }
                    ],
                });
            }
            makeExportBtn();
        });
    </script>
@endsection
