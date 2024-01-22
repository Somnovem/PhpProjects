<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    public function handle($request, \Closure $next, ...$guards) {
        try {
            $this->authenticate($request,$guards);
            //info('Handling authentication middleware', ['request->bearerToken' => json_encode($request->bearerToken())]);
            //info('user',[json_encode($request->user())]);
            return $next($request);
        }
        catch (\Exception $e){
            return response()->json([
                'error' => 'Unauthorized',
            ],401);
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
