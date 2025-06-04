<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminappsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "AdminApps DesaNexa",
                "email" => "AdminApps@desanexa.com",
                "role" => UserRole::Adminapps,
                "password" => Hash::make("AdminApps"),
            ],
            [
                "name" => "Kepala Desa 1",
                "email" => "kepdes1@desanexa.com",
                "role" => UserRole::Kepdesa,
                "password" => Hash::make("Kepdes1"),
            ],
            [
                "name" => "Kepala Desa 2",
                "email" => "kepdes2@desanexa.com",
                "role" => UserRole::Kepdesa,
                "password" => Hash::make("Kepdes2"),
            ],
            [
                "name" => "Staff Desa 1",
                "email" => "Staffdesa1@desanexa.com",
                "role" => UserRole::Staffdesa,
                "password" => Hash::make("Staffdesa1"),
            ],
            [
                "name" => "Staff Desa 2",
                "email" => "Staffdesa2@desanexa.com",
                "role" => UserRole::Staffdesa,
                "password" => Hash::make("Staffdesa2"),
            ],
            [
                "name" => "Rukun Warga (RW) 1",
                "email" => "Rukunwarga1@desanexa.com",
                "role" => UserRole::Rukunwarga,
                "password" => Hash::make("Rukunwarga1"),
            ],
                        [
                "name" => "Rukun Warga (RW) 2",
                "email" => "Rukunwarga2@desanexa.com",
                "role" => UserRole::Rukunwarga,
                "password" => Hash::make("Rukunwarga2"),
            ],
            [
                "name" => "Penduduk 1",
                "email" => "Penduduk1@desanexa.com",
                "role" => UserRole::Penduduk,
                "password" => Hash::make("Penduduk1"),
            ],
                        [
                "name" => "Penduduk 2",
                "email" => "Penduduk2@desanexa.com",
                "role" => UserRole::Penduduk,
                "password" => Hash::make("Penduduk2"),
            ],
        ];

        User::insert($users);
    }
}
