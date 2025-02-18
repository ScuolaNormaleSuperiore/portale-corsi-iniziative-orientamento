<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckRedirect
{
    public function handle(Request $request, \Closure $next)
    {
        // Controlla se esiste un redirect nella sessione
        if (Session::has('redirect_url')) {
            return redirect(Session::get('redirect_url'));
        }
        return $next($request);
    }
}
