<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('app_locale',config('app.locale'));
        $locale = session('app_locale',config('app.locale'));
        \App::setLocale($locale);
        $current_lang = DB::table('languages')->where('active','=',1)->value('canonical');
        $locale_current = \App::getLocale();
        if($current_lang != $locale_current){
            \App::setLocale($current_lang);
        }
        return $next($request);
    }
}
