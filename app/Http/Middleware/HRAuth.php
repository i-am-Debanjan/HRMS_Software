<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HRAuth
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
        if(!$request->session()->has('hr')){
            return redirect('/hr_login');
        }
        // else if (!$request->session()->has('employee')) {
        //     return redirect("/emp_login");
        // }else{
        //     return redirect($request->path());
        // }
        return $next($request);
    }
}
