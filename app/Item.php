<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'amount_package',
        'created_at',
        'item_id',
        'name',
        'order_id',
        'price',
        'price_incl_tax',
        'qty',
        'row_total',
        'sku',
        'tax_amount',
        'tax_percent',
        'total_incl_tax',
        'updated_at',
        'marking'

    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
