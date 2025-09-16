<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'address',
        'manager',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
     public function product()
    {
        return $this->belongsToMany(Product::class,'product_warehouses');
    }
    public function productWarehouses()
    {
        return $this->hasMany(ProductWarehouse::class);
    }
}
