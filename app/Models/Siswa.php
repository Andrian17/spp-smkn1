<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function uasPayments()
    {
        return $this->hasMany(UasPayment::class);
    }

    public function utsPayments()
    {
        return $this->hasMany(UtsPayment::class);
    }
}
