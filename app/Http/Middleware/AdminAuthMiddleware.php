<?php

namespace App\Http\Middleware;
use App\Models\UserRole;
use App\Models\Permission;
use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

global $pm;
$pm = [];

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $section_id)
    {

        $permissions = Permission::all();
        $role_id  = auth()->user()->role;
        $role_p = RolePermission::where('role_id', $role_id)->select('permission_id')->get();
        $role_permissions = [];
        $user_role = UserRole::where('id', $role_id)->get()->first();
        foreach ($role_p as $key => $row) {
            $role_permissions[] = $row->permission_id;
        } 
        Session::put('permission', $role_permissions);
        Session::put('user_role', $user_role);
        Session::save();

        if($section_id==12 && auth()->user()->role == 1) {
            return $next($request);
        } 
        if($section_id == 0) {
            return $next($request);
        }
        if(!in_array($section_id, $role_permissions)) {
            return redirect('/');
        }
        return $next($request);
    }
}
