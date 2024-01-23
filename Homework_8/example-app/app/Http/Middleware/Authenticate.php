<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate  extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        try {
            // Процесс аутентификации по ключу
            $this->authenticate($request, $guards);

            // Ключ
//            info('Handling authentication middleware', ['request->bearerToken' => json_encode($request->bearerToken())]);
//            info('user', [json_encode($request->user())]);

            return $next($request);
        } catch (\Exception $e) {
            // Обработка ошибки аутентификации
            return response()->json(['error' => 'Unauthorized'], 401);
        }

//        // Вот процесс авториазции по ключу
//        $this->authenticate($request, $guards);
//        // Ключ
//        info('Handling authentication middleware', ['request->bearerToken' => json_encode($request->bearerToken())]);
//        info('user', [json_encode($request->user())]);
//        return $next($request);
    }

//    public function handle(Request $request, Closure $next, ...$scopes)
//    {
//        // Логируем что-то или выводим сообщение в консоль
//        // например, информацию о запросе
//        info('Handling authentication middleware', ['request' => $request->all()]);
//
//        return $next($request);
//    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
