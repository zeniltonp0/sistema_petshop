<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Pedido extends Model
{
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'item_pedidos')
                    ->withPivot(['quantidade', 'preco_unitario'])
                    ->withTimestamps();
    }

    public function itens(): BelongsToMany
    {
        return $this->belongsToMany(ItemPedido::class);
    }
}
