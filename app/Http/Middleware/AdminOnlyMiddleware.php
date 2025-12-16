<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $user = auth()->user();

        // Verificar que sea admin
        if (!$user->hasRole('admin')) {
            abort(403, 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
        }

        // Verificar que el usuario esté activo
        if (!$user->activo) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Tu cuenta ha sido desactivada.');
        }

        // Verificar que tenga al menos un permiso de administrador
        $adminPermissions = [
            'user-list', 'user-create', 'user-edit', 'user-delete', 'user-activate',
            'rol-list', 'rol-create', 'rol-edit', 'rol-delete',
            'producto-list', 'producto-create', 'producto-edit', 'producto-delete',
            'inventario-list', 'inventario-create', 'inventario-edit', 'inventario-delete',
            'pedido-list', 'pedido-anulate', 'pedido-cancel', 'pedido-change-status', 'pedido-edit-status'
        ];

        if (!$user->hasAnyPermission($adminPermissions)) {
            abort(403, 'No tienes permisos suficientes para acceder a esta sección.');
        }

        return $next($request);
    }
}
