<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasFactory;
    protected $table = 'teacher_details';
    protected $guarded = [];

    protected $fillable = ['nik', 'alamat', 'jenis_kel', 'tanggal_lhr', 'no_hp', 'school_id', 'jenjang', 'golongan', 'sertifikasi', 'gambar_profile', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
