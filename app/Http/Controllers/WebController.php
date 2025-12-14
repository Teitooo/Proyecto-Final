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
        return view('web.home', compact('productos'));

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
        return view('web.catalog', compact('productos'));

    }

    public function show($id){
        // Obtener el producto por ID con su inventario
        $producto = Producto::with('inventario')->findOrFail($id);        
        // Pasar el producto a la vista
        return view('web.item', compact('producto'));
    }
}
