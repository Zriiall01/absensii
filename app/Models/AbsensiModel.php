<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensis';
    protected $fillable = [
        'dosen_id', 'judul', 'deskripsi', 'waktu_mulai', 'waktu_selesai',
        'latitude', 'longitude', 'radius'
    ];

    public function mahasiswaAbsensi()
{
    return $this->hasMany(AbsensiMahasiswaModel::class, 'absensi_id'); // sesuaikan dengan nama kolom foreign key di pivot
}

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

public function kelas()
{
    return $this->belongsToMany(KelasModel::class, 'absensi_kelas', 'absensi_id', 'kelas_id');
}


public function izinMahasiswa()
{
    return $this->hasMany(IzinModel::class, 'absensi_id');
}

public function sakitMahasiswa()
{
    return $this->hasMany(SakitModel::class, 'absensi_id');
}

}
