<?php

namespace App\Http\Middleware;

use App\Models\api_key;
use Closure;
use Illuminate\Http\Request;

class ApiValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        dd(apache_request_headers());
        if (!isset(apache_request_headers()['API_KEY'])) {
            return Response()->json([
                "err"=>"You did not send the key",
            ],422);
        }
        $token = api_key::where('token',apache_request_headers()['API_KEY'])->count();
        if ($token == 0) {
            return Response()->json([
                "err"=>"The key is wrong",
            ],422);
        }
        return $next($request);
    }
}
