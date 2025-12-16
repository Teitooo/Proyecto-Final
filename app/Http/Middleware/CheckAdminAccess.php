<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    /**
     * Middleware para verificar acceso a rutas administrativas.
     * Bloquea intentos de acceso directo a URLs de administración sin permisos.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Permitir acceso a rutas públicas
        $publicRoutes = ['home', 'index', 'catalog', 'about', 'contact', 'web.show'];
        
        if ($request->route() && in_array($request->route()->getName(), $publicRoutes)) {
            return $next($request);
        }

        // Si no está autenticado, redirigir al login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        $user = auth()->user();

        // Verificar que el usuario esté activo
        if (!$user->activo) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Tu cuenta ha sido desactivada. Contacta con el administrador.');
        }

        // Detectar si es una ruta administrativa por URL
        $adminPatterns = [
            'usuarios', 'roles', 'productos', 'inventarios', 'administracion'
        ];

        $isAdminRoute = false;
        foreach ($adminPatterns as $pattern) {
            if (str_contains($request->path(), $pattern)) {
                $isAdminRoute = true;
                break;
            }
        }

        // Si es ruta administrativa, verificar que sea admin
        if ($isAdminRoute) {
            if (!$user->hasRole('admin')) {
                abort(403, 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
            }

            // Verificar que tenga permisos de administrador
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
        }

        return $next($request);
    }
}
