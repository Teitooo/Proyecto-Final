<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['user_id', 'total', 'estado', 'tipo_envio', 'notas'];
    public $timestamps = true;
    
    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
