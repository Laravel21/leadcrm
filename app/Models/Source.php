<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table ='sources';
    protected $fillable = ['lead_source'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
