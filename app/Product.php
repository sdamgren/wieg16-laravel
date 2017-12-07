<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'entity_id';

    protected $fillable = [

        'entity_id',
        'entity_type_id',
        'attribute_set_id',
        'type_id',
        'sku',
        'has_options',
        'required_options',
        'status',
        'name',
        'amount_package',
        'price',
        'is_salable',
        'is_in_stock',

    ];


    public function groupPrice()
    {
        return $this->hasMany(Groupprice::class);
    }
}
