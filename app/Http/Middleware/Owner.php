<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check())
        {
            if(Auth::user()->userType->type=="owner"){
            redirect('owner.index');
            return $next($request);
            }
            else{
                return redirect('/owner/login')->with('error','Permission Denied!!! You do not have Owner access.');
            }
          
        }
        else{
            return redirect('/owner/login');

        }
        
    }
}
