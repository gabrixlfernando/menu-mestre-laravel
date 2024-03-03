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
        'cidadeFuncionario',
        'estadoFuncionario',
        'cepFuncionario',
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

    public function usuario(){
        return $this->morphOne(Usuario::class, 'tipo_usuario'); //morphOne permite fazer uma relação com outra tabela em especifico
    }
}
