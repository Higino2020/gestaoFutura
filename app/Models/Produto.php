<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable =[
        'codigo','nome','foto','medicao','qtdaVender','qtd','preco','caducidade','perecivel','categoria_id'
    ];
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
