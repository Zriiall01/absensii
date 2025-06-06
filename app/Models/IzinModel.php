<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinModel extends Model
{
    use HasFactory;

    protected $table = 'izin';

    protected $fillable = [
        'mahasiswa_id',
        'absensi_id',
        'alasan',
        'foto_surat',
        'status',
    ];

    public function absensi()
    {
        return $this->belongsTo(AbsensiModel::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

}
