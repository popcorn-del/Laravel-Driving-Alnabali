<table id="datatable" class="table table-bordered nowrap w-100 datatable .table-fixed">
    <thead>
         <tr bgcolor="#E5E4E2">
            <th>NO.</th>
            <th>TRIP ID</th>
            <th>TRIP NAME</th>
            <th>CLIENT</th>
            <th>ORIGIN CITY</th>
            <th>ORIGIN AREA</th>
            <th>DESTINATION CITY</th>
            <th>DESTINATION AREA</th>
            <th>DRIVER</th>
            <th>transaction date</th>
            <th>old status</th>
            <th>NEW STATUS</th>
            <th>ACTION</th>                                                         
        </tr>
    </thead>
    <tbody>
        @foreach($transaction as $key=>$row)
            <tr>
                <td >{{$key+1}}</td>
                <td >{{$row->disp_trip_id}}</td>
                <td >{{$row->trip_name}}</td>
                <td>{{$row->client_name}}</td>
                <td>{{$row->origin_city}}</td>
                <td>{{$row->origin_area}}</td>
                <td>{{$row->destination_city}}</td>
                <td>{{$row->destination_area}}</td>
                <td>{{$row->driver_name}}</td>
                <td>{{date("d/m/Y h:i A", strtotime($row->created_at))}}</td>
                <td>
                    @switch($row->old_status)
                        @case(100)
                            <span class="badge badge-pill badge-soft-success font-size-12">N/A</span>
                            @break
                        @case(1)
                            <span class="badge badge-pill badge-soft-success font-size-12">Pending</span>
                            @break
                        @case(2)
                            <span class="badge badge-pill badge-soft-success font-size-12">Accepted</span>
                            @break
                        @case(3)
                            <span class="badge badge-pill badge-soft-success font-size-12">Rejected</span>
                            @break
                        @case(4)
                            <span class="badge badge-pill badge-soft-success font-size-12">Started</span>
                            @break
                        @case(5)
                            <span class="badge badge-pill badge-soft-success font-size-12">Canceled</span>
                            @break
                        @case(6)
                            <span class="badge badge-pill badge-soft-success font-size-12">Finished</span>
                            @break
                        @case(7)
                            <span class="badge badge-pill badge-soft-success font-size-12">Fake</span>
                            @break
                        @default
                            <span class="badge badge-pill badge-soft-success font-size-12">Pending</span>
                    @endswitch
                </td>
                <td>
                    @switch($row->new_status)
                        @case(100)
                            <span class="badge badge-pill badge-soft-success font-size-12">N/A</span>
                            @break
                        @case(1)
                            <span class="badge badge-pill badge-soft-success font-size-12">Pending</span>
                            @break
                        @case(2)
                            <span class="badge badge-pill badge-soft-success font-size-12">Accepted</span>
                            @break
                        @case(3)
                            <span class="badge badge-pill badge-soft-success font-size-12">Rejected</span>
                            @break
                        @case(4)
                            <span class="badge badge-pill badge-soft-success font-size-12">Started</span>
                            @break
                        @case(5)
                            <span class="badge badge-pill badge-soft-success font-size-12">Canceled</span>
                            @break
                        @case(6)
                            <span class="badge badge-pill badge-soft-success font-size-12">Finished</span>
                            @break
                        @case(7)
                            <span class="badge badge-pill badge-soft-success font-size-12">Fake</span>
                            @break
                        @default
                            <span class="badge badge-pill badge-soft-success font-size-12">Pending</span>
                    @endswitch
                </td>
                <td><a href="{{route('admin.transaction.show', ['transaction' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">View</a></td>
                
            </tr>
        @endforeach
    </tbody>
</table>

<!-- <td><a href="#" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">Pending</a></td>
            <td><a href="#" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">Accepted</a></td> -->