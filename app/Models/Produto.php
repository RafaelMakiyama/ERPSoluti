<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'produto';

    protected $fillable = [
        'id',
        'codigo',
        'codigo_pedido',
        'sequencia',
        'nome',
        'qtdVendida',
        'qtdentregue',
        'campo1',
        'campo2',
        'campo3',
    ];

    protected $hidden =[
        'id',
        'codigo_pedido',
    ];

    public function Pedido(){
        return $this->belongsToMany(Pedido::class, 'id');
    }

}
