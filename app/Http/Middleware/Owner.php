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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //admin
        $userRole = Auth::user()->role;
        if($userRole == 1){
            return redirect()->route(route: 'admin.dashboard.index');
        }
        //owner
        elseif($userRole == 2){
            return $next($request);

        //pelanggan
        }
        elseif($userRole == 3){
            return redirect()->route('dashboard');
        }
    }
}
