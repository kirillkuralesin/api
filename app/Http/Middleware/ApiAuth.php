<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class ApiAuth
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
        $user = User::where('api_token', '=', $request->input('token'))->first();
        if (is_null($user)) {
            return response()->json('Token not found', 400);
        }
        return $next($request);
    }
}
