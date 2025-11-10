<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

        protected $table = 'stages';

        protected $primaryKey = 'stage_id';   // your table uses stage_id

        protected $fillable = ['name', 'color'];

       public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
