<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = 'customer_group_id';

    protected $fillable = [
        'customer_group_id',
        'customer_group_code',
        'tax_class_id'

    ];

    public function groupPrice()
    {
        return $this->hasMany(Groupprice::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }


}
