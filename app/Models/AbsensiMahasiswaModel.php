<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswaModel extends Model
{
    protected $table = 'absensi_mahasiswa';
    protected $fillable = ['absensi_id', 'mahasiswa_id', 'waktu_absen', 'latitude', 'longitude'];

    public function absensi()
{
    return $this->belongsTo(AbsensiModel::class, 'absensi_id');
}


    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
