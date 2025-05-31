<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenModel extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $guarded=[];
    protected $primaryKey = 'dosen_id';

    // Relasi ke Jurusan (many to one)
    public function matkul()
    {
        return $this->belongsTo(MatkulModel::class, 'matkul_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'jurusan_id');
    }

    public function kelas()
    {
        return $this->belongsToMany(KelasModel::class, 'dosen_kelas', 'dosen_id', 'kelas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users');
    }
}
