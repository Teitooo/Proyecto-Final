<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PedidoController extends Controller
{
    public function index(Request $request){
        $texto = $request->input('texto');
        $query = Pedido::with('user', 'detalles.producto')->orderBy('id', 'desc');

        // Búsqueda por nombre del usuario o ID del pedido
        if (!empty($texto)) {
            $query->where(function($q) use ($texto) {
                $q->where('id', 'like', "%{$texto}%")
                  ->orWhere('estado', 'like', "%{$texto}%")
                  ->orWhereHas('user', function ($subQ) use ($texto) {
                      $subQ->where('name', 'like', "%{$texto}%");
                  });
            });
        }
        
        $registros = $query->paginate(10);
        return view('pedido.index', compact('registros', 'texto'));
    }

    public function checkout(Request $request){
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.mostrar')->with('error', 'El carrito está vacío.');
        }

        // Calcular subtotal
        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        return view('web.checkout', compact('carrito', 'subtotal'));
    }

    public function realizar(Request $request){
        $request->validate([
            'tipo_envio' => 'required|in:standar,express,priority,tienda',
        ]);

        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
        DB::beginTransaction();
        try {
            // 1. Calcular el total con envío
            $shippingCosts = [
                'standar' => 0,
                'express' => 15,
                'priority' => 35,
                'tienda' => 0
            ];
            
            $subtotal = 0;
            foreach ($carrito as $item) {
                $subtotal += $item['precio'] * $item['cantidad'];
            }
            
            $shippingCost = $shippingCosts[$request->tipo_envio] ?? 0;
            $total = $subtotal + $shippingCost;

            // 2. Crear el pedido
            $pedido = Pedido::create([
                'user_id' => auth()->id(), 
                'total' => $total, 
                'estado' => 'pendiente',
                'tipo_envio' => $request->tipo_envio,
                'notas' => $request->notas ?? null
            ]);
            // 3. Crear los detalles del pedido
            foreach ($carrito as $productoId => $item) {
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id, 
                    'producto_id' => (int)$productoId,
                    'cantidad' => (int)$item['cantidad'], 
                    'precio' => (float)$item['precio'],
                ]);

                // Restar del inventario si existe
                try {
                    $inventario = Inventario::where('producto_id', $productoId)->first();
                    if ($inventario) {
                        $inventario->cantidad_disponible -= $item['cantidad'];
                        
                        // Si la cantidad es negativa, colocar en 0
                        if ($inventario->cantidad_disponible < 0) {
                            $inventario->cantidad_disponible = 0;
                        }
                        
                        $inventario->save();
                    }
                } catch (\Exception $invError) {
                    // Si hay error al actualizar inventario, continuar sin fallar
                    \Log::error('Error al actualizar inventario: ' . $invError->getMessage());
                }
            }
            
            // 4. Vaciar el carrito de la sesión
            session()->forget('carrito');
            DB::commit();
            
            \Log::info('Pedido creado exitosamente', ['pedido_id' => $pedido->id, 'user_id' => $pedido->user_id]);
            
            // Redirigir a la vista de confirmación
            return redirect()->route('pedido.confirmacion', ['id' => $pedido->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al procesar pedido: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido. Por favor, intenta de nuevo o contacta con soporte.');
        }
    }

    public function confirmacion($id){
        $pedido = Pedido::with('detalles.producto', 'user')->findOrFail($id);
        
        // Verificar que el pedido pertenezca al usuario autenticado
        if ($pedido->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        return view('web.confirmacion-pedido', compact('pedido'));
    }

    public function cambiarEstado(Request $request, $id){
        $pedido = Pedido::findOrFail($id);
        $estadoNuevo = $request->input('estado');

        // Validar que el estado nuevo sea uno permitido
        $estadosPermitidos = ['pendiente', 'en espera', 'enviado', 'entregado', 'cancelado', 'anulado', 'devuelto'];

        if (!in_array($estadoNuevo, $estadosPermitidos)) {
            abort(403, 'Estado no válido');
        }

        // Los admins pueden cambiar cualquier estado
        if (auth()->user()->hasRole('admin')) {
            $pedido->estado = $estadoNuevo;
            $pedido->save();
            return redirect()->back()->with('mensaje', 'El estado del pedido #' . $id . ' fue actualizado a "' . ucfirst($estadoNuevo) . '"');
        }

        // Verificar permisos según el estado para no-admins
        if (in_array($estadoNuevo, ['enviado', 'entregado', 'anulado', 'devuelto', 'en espera'])) {
            if (!auth()->user()->can('pedido-change-status')) {
                abort(403, 'No tiene permiso para cambiar a este estado');
            }
        }

        if ($estadoNuevo === 'cancelado') {
            if (!auth()->user()->can('pedido-cancel')) {
                abort(403, 'No tiene permiso para cancelar pedidos');
            }
        }

        // Cambiar el estado
        $pedido->estado = $estadoNuevo;
        $pedido->save();

        return redirect()->back()->with('mensaje', 'El estado del pedido fue actualizado a "' . ucfirst($estadoNuevo) . '"');
    }

    public function misPedidos(Request $request){
        $texto = $request->input('texto');
        $query = Pedido::with('detalles.producto')
                    ->where('user_id', auth()->id())
                    ->orderBy('id', 'desc');

        // Búsqueda
        if (!empty($texto)) {
            $query->where('id', 'like', "%{$texto}%")
                  ->orWhere('estado', 'like', "%{$texto}%");
        }

        $pedidos = $query->paginate(10);
        return view('web.mis-pedidos', compact('pedidos', 'texto'));
    }
}