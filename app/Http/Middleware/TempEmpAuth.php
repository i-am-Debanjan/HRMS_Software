<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TempEmpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('temp_employee')){
            return redirect('/temp_emp_login');
        }
        return $next($request);
    }
}
