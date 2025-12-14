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

        // Permisos
        if (auth()->user()->can('pedido-list')) {
            // Puede ver todos los pedidos
        } elseif (auth()->user()->can('pedido-view')) {
            // Solo puede ver sus propios pedidos
            $query->where('user_id', auth()->id());
        } else {
            abort(403, 'No tienes permisos para ver pedidos.');
        }

        // Búsqueda por nombre del usuario
        if (!empty($texto)) {
            $query->whereHas('user', function ($q) use ($texto) {
                $q->where('name', 'like', "%{$texto}%");
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
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'], 
                    'precio' => $item['precio'],
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
            
            // Redirigir a la vista de confirmación
            return redirect()->route('pedido.confirmacion', $pedido->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function confirmacion($id){
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);
        
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
        $estadosPermitidos = ['enviado', 'anulado', 'cancelado'];

        if (!in_array($estadoNuevo, $estadosPermitidos)) {
            abort(403, 'Estado no válido');
        }

        // Verificar permisos según el estado
        if (in_array($estadoNuevo, ['enviado', 'anulado'])) {
            if (!auth()->user()->can('pedido-anulate')) {
                abort(403, 'No tiene permiso para cambiar a "enviado" o "anulado"');
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
}