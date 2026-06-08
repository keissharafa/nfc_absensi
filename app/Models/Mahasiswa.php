<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'kelas'
    ];

    public function kartuNfc()
    {
        return $this->hasOne(KartuNfc::class, 'mahasiswa_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'mahasiswa_id');
    }
}