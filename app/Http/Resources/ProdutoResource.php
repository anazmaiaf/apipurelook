<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => (float) number_format($this->preco, 2, '.', ''),
            'quantidade' => $this->quantidade,
            'marca' => $this->marca,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}