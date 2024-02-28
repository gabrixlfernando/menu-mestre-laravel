<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_id', 'produto_id', 'quantidade', 'preco_unitario', 'total_item'
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class,'mesa_id', 'id');
    }

    public function produto()
    {
        return $this->belongsTo(Cardapio::class, 'produto_id', 'idProduto');
    }
}
