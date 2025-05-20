<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $guarded=[];

    public function kelas()
    {
        return $this->hasMany(KelasModel::class, 'jurusan_id', 'jurusan_id');
    }

    public function matkul()
    {
        return $this->hasMany(MatkulModel::class, 'jurusan_id', 'jurusan_id');
    }
}
