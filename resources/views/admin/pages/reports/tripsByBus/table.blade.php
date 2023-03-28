<table id="datatable" class="table table-bordered dt-responsive  nowrap w-100 datatable .table-fixed">
    <thead>
         <tr bgcolor="#E5E4E2">
            <th>{{__("bus")}}</th>
            <th>{{__("pending")}}</th>
            <th>{{__("accepted")}}</th>
            <th>{{__("started")}}</th>
            <th>{{__("finished")}}</th>
            <th>{{__("canceled")}}</th>
            <th>{{__("total")}}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bus as $key=>$row)
        <tr>
            <td>{{$row[7]}}</td>
            <td>{{$row[1]}}</td>
            <td>{{$row[2]}}</td>
            <td>{{$row[4]}}</td>
            <td>{{$row[6]}}</td>
            <td>{{$row[5]}}</td>
            <td>{{$row[0]}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr bgcolor="#FFF5EE" id="tfooter">
            <th>TOTAL</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
        </tr>
    </tfoot>
</table>
