<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

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
                    ->using(ItemPedido::class)
                    ->withTimestamps();
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }
}
