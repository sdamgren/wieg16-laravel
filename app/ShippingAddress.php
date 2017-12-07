<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shippingAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_address_id',
        'email',
        'firstname',
        'lastname',
        'postcode',
        'street',
        'city',
        'telephone',
        'country_id',
        'address_type',
        'company',
        'country'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order() {
        return $this->hasOne(Order::class);
    }
}
