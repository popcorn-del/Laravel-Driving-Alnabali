<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientType;
use App\Models\ContractType;
use DB, Validator, Exception, Image, URL;
use Carbon\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=app()->getLocale();
        $client = Client::leftJoin('client_types', 'clients.client_type_id', '=', 'client_types.id')
                        ->leftJoin('contract_types', 'clients.contract_type_id', '=', 'contract_types.id')
                        ->select('clients.*', 'client_types.type_name_en as client_type_name_en','client_types.type_name_ar as client_type_name_ar', 'contract_types.type_name_en as contract_type_name_en','contract_types.type_name_ar as contract_type_name_ar')
                        ->orderBy('clients.id', 'DESC')
                        ->get();
                        // return $client;
        return view('admin.pages.client.index', [
            'client' => $client,
            'lang' => $lang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client_type = ClientType::where('status', 1)->get();
        $contract_type = ContractType::where('status', 1)->get();
        return view('admin.pages.client.create', [
            'client_type' => $client_type,
            'contract_type' => $contract_type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * check the status validate.
         */
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'contract_type_id' => 'required',
            'contract_type_id' => 'required',
            // 'phone' => 'required|string|min:8|max:9',
        ]);
        $attributeNames = array(
            'status' => 'Status',
            'client_type_id' => 'Client Type',
            'contract_type_id' => 'Contract Type',
            // 'phone' => 'phone number which you input',
        );
        $validator->setAttributeNames($attributeNames);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        $mystartdate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $myenddate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        
        $old_client = Client::where('name_en',$request->name_en)
        ->where('name_ar',$request->name_ar)
        ->where('contract_start_date',$mystartdate)
        ->where('contract_end_date', $myenddate)
        ->get();
        
        if(count($old_client) > 0) return response()->json(['result' => 'error']); 
        /**
         * if id is not exist, then requst data will create.
         * if id is exist, then request data will update
         */
        if($request->id){
            $client = Client::findOrFail($request->id);
        } else {
            $client = new Client;
        }
        $fileName = "";
        if($request->client_avatar != null) {
            $request->validate([
                'client_avatar' => 'required|mimes:png,jpg|max:2048',
            ]);
            $fileName = time().'.'.$request->file('client_avatar')->extension();
            $request->file('client_avatar')->move(public_path('uploads/image/'), $fileName);
        } else {
            $fileName = "";
        }
        $client->name_en = $request->name_en;
        $client->name_ar = $request->name_ar;
        $client->client_avatar = $fileName;
        $client->client_type_id = $request->client_type_id;
        $client->contract_type_id = $request->contract_type_id;
        $client->address = $request->address;
        $client->phone_number = $request->phone;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->fax = $request->fax;

        $client->contract_start_date = $mystartdate;

        // $client->contract_end_date = $request->end_date;
        $client->contract_end_date = $myenddate;

        $client->liaison_name = $request->name_liaison;
        $client->liaison_phone = $request->phone_liaison;
        $client->record_number = $request->recorde_number;
        $client->status = $request->status;

        $client->save();
        return response()->json(['result' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $client_type = ClientType::where('status', 1)->get();
        $contract_type = ContractType::where('status', 1)->get();
        $client = Client::findOrFail($id);
        return view('admin.pages.client.show', [
            'client_type' => $client_type,
            'contract_type' => $contract_type,
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client_type = ClientType::where('status', 1)->get();
        $contract_type = ContractType::where('status', 1)->get();
        $client = Client::findOrFail($id);
        return view('admin.pages.client.edit', [
            'client_type' => $client_type,
            'contract_type' => $contract_type,
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::where('id', $id)->update(['status' => toBoolean($request->status)]);
        return response()->json(['result' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStartDate($id) {
        $client = Client::findOrFail($id);
        $start_date = $client->contract_start_date;
        $end_date = $client->contract_end_date;
        $res_flag = 'notsuccess';

        if ($start_date && $end_date) {
            $res_flag = 'success';
        }

        return response()->json(['result' => $res_flag, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function getAvatar($id) {
        $client = Client::findOrFail($id);
        $result = "http://213.136.71.7/alnabali/public/uploads/image/";
        $result .= $client->client_avatar;
        return response()->json(['result' => $result]);
    }
}
