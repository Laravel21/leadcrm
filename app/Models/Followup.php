<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $table = 'followups';
    protected $fillable = [
        'lead_id','assigned_to','follow_up_date','follow_up_type','status','remark'
    ];

    public function lead()
    {
        return $this->belongsTo(\App\Models\Lead::class, 'lead_id');
    }
    public function user()
        {
            return $this->belongsTo(User::class);
        }

}

