<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyCase extends Model
{
    use HasFactory;

    protected $fillable = ['case_name'];

    public function criteria()
    {
        return $this->hasMany(Criteria::class);
    }
}
