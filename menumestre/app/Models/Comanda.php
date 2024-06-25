<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_id', 'status', 'total'
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id', 'idFuncionario');
    }
}
