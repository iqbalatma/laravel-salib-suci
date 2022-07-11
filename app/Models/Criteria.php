<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_name',
        'study_case_id'
    ];

    public function subcriteria()
    {

        return $this->hasMany(SubCriteria::class, 'criteria_id');
    }
}
