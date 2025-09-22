<?php

namespace Database\Seeders;

use App\Models\Kurir;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'okz95',
            'email' =>'okz95@gmail.com',
            'password' => Hash::make('okz95'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        Profile::create([
            'user_id' => 1,
            'nama' => 'Okz95',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No.123, Kota Contoh, Negara Contoh',
            'foto' => 'upload/profile/default.png',
        ]);

        User::create([
            'username' => 'ykz95',
            'email' =>'ykz95@gmail.com',
            'password' => Hash::make('ykz95'),
            'role' => 'kurir',
            'status' => 'aktif',
        ]);

        Profile::create([
            'user_id' => 2,
            'nama' => 'Ykz95',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No.123, Kota Contoh, Negara Contoh',
            'foto' => 'upload/profile/default.png',

        ]);

    }
}
