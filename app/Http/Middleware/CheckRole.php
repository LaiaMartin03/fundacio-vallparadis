<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = $user->role;
        
        // Si solo hay un parámetro y contiene comas, separarlo
        if (count($roles) === 1 && str_contains($roles[0], ',')) {
            $roles = explode(',', $roles[0]);
        }
        
        // Limpiar espacios en blanco
        $roles = array_map('trim', $roles);
        
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'Accés denegat. El teu rol (' . $userRole . ') no està permès. Rol(s) requerit(s): ' . implode(', ', $roles));
    }
}