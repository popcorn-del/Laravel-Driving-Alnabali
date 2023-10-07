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
            <th>{{__('status')}}</th>
            <th>{{__('notification message')}}</th>
            <th>{{__('notification date')}}</th>
            <th>{{__("notified app")}}</th>
            <th>{{__("notified person")}}</th>
            <th>{{__("notification status")}}</th>
            <th>{{__('action')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notification as $key=>$row)
        <tr>
            <td >{{$key+1}}</td>
            <td >{{$row->disp_trip_id}}</td>
            <td >{{$row->trip_name}}</td>
            <td>{{$row->client_name}}</td>
            <td>{{$row->origin_city}}</td>
            <td>{{$row->origin_area}}</td>
            <td>{{$row->destination_city}}</td>
            <td>{{$row->destination_area}}</td>
            <td>
                @switch($row->status)
                    @case(1)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('pending')}}</span>
                        @break
                    @case(2)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('accepted')}}</span>
                        @break
                    @case(3)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('rejected')}}</span>
                        @break
                    @case(4)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('started')}}</span>
                        @break
                    @case(5)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('canceled')}}</span>
                        @break
                    @case(6)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('finished')}}</span>
                        @break
                    @case(7)
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('fake')}}</span>
                        @break
                    @default
                        <span class="badge badge-pill badge-soft-success font-size-12">{{__('pending')}}</span>
                @endswitch
            </td>
            <td>{{$row->message}}</td>
            <td dir="ltr">{{date(Session::get('date') == 1 ? 'd/m/Y h:i A' : 'm/d/Y h:i A', strtotime($row->created_at))}}</td>
            <td class="text-capitalize">                
                <span class="badge badge-pill badge-soft-success font-size-12">    
                    @if($row->receive_app == 0) {{__('supervisor')}} @endif @if($row->receive_app == 1) {{__('driver')}} @endif            
                </span></td>
            <td>{{$row->receiver}}</td>
            <td>
                <span class="badge badge-pill badge-soft-success font-size-12">    
                <!-- {{$row->received_by == "sent" ? "Sent" : $row->received_by}} -->
                @switch($row->received_by)
                    @case('Sent')
                        <option value="">{{__('Sent')}}</option>
                        @break
                    @case('Received')
                        <option value="">{{__('Received')}}</option>
                        @break
                    @case('Not Received')
                        <option value="">{{__('Not Received')}}</option>
                        @break
                    @default
                        <option value="">{{__('Received')}}</option>
                @endswitch
            </span></td>
            <td><a href="{{route('admin.notification.show', ['notification' => $row->id])}}" class="btn btn-outline-warning btn-sm btn-rounded waves-effect waves-lightt">{{__('view')}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
