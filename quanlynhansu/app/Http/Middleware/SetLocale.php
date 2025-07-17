<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('app_locale');
        if(!$locale){
            $locale = Cache::rememberForever('default_locale', function(){
                return DB::table('languages')->where('active', '=', 1)->value('canonical') ?? config('app.locale');
            });
            session(['app_locale' => $locale]);
        }
        \App::setLocale($locale);
        return $next($request);
    }
}
