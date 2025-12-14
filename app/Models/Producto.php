<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'descripcion',
        'imagen',
    ];

    public function inventario()
    {
        return $this->hasOne(Inventario::class);
    }
}
