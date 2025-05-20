<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = 'Kelas';
    protected $guarded =[];

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'jurusan_id', 'jurusan_id');
    }

    public function Matkul()
    {
        return $this->hasMany(MatkulModel::class, 'jurusan_id', 'jurusan_id');
    }
}
