<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';
    protected $primaryKey = 'idFuncionario';
    protected $fillable = [
        'nomeFuncionario',
        'email',
        'dataNascimento',
        'foneFuncionario',
        'enderecoFuncionario',
        'numeroFuncionario',
        'cidadeFuncionario',
        'estadoFuncionario',
        'cepFuncionario',
        'bairroFuncionario',
        'dataContratacao',
        'cargo',
        'salario',
        'tipoFuncionario',
        'statusFuncionario',
        'fotoFuncionario',
        'criado_em',
        'atualizado_em'
    ];
    public $timestamps = false;

    public function usuario()
    {
        return $this->morphOne(Usuario::class, 'tipo_usuario'); //morphOne permite fazer uma relação com outra tabela em especifico
    }

    public function comandas()
    {
        return $this->hasMany(Comanda::class, 'funcionario_id', 'idFuncionario');
    }
     // Método para acessar os pedidos através das comandas do funcionário
   public function pedidos()
   {
       return Pedido::whereIn('comanda_id', $this->comandas()->pluck('id'))->get();
   }
}
