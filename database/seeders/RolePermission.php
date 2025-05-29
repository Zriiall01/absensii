<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'kelola_user',
            'akses_dashboard',
            'lihat_absensi',
            'input_absensi',
            'lihat_biodata',
        ];

        // Buat permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $mahasiswa = Role::firstOrCreate(['name' => 'mahasiswa']);
        $dosen = Role::firstOrCreate(['name' => 'dosen']);

        // Admin dapat semua permissions
        $admin->givePermissionTo(Permission::all());

        // Mahasiswa hanya bisa lihat absensi & biodatanya
        $mahasiswa->givePermissionTo([
            'akses_dashboard',
            'lihat_absensi',
            'lihat_biodata',
        ]);

        // Dosen bisa input absensi dan lihat biodata
        $dosen->givePermissionTo([
            'akses_dashboard',
            'input_absensi',
            'lihat_biodata',
        ]);
    }
}
