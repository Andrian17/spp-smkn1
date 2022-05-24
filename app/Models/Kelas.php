<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas'
    ];

    public function student()
    {
        $this->hasMany(Student::class);
    }

    public function major()
    {
        $this->belongsTo(Major::class);
    }
}
