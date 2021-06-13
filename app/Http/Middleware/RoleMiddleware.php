<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if(!$request->user()->hasRole($role))
                {
                    abort(403, 'You are not authorized to access this section.');
                }
            }
        }
        else
        {
            if(!$request->user()->hasRole($roles))
            {
                abort(403, 'You are not authorized to access this section.');
            }
        }

        return $next($request);
    }
}
