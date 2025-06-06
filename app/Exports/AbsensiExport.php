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
        $rows = collect();

        // Hadir
        foreach ($this->absensi->mahasiswaAbsensi ?? [] as $mahasiswaAbsen) {
            $rows->push([
                'Nama Mahasiswa' => optional($mahasiswaAbsen->mahasiswa)->name ?? '-',
                'Waktu Absen' => $mahasiswaAbsen->waktu_absen,
                'Latitude' => $mahasiswaAbsen->latitude,
                'Longitude' => $mahasiswaAbsen->longitude,
                'Keterangan' => 'Hadir',
            ]);
        }

        // Izin
        foreach ($this->absensi->izinMahasiswa ?? [] as $izin) {
            $rows->push([
                'Nama Mahasiswa' => optional($izin->mahasiswa)->name ?? '-',
                'Waktu Absen' => '-',
                'Latitude' => '-',
                'Longitude' => '-',
                'Keterangan' => 'Izin',
            ]);
        }

        // Sakit
        foreach ($this->absensi->sakitMahasiswa ?? [] as $sakit) {
            $rows->push([
                'Nama Mahasiswa' => optional($sakit->mahasiswa)->name ?? '-',
                'Waktu Absen' => '-',
                'Latitude' => '-',
                'Longitude' => '-',
                'Keterangan' => 'Sakit',
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'Waktu Absen',
            'Latitude',
            'Longitude',
            'Keterangan',
        ];
    }
}
