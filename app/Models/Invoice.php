<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $fillable = [
        'type',
        'transaction_id',
        'supplier_id',
        'customer_id',
        'date',
        'total_amount',
        'notes',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
      public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
