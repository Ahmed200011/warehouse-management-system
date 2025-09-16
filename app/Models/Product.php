<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable = [
        'name',
        'code',
        'price',
        'category_id',
        'unit',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'product_warehouses')->withPivot('quantity', );
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productWarehouses()
    {
        return $this->hasMany(ProductWarehouse::class);
    }
}
