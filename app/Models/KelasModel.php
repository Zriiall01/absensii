<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = 'Kelas';
    protected $guarded =[];
    protected $primaryKey = 'kelas_id';

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'jurusan_id', 'jurusan_id');
    }

    public function matkuls()
{
    return $this->belongsToMany(MatkulModel::class, 'kelas_matkul', 'kelas_id', 'matkul_id');
}

    public function dosen()
    {
        return $this->hasMany(DosenModel::class, 'jurusan_id');
    }
}
