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

    public function setStatusPending()
    {
        $this->attributes['status_pembayaran'] = 'pending';
        self::save();
    }

    public function setStatusSuccess()
    {
        $this->attributes['status_pembayaran'] = 'success';
        self::save();
    }

    public function setStatusFailed()
    {
        $this->attributes['status_pembayaran'] = 'failed';
        self::save();
    }

    public function setStatusExpired()
    {
        $this->attributes['status_pembayaran'] = 'expired';
        self::save();
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
