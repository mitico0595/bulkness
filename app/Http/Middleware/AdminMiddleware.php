<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // No autenticado
        if (!Auth::check()) {
            return $this->deny($request, 401, 'Inicia sesión para continuar.');
        }

        $user = Auth::user();

        // Baneado
        if (isset($user->ban) && (int)$user->ban === 1) {
            return $this->deny($request, 403, 'Cuenta baneada.');
        }

        // Solo admin
        // Reemplaza por $user->is_admin ?? false o un Gate si prefieres
        if ((int)($user->type ?? 0) !== 1) {
            // abort(403, 'Acceso denegado.');
            return $this->deny($request, 403, 'Acceso denegado.');
            // O si insistes con redirección:
            // return redirect()->route('noauth'); // asegúrate de que exista la ruta
        }

        return $next($request);
    }

    private function deny(Request $request, int $code, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $code);
        }
        if ($code === 401) {
            return redirect()->route('login')->with('error', $message);
        }
        abort($code, $message);
    }
}
