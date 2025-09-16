<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'manager' => $this->manager,
            'total_many' => $this->product->sum('price') * $this->productWarehouses->sum('quantity'),
            'warehouse_quantity' => $this->productWarehouses->sum('quantity'),
            'products' => ProductResource::collection($this->product)
        ];
    }
}
