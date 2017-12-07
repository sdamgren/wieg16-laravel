<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupPrice extends Model
{
    protected $primaryKey = 'price_id';

    protected $fillable = [
        'price',
        'group_id',
        'price_id',
        'product_id'

    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
