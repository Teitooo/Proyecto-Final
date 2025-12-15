<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class WebController extends Controller
{
    public function home(Request $request){
        $query=Producto::query()->with('inventario');
        // Búsqueda por nombre
        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Filtro de orden (Ordenar por precio)
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'priceAsc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->orderBy('nombre', 'asc');
                    break;
            }
        }
        // Obtener productos filtrados
        $productos = $query->paginate(3);
        
        // Contar productos por categoría (simuladas)
        $categoryCounts = [
            'all' => Producto::count(),
            'diagnostico' => Producto::where('id', '<=', 6)->count(),
            'cirugia' => Producto::where('id', '>', 6)->where('id', '<=', 7)->count(),
            'urgencias' => Producto::where('id', '>', 7)->where('id', '<=', 9)->count(),
            'laboratorio' => Producto::where('id', '>', 9)->where('id', '<=', 10)->count(),
            'rehabilitacion' => Producto::where('id', '>', 10)->where('id', '<=', 11)->count(),
            'imagenologia' => Producto::where('id', '>', 11)->count(),
        ];
        
        return view('web.home', compact('productos', 'categoryCounts'));

    }

    public function catalog(Request $request){
        $query=Producto::query()->with('inventario');
        // Búsqueda por nombre
        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        // Filtro de orden (Ordenar por precio)
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'priceAsc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->orderBy('nombre', 'asc');
                    break;
            }
        }
        
        // Obtener productos filtrados
        $productos = $query->paginate(12);
        
        // Contar productos por categoría (simuladas)
        $categoryCounts = [
            'all' => Producto::count(),
            'diagnostico' => Producto::where('id', '<=', 6)->count(),
            'cirugia' => Producto::where('id', '>', 6)->where('id', '<=', 7)->count(),
            'urgencias' => Producto::where('id', '>', 7)->where('id', '<=', 9)->count(),
            'laboratorio' => Producto::where('id', '>', 9)->where('id', '<=', 10)->count(),
            'rehabilitacion' => Producto::where('id', '>', 10)->where('id', '<=', 11)->count(),
            'imagenologia' => Producto::where('id', '>', 11)->count(),
        ];
        
        return view('web.catalog', compact('productos', 'categoryCounts'));
    }

    public function show($id){
        // Obtener el producto por ID con su inventario
        $producto = Producto::with('inventario')->findOrFail($id);        
        // Pasar el producto a la vista
        return view('web.item', compact('producto'));
    }
}
