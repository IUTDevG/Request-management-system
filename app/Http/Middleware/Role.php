<?php

namespace App\Http\Middleware;

use App\Enums\RoleType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->hasRole(RoleType::STUDENT)) {
//           On renvoie la page d'erreur 403 si l'utilisateur n'a pas le rôle student
            abort(403, __('Unauthorized'));

        }
        return $next($request);
    }
}
