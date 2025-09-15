<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'warehouse_id',
        'product_id',
        'customer_id',
        'supplier_id',
        'transaction_type',
        'quantity',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
