<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulModel extends Model
{
    use HasFactory;
    protected $table = 'matkul';
    protected $guarded = [];
    protected $primaryKey = 'matkul_id';

    public function jurusan()
{
    return $this->belongsTo(JurusanModel::class, 'jurusan_id', 'jurusan_id');
}

public function kelas()
{
    return $this->belongsTo(KelasModel::class, 'kelas_id', 'kelas_id');
}

public function dosen()
    {
        return $this->hasMany(DosenModel::class, 'jurusan_id');
    }


}
