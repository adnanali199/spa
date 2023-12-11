<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check() && Auth::user()->userType->type=="admin")
        {
            
            redirect('admin.index');
            return $next($request);
          
        }
        else{
            return redirect('/admin/login')->with('error','Permission Denied!!! You do not have Admin access.');

        }
        
    }
}
