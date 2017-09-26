<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Session;

class SetLocale
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
        $requestedLanguage = $request->get('locale');
        
        if ($requestedLanguage && in_array($requestedLanguage, config('app.available_locales', []))) {
            Session::put('locale', $requestedLanguage);
        }
        
        $preferedLanguage = $request->getPreferredLanguage(config('app.available_locales', []));
        
        if (!Session::has('locale') && $preferedLanguage) {
            Session::put('locale', $preferedLanguage);
        }

        App::setLocale(session('locale', config('app.locale')));
        setlocale(LC_ALL, session('locale', config('app.locale')) . '_CA.UTF-8');

        return $next($request);
    }
}
