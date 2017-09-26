<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckAdmin
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
        $user = Auth::user();
        
        if (is_null($user) || $user->role !== 'admin') {
            session()->flash('status', trans('access_denied'));
            
            $path = $request->path();
            
            return redirect()->route('login', ['request' => $path]);
        }

        return $next($request);
    }
}
