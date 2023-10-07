<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request);
        if(auth()->user()->role == 1){
            return $next($request);
        } else if(auth()->user()->role == 2){
            return $next($request);
        }
        else if(auth()->user()->role){
            if($request->route()->uri == 'admin/user' || str_contains($request->route()->uri, 'reports')){
                return redirect('/')->with('error',"You don't have admin access.");
            }
        return $next($request);       
     }
        return redirect('/')->with('error',"You don't have admin access.");

    }
}
