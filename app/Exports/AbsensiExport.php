<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $absensi;

    public function __construct($absensi)
    {
        $this->absensi = $absensi;
    }

    public function collection()
    {
        return $this->absensi->mahasiswaAbsensi->map(function ($mahasiswaAbsen) {
            return [
                'Nama Mahasiswa' => $mahasiswaAbsen->mahasiswa->name,
                'Waktu Absen' => $mahasiswaAbsen->waktu_absen,
                'Latitude' => $mahasiswaAbsen->latitude,
                'Longitude' => $mahasiswaAbsen->longitude,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'Waktu Absen',
            'Latitude',
            'Longitude',
        ];
    }
}

