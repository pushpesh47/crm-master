<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        $user = $request->user();
        
        if (! $user /*|| ($user->user_type != 'admin')*/){
            return redirect('crm/login');
        }elseif ($user->user_type == 'client') {
            return redirect('client/accounts');
        }
        
        return $next($request);
    }
}
