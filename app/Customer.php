<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    //Hämtar datan från tabellen
    protected $table = "customers";

    protected $key = "id";

    //ditt id är aoutinkremerat
    public $incrementing = false;

    //timestamp är avstängt, laravel sköter det åt dig.
    public $timestamps = false;


    protected $fillable = [
        "email",
        "firstname",
        "lastname",
        "gender",
        "customer_activated",
        "customer_company",
        "group_id",
        "default_billing",
        "default_shipping",
        "is_active",
        "created_at",
        "updates_at",
        "customer_invoice_email",
        "customer_extra_text",
        "customer_due_date_period",
        "id",
        "company_id"

    ];

}
