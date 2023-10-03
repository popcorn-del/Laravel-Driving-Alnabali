<table id="datatable" class="table table-bordered nowrap w-100 datatable .table-fixed">
    <thead>
         <tr bgcolor="#E5E4E2">
            <th>{{__('no.')}}</th>
            <th>{{__('trip id')}}</th>
            <th>{{__('trip name')}}</th>
            <th>{{__('client')}}</th>
            <th>{{__('origin city')}}</th>
            <th>{{__('origin area')}}</th>
            <th>{{__('destination city')}}</th>
            <th>{{__('destination area')}}</th>
            <th>{{__('driver')}}</th>
            <th>{{__('transaction date')}}</th>
            <th>{{__('old status')}}</th>
            <th>{{__('new status')}}</th>
            <th>{{__('action')}}</th>
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
                <td dir="ltr">{{date(Session::get('date') == 1 ? 'd/m/Y h:i A' : 'm/d/Y h:i A', strtotime($row->created_at))}}</td>
                <td>
                    @switch($row->old_status)
                        @case(100)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('N/A')}}</span>
                            @break
                        @case(1)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Pending')}}</span>
                            @break
                        @case(2)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Accepted')}}</span>
                            @break
                        @case(3)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Rejected')}}</span>
                            @break
                        @case(4)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Started')}}</span>
                            @break
                        @case(5)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Canceled')}}</span>
                            @break
                        @case(6)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Finished')}}</span>
                            @break
                        @case(7)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Fake')}}</span>
                            @break
                        @default
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Pending')}}</span>
                    @endswitch
                </td>
                <td>
                    @switch($row->new_status)
                    @case(100)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('N/A')}}</span>
                            @break
                        @case(1)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Pending')}}</span>
                            @break
                        @case(2)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Accepted')}}</span>
                            @break
                        @case(3)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Rejected')}}</span>
                            @break
                        @case(4)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Started')}}</span>
                            @break
                        @case(5)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Canceled')}}</span>
                            @break
                        @case(6)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Finished')}}</span>
                            @break
                        @case(7)
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Fake')}}</span>
                            @break
                        @default
                            <span class="badge badge-pill badge-soft-success font-size-12">{{__('Pending')}}</span>
                    @endswitch
                </td>
                <td><a href="{{route('admin.transaction.show', ['transaction' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('view')}}</a></td>

            </tr>
        @endforeach
    </tbody>
</table>

<!-- <td><a href="#" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">Pending</a></td>
            <td><a href="#" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">Accepted</a></td> -->
