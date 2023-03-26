<table id="datatable" class="table table-bordered nowrap w-100 datatable .table-fixed">
    <thead>
         <tr bgcolor="#E5E4E2">
            <th>{{__('no.')}}</th>
            <th>{{__('trip id')}}</th>
            <th>{{__('trip name')}}</th>
            <th>{{__('client')}}</th>
            <th>{{__('driver')}}</th>
            <th>{{__('bus no.')}}</th>
            <th>{{__('bus size')}}</th>
            <th>{{__('origin city')}}</th>
            <th>{{__('origin area')}}</th>
            <th>{{__('destination city')}}</th>
            <th>{{__('destination area')}}</th>
            <th>{{__('start date')}}</th>
            <th>{{__('end date')}}</th>
            <th>{{__('status')}}</th>
            <th>{{__('action')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daily_trip as $key=>$row)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$row->trip_id}}</td>
            <td>{{$row->trip_name}}</td>
            <td>{{$row->client_name}}</td>

            <td>{{$row->dirver_name}}</td>
            <td>{{$row->bus_no}}</td>
            <td>{{$row->bus_size_id}}</td>
            <td>{{$row->origin_city}}</td>
            <td>{{$row->origin_area}}</td>
            <td>{{$row->destination_city}}</td>
            <td>{{$row->destination_area}}</td>
            <td>{{date('d/m/Y',strtotime($row->start_date)) . " " . date('h:i A', strtotime($row->start_time))}}</td>
            <td>{{date('d/m/Y',strtotime($row->end_date)) . " " . date('h:i A', strtotime($row->end_time))}}</td>
            <td>
                @switch($row->status)
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
            <td class="text-center">
                <a href="{{route('admin.daily_trip.show', ['daily_trip' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-light">{{__('view')}}</a>
                <a href="{{route('admin.daily_trip.edit', ['daily_trip' => $row->id])}}"  class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('edit')}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
