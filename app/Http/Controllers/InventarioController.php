<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InventarioController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('inventario-list');
        $texto = $request->input('texto');
        $registros = Inventario::with('producto')
                    ->whereHas('producto', function($query) use ($texto) {
                        $query->where('nombre', 'like', "%{$texto}%")
                              ->orWhere('codigo', 'like', "%{$texto}%");
                    })
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('inventario.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('inventario-create');
        $productos = Producto::all();
        $inventario = null;
        return view('inventario.action', compact('productos', 'inventario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('inventario-create');
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_disponible' => 'required|numeric|min:0',
            'cantidad_minima' => 'required|numeric|min:0',
            'ubicacion' => 'required|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Inventario::create($request->all());
        return redirect()->route('inventarios.index')->with('mensaje', 'Inventario registrado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('inventario-edit');
        $inventario = Inventario::findOrFail($id);
        $productos = Producto::all();
        return view('inventario.action', compact('inventario', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('inventario-edit');
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_disponible' => 'required|numeric|min:0',
            'cantidad_minima' => 'required|numeric|min:0',
            'ubicacion' => 'required|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $registro = Inventario::findOrFail($id);
        $registro->update($request->all());
        return redirect()->route('inventarios.index')->with('mensaje', 'Inventario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('inventario-delete');
        $registro = Inventario::findOrFail($id);
        $registro->delete();
        return redirect()->route('inventarios.index')->with('mensaje', 'Inventario eliminado correctamente');
    }
}
