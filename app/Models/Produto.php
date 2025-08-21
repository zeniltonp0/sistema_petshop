<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'item_pedidos')
                    ->withPivot(['quantidade', 'preco_unitario'])
                    ->withTimestamps();
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
