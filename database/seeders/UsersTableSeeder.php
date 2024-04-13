<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            DB::table('users')->insert([
                'image' => 'admin.png',
                'name' => 'User'.$i,
                'email' => 'user'.$i.'@example.com',
                'tel' => 100000 + $i,
                'password' => Hash::make('password'.$i),
                'usertype' => $i % 2 == 0 ? 'admin' : 'user',
                'manger' => $i % 2 == 0 ? 0 : 1,
                'compte' => 1,
                'statut' => $i % 2 == 0 ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
