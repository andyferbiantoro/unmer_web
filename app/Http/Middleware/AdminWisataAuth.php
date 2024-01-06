<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminWisataAuth
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
         $user = \Auth::user();
        if($user->isAdminWisata()){
            return $next($request);
        }else{
            return redirect()->back(); //kembali ke halaan sebelumnya
        }
    }
}
