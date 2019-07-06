<?php

namespace restaurant\Http\Middleware;

use Closure;

class PermisoMozo
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
        if ($this->permiso())
            return $next($request);
        return redirect('/');/*->with('mensaje', 'No tiene permiso para entrar aquí -> solo Mozo');*/
    }
    private function permiso()
    {
        return session()->get('rol_nombre') == 'mozo';
    }
}
