<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'tblprodutos';

    protected $fillable = [
        'nomeProduto', 'descricaoProduto', 'valorProduto','categoriaProduto','fotoProduto','statusProduto'
    ];

    protected $guarded= [];

    public $timestamps = false;
    protected $primaryKey = 'idProduto';
}
