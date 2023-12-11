<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check() && Auth::user()->userType->type=="customer")
        {
            
            redirect('customer.index');
            return $next($request);
          
        }
        else{
            return redirect('/customer/login')->with('error','Permission Denied!!! You do not have Csustomer access.');

        }
        
    }
}
