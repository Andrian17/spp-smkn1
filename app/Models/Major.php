<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan'
    ];

    public function kelas()
    {
        $this->hasMany(Kelas::class);
    }

    public function student()
    {
        $this->hasMany(Student::class);
    }
}
