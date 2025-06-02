<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'mahasiswa'; // tambahkan ini
    protected $primaryKey = 'mahasiswa_id';


    public function jurusan()
{
    return $this->belongsTo(JurusanModel::class, 'jurusan_id');
}
public function kelas()
{
    return $this->belongsTo(KelasModel::class, 'kelas_id');
}

public function matkuls()
{
    return $this->belongsToMany(MatkulModel::class, 'mahasiswa_matkul', 'mahasiswa_id', 'matkul_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'users');
}

}
