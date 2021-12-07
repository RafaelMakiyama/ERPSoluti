<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pedido';

    protected $with = [
        'Cliente',  'Unidade', 'Produtos'
    ];
    
    protected $fillable = [
        'id',
        'codigo',
        'codigo_cliente',
        'codigo_unidade',
        'codigo_produto',
        'data',
        'referencia',
    ];

    protected $hidden = [
        'id',
        'codigo_cliente',
        'codigo_produto',
        'codigo_unidade'
    ];
    
    public function Unidade(){
        return $this->belongsTo(Unidade::class, 'id');
    }

    public function Cliente(){
        return $this->hasOne(Client::class, 'id','codigo_cliente');
    }

    public function Produtos(){
        return $this->hasMany(Produto::class,'codigo_pedido');
    }
}
