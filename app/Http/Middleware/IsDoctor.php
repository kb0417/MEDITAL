<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // À ce stade, auth a DÉJÀ été vérifié
        if (Auth::user()->role !== 'doctor') {
            abort(403, 'Accès réservé aux médecins');
        }
        
        if (!Auth::user()->is_validated) {
            abort(403, 'Votre compte médecin est en attente de validation.');
        }

        return $next($request);
    }
}
