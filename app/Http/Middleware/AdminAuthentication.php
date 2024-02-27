<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {//追記
            return redirect('/admin/login');//追記
        }

        return $next($request);
    }
}
