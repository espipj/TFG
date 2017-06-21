<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckRole
 * @package App\Http\Middleware
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * Checks if the user is authenticated first.
     * Checks if there are defined roles for this route.
     * Check if the user have the roles and if so it let the request to continue.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()==null){
            return response(view('partials.permission'));
        }
        $actions=$request->route()->getAction();
        $roles=isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }



        return response(view('partials.role-permission'));
    }
}
