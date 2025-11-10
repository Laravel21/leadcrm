<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

     protected $fillable = [
        'first_name', 'last_name', 'email', 'country_code', 'mobile_number',
        'lead_source', 'stage_id', 'assign_to','job_type', 'industry', 'company',
        'website','Address1','Address2','country_id', 'state_id', 'city_id', 'zip_code'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id', 'stage_id');
        // belongsTo(RelatedModel, foreign_key, owner_key)
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'lead_source');
    }

       public function followUps()
        {
            return $this->hasMany(FollowUp::class);
        }
    }
