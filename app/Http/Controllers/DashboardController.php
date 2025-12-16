<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $newOrders = Pedido::where('estado', 'pendiente')->count();
            $userRegistrations = User::count();
            // Bounce rate and unique visitors not implemented, use placeholders or calculate if possible
            $bounceRate = 53; // Placeholder
            $uniqueVisitors = 65; // Placeholder
            return view('dashboard', compact('newOrders', 'userRegistrations', 'bounceRate', 'uniqueVisitors'));
        } else {
            $userOrders = auth()->user()->pedidos()->count();
            return view('dashboard', compact('userOrders'));
        }
    }
}