<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table ='unidade';

    protected $fillable = [
        'code',
        'nameAr',
    ];

    protected $hidden = [
        'id'
    ];

    public function Pedido(){
        return $this->hasOne(Pedido::class);
    }

}
