<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function user() {

        return $this->belongsTo (User::class); //Ska man in och ändra namespace så behöver man inte ändra (User::class)
    }
}
