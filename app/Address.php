<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //Hämtar datan från tabellen
    protected $key = "id";

    //ditt id är autoinkremerat
    public $incrementing = true;

    //timestamp är avstängt, laravel sköter det åt dig.
    public $timestamps = false;

    protected $fillable = [

        "id",
        "customer_id",
        "customer_address_id",
        "email",
        "firstname",
        "lastname",
        "postcode",
        "steet",
        "city",
        "telephone",
        "country_id",
        "address_type",
        "company",
        "country"

        ];


}
