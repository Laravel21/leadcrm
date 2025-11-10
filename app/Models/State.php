<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table="tbl_states";

   public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

        public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }

}
