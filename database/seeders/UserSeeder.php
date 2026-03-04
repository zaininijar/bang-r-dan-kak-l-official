<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@bangrkaklofficial.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'no_absensi' => '0',
                'point' => 0,
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Sample member users
        $members = [
            [
                'name' => 'Member Satu',
                'username' => 'member1',
                'no_absensi' => '001',
                'point' => 50,
            ],
            [
                'name' => 'Member Dua',
                'username' => 'member2',
                'no_absensi' => '002',
                'point' => 100,
            ],
            [
                'name' => 'Member Tiga',
                'username' => 'member3',
                'no_absensi' => '003',
                'point' => 25,
            ],
        ];

        foreach ($members as $member) {
            User::firstOrCreate(
                ['email' => $member['username'] . '@bangrkaklofficial.com'],
                [
                    'name' => $member['name'],
                    'username' => $member['username'],
                    'no_absensi' => $member['no_absensi'],
                    'point' => $member['point'],
                    'password' => Hash::make('password'),
                    'role' => 'user',
                ]
            );
        }
    }
}
