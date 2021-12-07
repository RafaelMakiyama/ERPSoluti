<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{

    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'pedido' =>[
                'codigo' => $this->codigo,
                'data' => $this->data,
                'referencia' => $this->referencia
            ],
            'cliente' => [
                'codigo' => $this->cliente->codigo,
                'nome' => $this->cliente->nome,
                'cnpj'=> $this->cliente->cnpj,
                'email' => $this->cliente->email,
                'tipo' => $this->cliente->tipo,
                'municipio'=> $this->cliente->municipio
            ],
            'unidade' => [
                'codigo' => $this->unidade->codigo,
                'nome' => $this->unidade->nome,
            ],
            'produtos'=> $this->produtos,
        ];
    }
}