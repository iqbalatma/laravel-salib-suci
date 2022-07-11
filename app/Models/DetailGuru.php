<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGuru extends Model
{
    use HasFactory;
    protected $table = 'detail_guru';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
