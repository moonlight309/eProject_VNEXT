<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'              => 'Admin',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make('123123123'),
            'email_verified_at' => now(),
            'role'              => 0,
        ];

        User::query()->create($data);
    }
}
