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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //admin
        $userRole = Auth::user()->role;
        if($userRole === 1){
            return $next($request);
        }
        //owner
        elseif($userRole === 2){
            return redirect()->route('owner.dashboard.index');
        //pelanggan
        }
        elseif($userRole === 3){
            return redirect()->route('frontend.reservasi.dashboard');
        }



    }
}
