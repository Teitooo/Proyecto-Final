<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;

    /**
     * Constructor del controlador.
     * Valida que el usuario tenga permisos suficientes.
     */
    public function __construct()
    {
        // Validar que el usuario esté autenticado y sea admin si accede a rutas administrativas
        $adminControllers = [
            'ProductoController',
            'UserController',
            'RoleController',
            'InventarioController',
            'PedidoController' // Para métodos administrativos
        ];

        $currentController = class_basename(static::class);

        if (in_array($currentController, $adminControllers) && auth()->check()) {
            $user = auth()->user();

            // Verificar que sea admin
            if (!$user->hasRole('admin')) {
                abort(403, 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
            }

            // Verificar que esté activo
            if (!$user->activo) {
                auth()->logout();
                abort(403, 'Tu cuenta ha sido desactivada.');
            }
        }
    }
}

