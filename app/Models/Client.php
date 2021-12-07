<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cliente';

    protected $fillable = [
        'id',
        'codigo',
        'codigo_pedido',
        'nome',
        'cnpj',
        'email',
        'tipo',
        'municipio',
    ];

    protected $hidden =[
        'id',
        'codigo_pedido'
    ];

    public function Pedido(){
        return $this->belongsTo(Event::class, 'codigo_pedido');
    }

}
