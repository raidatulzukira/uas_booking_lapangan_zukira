<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin Lapangan',
        //     'email' => 'raidatulzukira@gmail.com',
        //     'password' => Hash::make('zukira123'),
        //     'role' => 'admin'
        // ]);

        // User::create([
        //     'name' => 'Customer',
        //     'email' => 'customer@gmail.com',
        //     'password' => Hash::make('customer123'),
        //     'role' => 'customer'
        // ]);

        User::create([
            'name' => 'Raidatul Zukira',
            'email' => 'raidatulzukiraa@gmail.com',
            'password' => Hash::make('zukira123'),
            'role' => 'admin'
        ]);
    }
}


// use Illuminate\Support\Facades\Hash;
// use App\Models\User;

// User::create([
//     'name' => 'Admin Lapangan',
//     'email' => 'admin@lapangan.com',
//     'password' => Hash::make('admin123'),
//     'role' => 'admin'
// ]);

// User::create([
//     'name' => 'Zahra Customer',
//     'email' => 'zahra@mail.com',
//     'password' => Hash::make('zahra123'),
//     'role' => 'customer'
// ]);
