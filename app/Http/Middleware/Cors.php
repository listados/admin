<?php

namespace AdminEspindola\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
                //Acrescente as 3 linhas abaixo
                ->header('Access-Control-Allow-Origin', "*")
                ->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS")
                ->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");;
    }
}
