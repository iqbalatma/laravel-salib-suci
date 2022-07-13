<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $fillable = ['rank', 'total', 'study_case_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
