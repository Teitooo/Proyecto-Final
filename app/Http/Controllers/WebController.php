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
        
        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria && $request->categoria !== 'all') {
            $query->where('categoria', $request->categoria);
        }
        
        // Filtro por marca
        if ($request->has('marca') && $request->marca) {
            $query->where('marca', $request->marca);
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
        
        // Contar productos por categoría
        $categoryCounts = [
            'all' => Producto::count(),
            'diagnostico' => Producto::where('categoria', 'diagnostico')->count(),
            'cirugia' => Producto::where('categoria', 'cirugia')->count(),
            'urgencias' => Producto::where('categoria', 'urgencias')->count(),
            'laboratorio' => Producto::where('categoria', 'laboratorio')->count(),
            'rehabilitacion' => Producto::where('categoria', 'rehabilitacion')->count(),
            'imagenologia' => Producto::where('categoria', 'imagenologia')->count(),
        ];
        
        return view('web.home', compact('productos', 'categoryCounts'));

    }

    public function catalog(Request $request){
        $query=Producto::query()->with('inventario');
        
        // Búsqueda por nombre
        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }
        
        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria && $request->categoria !== 'all') {
            $query->where('categoria', $request->categoria);
        }
        
        // Filtro por marca
        if ($request->has('marca') && $request->marca) {
            $query->where('marca', $request->marca);
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
            'diagnostico' => Producto::where('categoria', 'diagnostico')->count(),
            'cirugia' => Producto::where('categoria', 'cirugia')->count(),
            'urgencias' => Producto::where('categoria', 'urgencias')->count(),
            'laboratorio' => Producto::where('categoria', 'laboratorio')->count(),
            'rehabilitacion' => Producto::where('categoria', 'rehabilitacion')->count(),
            'imagenologia' => Producto::where('categoria', 'imagenologia')->count(),
        ];
        
        return view('web.catalog', compact('productos', 'categoryCounts'));
    }

    public function show($id){
        // Obtener el producto por ID con su inventario
        $producto = Producto::with('inventario')->findOrFail($id);        
        // Pasar el producto a la vista
        return view('web.item', compact('producto'));
    }

    public function getProductosAjax(Request $request){
        $query = Producto::query()->with('inventario');
        
        // Búsqueda por nombre
        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }
        
        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria && $request->categoria !== 'all') {
            $query->where('categoria', $request->categoria);
        }
        
        // Filtro por marca
        if ($request->has('marca') && $request->marca) {
            $query->where('marca', $request->marca);
        }

        // Filtro de orden
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
        
        // Obtener productos
        $productos = $query->paginate(12);
        
        // Renderizar vista parcial
        $html = view('web.partials.producto-card', compact('productos'))->render();
        
        // Renderizar paginación
        $pagination = $productos->render('pagination::bootstrap-4');
        
        return response()->json([
            'html' => $html,
            'pagination' => $pagination,
            'count' => $productos->total(),
            'currentPage' => $productos->currentPage(),
            'lastPage' => $productos->lastPage()
        ]);
    }
}
