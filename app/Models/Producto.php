<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property float $precio
 * @property string|null $descripcion
 * @property string|null $imagen
 * @property string|null $marca
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'descripcion',
        'imagen',
        'marca',
    ];

    public function inventario()
    {
        return $this->hasOne(Inventario::class);
    }
}
