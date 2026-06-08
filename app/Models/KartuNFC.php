<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuNfc extends Model
{
    protected $table = 'kartu_nfc';

    protected $fillable = [
        'mahasiswa_id',
        'serial_number'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}