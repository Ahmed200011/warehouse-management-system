<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
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
            'warehouse_id' => $this->warehouse->name,
            'product_id' => $this->product->name,
            'customer_id' => $this->customer->name?? null,
            'supplier_id' => $this->supplier->name??null,
            'transaction_type' => $this->transaction_type,
            'quantity' => $this->quantity,
            // 'created_at' => $this->created_at->format('d-m-Y h:i A'),
            // 'updated_at' => $this->updated_at->format('d-m-Y h:i A'),
        ];
    }
}
