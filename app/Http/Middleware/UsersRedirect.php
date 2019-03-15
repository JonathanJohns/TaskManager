<?php

namespace App\Http\Middleware;
use App\Users;
use App\Clients;
use App\Tasks;
use App\Projects;
use Illuminate\Support\Facades\Auth;

use Closure;

class UsersRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->roles != 'super-admin') {
            return redirect('/tasks');
        }

        

        return $next($request);
    }
}
