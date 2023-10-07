<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Validator;
use App\Models\UserRole;
use App\Models\Permission;
use App\Models\RolePermission;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang=app()->getLocale();
        $user_role = UserRole::where('is_visible', 1)->orderBy('id', 'desc')->get();
        return view('admin.pages.userRole.index', [
            'user_role' => $user_role,
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
        $lang=app()->getLocale();
        $permissions = Permission::all();
        return view('admin.pages.userRole.create', [
            'lang' => $lang,
            'permissions' => $permissions
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

        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $role;
        if($request->id) {
            $role = UserRole::findOrFail($request->id);
            $role->permissions()->detach();
        } else {
            $role = new UserRole;
        }

        $role->name_en = $request->name_en;
        $role->name_ar = $request->name_ar;
        $role->save();

        $permissions = $request->permission;
        $role->permissions()->attach($permissions);
        return response()->json(['result' => "success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang=app()->getLocale();
        $permissions = Permission::all();
        $role_p = RolePermission::where('role_id', $id)->select('permission_id')->get();
        
        $user_role = UserRole::findOrFail($id);

        $role_permissions = [];
        foreach ($role_p as $key => $row) {
            $role_permissions[] = $row->permission_id;
        }

        return view('admin.pages.userRole.show', [
            'lang' => $lang,
            'permissions' => $permissions,
            'user_role' => $user_role,
            'role_permissions' => $role_permissions
        ]);


        //role manage
        $permissions = Permission::all();
        $role_id  = Auth::user()->role;
        $role_p = RolePermission::where('role_id', $role_id)->select('permission_id')->get();
        $role_permissions = [];
        foreach ($role_p as $key => $row) {
            $role_permissions[] = $row->permission_id;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $lang=app()->getLocale();
        $permissions = Permission::all();
        $role_p = RolePermission::where('role_id', $id)->select('permission_id')->get();
        
        $user_role = UserRole::findOrFail($id);

        $role_permissions = [];
        foreach ($role_p as $key => $row) {
            $role_permissions[] = $row->permission_id;
        }

        return view('admin.pages.userRole.edit', [
            'lang' => $lang,
            'permissions' => $permissions,
            'user_role' => $user_role,
            'role_permissions' => $role_permissions
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
        //
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
}
