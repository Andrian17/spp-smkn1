<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'no_hp',
        'semester',
        'tanggal_lahir',
        'agama',
        'foto'
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
