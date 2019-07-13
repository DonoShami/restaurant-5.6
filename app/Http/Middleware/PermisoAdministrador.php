<?php

namespace restaurant\Http\Middleware;

use Closure;

class PermisoAdministrador
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
        if ($this->permisoadmin())
            return $next($request);
        return redirect('/sistema')->with('alerta', 'No tiene permiso para entrar aquí');
    }
    private function permisoadmin()
    {
        return session()->get('rol_nombre') == 'administrador';
    }
}
