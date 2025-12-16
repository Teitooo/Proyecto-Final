<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregar(Request $request){
        $producto = Producto::findOrFail($request->producto_id);
        $cantidad = $request->cantidad ?? 1;

        // Verificar si el producto está activo en inventario
        $inventario = $producto->inventario;
        if (!$inventario || $inventario->estado !== 'activo') {
            return redirect()->back()->with('error', 'Lo sentimos, este producto no está disponible en este momento.');
        }

        // Verificar si hay cantidad disponible
        if ($inventario->cantidad_disponible <= 0) {
            return redirect()->back()->with('error', 'Lo sentimos, este producto está agotado.');
        }

        // Validar que no agregues más de lo disponible
        if ($cantidad > $inventario->cantidad_disponible) {
            return redirect()->back()->with('error', 'Solo hay ' . $inventario->cantidad_disponible . ' unidades disponibles.');
        }

        $carrito = session()->get('carrito', []);
        if (isset($carrito[$producto->id])) {
            // Validar cantidad total
            $cantidadTotal = $carrito[$producto->id]['cantidad'] + $cantidad;
            if ($cantidadTotal > $inventario->cantidad_disponible) {
                return redirect()->back()->with('error', 'Solo hay ' . $inventario->cantidad_disponible . ' unidades disponibles en total.');
            }
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            // No existe, lo agregamos
            $carrito[$producto->id] = [
                'codigo' => $producto->codigo,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => $cantidad,
            ];
        }
        session()->put('carrito', $carrito);
        return redirect()->route('carrito.mostrar')->with('mensaje', 'Producto agregado al carrito');
    }

    public function mostrar(){
        $carrito =session('carrito', []);
        return view('web.pedido', compact('carrito'));
    }

    public function sumar($productoId){
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += 1;
            session()->put('carrito', $carrito);
            return response()->json(['success' => true, 'carrito' => $carrito]);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
    }

    public function restar($productoId){
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            if ($carrito[$productoId]['cantidad'] > 1) {
                // Resta 1 si la cantidad es mayor a 1
                $carrito[$productoId]['cantidad'] -= 1;
            } 
            else{
                // Si es 1, lo quitamos del carrito
                unset($carrito[$productoId]);
            }
            session()->put('carrito', $carrito);
            return response()->json(['success' => true, 'carrito' => $carrito]);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
    }
    public function eliminar($id){
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return response()->json(['success' => true, 'carrito' => $carrito]);
    }

    public function vaciar(){
        session()->forget('carrito');
        return response()->json(['success' => true, 'carrito' => []]);
    }
}
