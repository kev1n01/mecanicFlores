<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanView
{
   
    public function handle(Request $request, Closure $next, string $permission)
    {
        
        if (canView($permission)) {
            return $next($request);
        }
        abort(403,'USTED NO TIENE PERMISO PARA VER ESTA PÁGINA');
    }
}
