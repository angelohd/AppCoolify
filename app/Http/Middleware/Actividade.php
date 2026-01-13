<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Actividade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $response = $next($request);
        if (auth()->check()) {
            if ($request->path() != 'livewire/update') {
                activity()
                    ->causedBy(auth()->user())
                    ->withProperties([
                        'ip' => $request->ip(),
                        'rota' => $request->fullUrl(),
                        'metodo' => $request->method(),
                        'agente' => $request->userAgent(),
                    ])
                    ->log("Acedeu à página: " . $request->path());
            }
        }

        return $response;
    }
}
