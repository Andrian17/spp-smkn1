<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'nominal_pembayaran',
        'pembayaran_uts',
        'pembayaran_uas',
        'status_pembayaran'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
