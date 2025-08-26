<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemPedido extends Pivot
{
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
