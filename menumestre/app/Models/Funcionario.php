<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionario';
    protected $primaryKey = 'idFuncionario';
    public $timestamps = false;

    public function usuario(){
        return $this->morphOne(Usuario::class, 'tipo_usuario'); //morphOne permite fazer uma relação com outra tabela em especifico
    }
}
