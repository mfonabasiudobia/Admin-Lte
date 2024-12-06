<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use AppHelper;

class AdminAuth
{

        public function handle(Request $request, Closure $next)
        {
            if(AppHelper::isAdminAuthRoute() && auth()->check()){
                if(auth()->user()->hasRole('Super Admin')){
                    return redirect()->route('admin.dashboard');
                }  

                return redirect()->route('admin.login');

            }else if(!AppHelper::isAdminAuthRoute() && !auth()->check()){
                   return redirect()->route('admin.login');
            }          

            return $next($request);
        }

}
