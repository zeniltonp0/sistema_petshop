<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'item_pedidos')
                    ->withPivot(['quantidade', 'preco_unitario'])
                    ->using(ItemPedido::class)
                    ->withTimestamps();
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }
}
